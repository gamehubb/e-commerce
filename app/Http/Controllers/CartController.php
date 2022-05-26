<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
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
        return redirect('/auth/subcategory/index');
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
        $characters = 'MV4560GM678ZA0B0E1D';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 6; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
            $finalvouchernumber = 'GH#' . $randomString;
        }
        return $finalvouchernumber;
    }

    public function charge(Request $request)
    {
        $charge = Stripe::charges()->create([
            'currency' => "USD",
            'source' => $request->stripeToken,
            'amount' => $request->amount,
            'description' => 'Test'
        ]);
        $chargeId = $charge['id'];
        if (session()->has('cart')) {
            $cart = new Cart(session()->get('cart'));
        } else {
            $cart = null;
        }
        Mail::to(auth()->user()->email)->send(new Sendmail($cart));
        if ($chargeId) {
            auth()->user()->orders()->create([
                'voucher_code' => $this->generateVoucherNumber(),
                'cart' => serialize(session()->get('cart'))
            ]);
            session()->forget('cart');
            notify()->success('Transaction Completed');
            return redirect()->to('/');
        } else {
            return redirect()->back();
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