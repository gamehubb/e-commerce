<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use App\Models\Carts;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Payment;
use App\Models\Category;
use App\Models\Brand;
use App\Models\DeliveryInfo;
use App\Mail\Sendmail;
use Illuminate\Http\Request;
use Auth;
use Cartalyst\Stripe\Laravel\Facades\Stripe;

class CartController extends Controller
{
    public function addToCart(Product $product)
    {

        $carts = new Carts();
        $user_id = Auth::id();
        $cart_id = $carts->create([
            'user_id' => $user_id,
            'product_id' => $product->id,
            'product_name' => $product->name,
            'category_id' => 1,
            'image' => $product->productDetail->image_1,
            'quantity' => 1,
            'price' => $product->productDetail->price,
            'total_amount' => $product->productDetail->price,
            'color' => "",
            'discount' =>  ""
        ])->id;

        if (session()->has('cart')) {
            $cart = new Cart(session()->get('cart'));
        } else {
            $cart = new Cart();
        }
        $cart->add($product);

        session()->put('cart', $cart);

        // foreach($cart as $data){
        //     print_r($data[1]);
        // }

        // $cart = new Cart();
        // $user_id = Auth::id();

        // $cart->create([

        //     'user_id' => $user_id,
        //     'code' => $request->product_code,
        //     'model_name' => $request->model_name,
        //     'category_id' => $request->category,
        //     'brand_id' => $request->brand,
        //     'user_id' => $id,
        //     'wireless' => $request->wired_option,
        //     'warranty' => $request->warranty,
        //     'product_type' => $request->product_type,
        //     'is_special' => $request->is_special,
        //     'description' => $request->product_description,
        //     'additional_info' => $request->product_additional_info

        // ])->id;

        notify()->success('Added To Cart Successfully');
        return redirect()->back();
        //   return redirect('/auth/subcategory/index');
    }

    public function showCart()
    {
        if (session()->has('cart')) {
            $cart = new Cart(session()->get('cart'));
        } else {
            $cart = null;
        }
        return view('cart', compact('cart'));
    }

    public function updateCart(Request $request, Product $product)
    {
        $request->validate([
            'qty' => 'required|numeric|min:1'
        ]);
        $cart = new Cart(session()->get('cart'));
        $cart->updateQty($product->id, $request->qty);
        session()->put('cart', $cart);
        notify()->success('Cart Updated Successfully');
        return redirect()->back();
    }

    public function removeCart(Product $product)
    {
        $cart = new Cart(session()->get('cart'));
        $cart->remove($product->id);
        if ($cart->totalQty <= 0) {
            session()->forget('cart');
        } else {
            session()->put('cart', $cart);
        }
        notify()->success('Cart Removed Successfully');
        return redirect()->back();
    }

    public function checkout($amount)
    {
        $userId = Auth::id();
        if (session()->has('cart')) {
            $carts = new Cart(session()->get('cart'));
        } else {
            $carts = null;
        }

        if($carts != null){
            foreach(session()->get('cart')->items as $key => $value){
                $carts = [
                            'id' => $value['id'],
                            'name' => $value['name'],
                            'code' => $value['code'],
                            'category' => Category::find($value['category'])->value('name'),
                            'brand' => Brand::find($value['brand'])->value('name'),
                            'product_type' => $value['product_type'],
                            'price' => $value['price'],
                            'discount' => $value['discount'],
                            'color' => $value['color'],
                            'qty' => $value['qty'],
                            'image' => $value['image'],
                        ];
            }
        }


        $delivery_info = DeliveryInfo::where('user_id', $userId)->get();
        return view('checkout', compact('amount', 'carts', 'delivery_info'));
    }

    public function generateVoucherNumber()
    {
        $characters = '1234567890';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 6; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
            $finalvouchernumber = 'GH#' . $randomString;
        }
        return $finalvouchernumber;
    }

    public function finalCheckout(Request $request)
    {
        if (session()->has('cart')) {

            $delivery_info = DeliveryInfo::where('id',$request->delInfo)->get()->first();

            foreach(session()->get('cart')->items as $key => $value){
                $carts = [
                            'id' => $value['id'],
                            'name' => $value['name'],
                            'code' => $value['code'],
                            'category' => Category::find($value['category'])->value('name'),
                            'brand' => Brand::find($value['brand'])->value('name'),
                            'product_type' => $value['product_type'],
                            'price' => $value['price'],
                            'discount' => $value['discount'],
                            'color' => $value['color'],
                            'qty' => $value['qty'],
                            'image' => $value['image'],
                        ];
            }

            $voucher = $this->generateVoucherNumber();

            $userId = Auth::id();
    
            $status = 2;
    
            $del_name = $delivery_info->name;
            $del_ph_number = $delivery_info->phoneNumber;
            $del_address = $delivery_info->address;
            $del_city = $delivery_info->city;
            $del_township = $delivery_info->township.'/'.$delivery_info->state_region;
    
            $total_amount = session()->get('cart')->totalPrice;

            $order_id = Order::create([
                'voucher_code' => $voucher,
                'user_id' => $userId,
                'status' => $status,
                'payment_status' => 4,
                'del_name' => $del_name,
                'del_address' => $del_address,
                'del_city' => $del_city,
                'del_township' => $del_township,
                'del_phone_number' => $del_ph_number,
                'total_amount' => $total_amount,
            ])->id;

            if($order_id > 0){

                if($request->file('payment_slip')){
                   $image = $request->file('payment_slip')->store('public/payment_slip');
               
                    Payment::create([
                        'user_id' => $userId,
                        'order_id' => $order_id,
                        'payment_type' => $request->payment,
                        'payment_slip' => $image,
                        'total_amount'  => $total_amount,
                    ]);
                }

                OrderItem::create([
                    'order_id' => $order_id,
                    'product_id' => $carts['id'],
                    'product_name' => $carts['name'],
                    'color' => $carts['color'],
                    'quantity' => $carts['qty'],
                    'price' => $carts['price'],
                    'discount' => $carts['discount'],
                ]);

                session()->forget('cart');
            }
        }
    }
    //For LoggedIn User
    public function order()
    {
        $orders = auth()->user()->orders;
        $carts = $orders->transform(function ($cart, $key) {
            return unserialize($cart->cart);
        });
        return view('order', compact('carts'));
    }
    //For Admin
    public function userorder()
    {
        $orders = Order::latest()->get();
        return view('admin.order.index', compact('orders'));
    }
    public function viewUserOrder($userid, $orderid)
    {
        $user = User::find($userid);
        $orders = $user->orders->where('id', $orderid);
        $carts = $orders->transform(function ($cart, $key) {
            return unserialize($cart->cart);
        });
        return view('admin.order.show', compact('carts'));
    }
}