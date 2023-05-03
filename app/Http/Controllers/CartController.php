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

use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

use DB;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {

        $carts = new Carts();
        $user_id = Auth::id();

        $product = Product::find($request->product_id);

        if (session()->has('cart')) {
            $cart = new Cart(session()->get('cart'));
        } else {
            $cart = new Cart();
        }

        $color = $request->color;
        $image = $request->image;

        $cart->add($product, $color, $image);

        foreach ($cart->items as $c) {

            $product_id = Carts::where('product_id', $c['id'])->where('user_id',Auth::id())->pluck('id')->count();

            $cart_product_data = Carts::where('product_id', $c['id'])->where('user_id',Auth::id())->get()->first();

            if (empty($cart_product_data)) {
                $color = 'default';
                $image = 'default';
            } else {
                $color = $cart_product_data->color;
                $image = $cart_product_data->image;
            }
            $total_amount = $c['qty'] * $c['price'];
            if ($product_id == 0 || $color != $c['color'] || $image != $c['image']) {
                $carts->create([
                    'user_id' => $user_id,
                    'product_id' => $c['id'],
                    'product_name' => $c['name'],
                    'vendor' => $c['vendor'],
                    'product_code' => $c['code'],
                    'category' => $c['category'],
                    'brand' => $c['brand'],
                    'product_type' => $c['product_type'],
                    'image' => $c['image'],
                    'quantity' => $c['qty'],
                    'price' =>    $c['price'],
                    'total_amount' =>  $c['discount'] != 0 ? $total_amount - ($total_amount *   ($c['discount'] / 100)) : $total_amount,
                    'color' => $c['color'],
                    'discount' =>  $c['discount']

                ]);
            } else {
                Carts::where('product_id', $c['id'])->where('user_id',Auth::id())->update(
                    [
                        'product_name' => $c['name'],
                        'vendor' => $c['vendor'],
                        'product_code' => $c['code'],
                        'category' => $c['category'],
                        'brand' => $c['brand'],
                        'product_type' => $c['product_type'],
                        'image' => $c['image'],
                        'quantity' => $c['qty'],
                        'price' =>    $c['price'],
                        'total_amount' => $c['discount'] != 0 ? $total_amount - ($total_amount *   ($c['discount'] / 100)) : $total_amount,
                        'color' => $c['color'],
                        'discount' => $c['discount']
                    ]

                );
            }
        }

        session()->put('cart', $cart);

        // notify()->success('Added To Cart Successfully');

        echo "ok";
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
        $cart->updateQty($product->id, $request->qty,  $product->productDetail[0]['discount']);
        session()->put('cart', $cart);
        $total_amt = $request->price * $request->qty;
        $carts = [
            'qty' => $request->qty,
            'total_price' => session()->get('cart')->totalPrice,
            'product_price' => $product->productDetail[0]['discount'] != 0 ?  $total_amt - ($total_amt * ($product->productDetail[0]['discount'] / 100)) : $total_amt,
            'total_quantity' => session()->get('cart')->totalQty
        ];
        Carts::where('product_id', $product->id)->where('user_id',Auth::id())->update(['quantity' => $carts['qty'], 'total_amount' => $carts['product_price']]);
        echo json_encode($carts);
    }

    public function removeCart(Product $product)
    {
        $cart = new Cart(session()->get('cart'));
        Carts::where('product_id', $product->id)->where('user_id',Auth::id())->delete();
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

        $delivery_info = DeliveryInfo::where('user_id', $userId)->get();
        $payments = ['1_k' => 'kpay', '2_w' => 'wpay', '3_c' => 'cod'];

        $cart_data = null;

        if (session()->has('cart')) {
            $cart = new Cart(session()->get('cart'));

            foreach ($cart->items as $c) {

                $cart_data[] = [
                    'user_id' => $userId,
                    'product_id' => $c['id'],
                    'product_name' => $c['name'],
                    'vendor' => $c['vendor'],
                    'product_code' => $c['code'],
                    'category' => Category::where('id', $c['category'])->value('name'),
                    'brand' => Brand::where('id', $c['brand'])->value('name'),
                    'product_type' => $c['product_type'],
                    'image' => $c['image'],
                    'quantity' => $c['qty'],
                    'price' => $c['price'] - ($c['price'] * ($c['discount'] / 100)),
                    'total_amount' => $c['qty'] * $c['price'],
                    'color' => $c['color'],
                    'discount' =>  $c['discount']
                ];
            }
        }
        $categories = Category::get();
        $brands = Brand::get();
        return view('checkout', compact('amount', 'delivery_info', 'payments', 'cart_data', 'categories', 'brands'));
    }

    public function generateVoucherNumber()
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 10; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
            $finalvouchernumber = 'GH#' . $randomString;
        }
        return $finalvouchernumber;
    }

    public function demoCheck()
    {
        return view('complete-checkout');
    }

    public function finalCheckout(Request $request)
    {
        if (session()->has('cart')) {

            $delivery_info = DeliveryInfo::where('id', $request->delInfo)->get()->first();

            foreach (session()->get('cart')->items as $key => $value) {
                $carts[$key] = [
                    'id' => $value['id'],
                    'vendor' => $value['vendor'],
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

            $status = 1;

            $del_name = $delivery_info->name;
            $del_ph_number = $delivery_info->phoneNumber;
            $del_address = $delivery_info->address;
            $del_city = $delivery_info->city;
            $del_township = $delivery_info->township . '/' . $delivery_info->state_region;
            $del_fees = $delivery_info->delivery_fees;

            $total_amount = session()->get('cart')->totalPrice;

            $order_id = Order::create([
                'voucher_code' => $voucher,
                'user_id' => $userId,
                'status' => $status,
                'del_name' => $del_name,
                'del_address' => $del_address,
                'del_city' => $del_city,
                'del_township' => $del_township,
                'del_phone_number' => $del_ph_number,
                'del_fees' => $del_fees,
                'total_amount' => $total_amount,
            ])->id;

            if ($order_id > 0) {

                Payment::create([
                    'user_id' => $userId,
                    'order_id' => $order_id,
                    'payment_type' => $request->payment_type,
                    'account_name' => $request->account,
                    'phone_number' => $request->phone,
                    'total_amount'  => $total_amount,
                ]);

                foreach (session()->get('cart')->items as $key => $value) {

                    OrderItem::create([
                        'order_id' => $order_id,
                        'product_id' => $carts[$key]['id'],
                        'product_image' => $carts[$key]['image'],
                        'product_name' => $carts[$key]['name'],
                        'product_type' => $carts[$key]['product_type'],
                        'vendor_id' => $carts[$key]['vendor'],
                        'product_name' => $carts[$key]['name'],
                        'color' => $carts[$key]['color'],
                        'quantity' => $carts[$key]['qty'],
                        'price' => $carts[$key]['price'],
                        'discount' => $carts[$key]['discount'],
                    ]);
                }

                Carts::where('user_id', $userId)->delete();

                session()->forget('cart');
            }

            $payment_message = null;

            $payment_type = null;

            if ($request->payment_type == '1_k' || $request->payment_type == '2_w') {
                $payment_type = $request->payment_type;
                $payment_message = 'pay-amount-exists';
            }


            return view('complete-checkout', compact('payment_message', 'payment_type'));
        } else {
            return redirect('home');
        }
    }
    //For LoggedIn User
    public function order()
    {
        $user_id = Auth::id();

        $orders = DB::table('orders')->select('*')->join('order_items', 'order_items.order_id', '=', 'orders.id')
            ->where(['user_id' => $user_id])->get();

        $order_data = Order::where('user_id', $user_id)->get();

        return view('order', compact('user_id', 'order_data'));
    }

    public function orderDetail($id)
    {
        try {
            $id = Crypt::decrypt($id);
            $orders = Order::where('id', $id)->get();
            return view('orderDetail', compact('orders'));
        } catch (DecryptException $e) {
            abort(404);
        }
    }
    //For Admin
    public function userorder()
    {
        $orders = Order::all();
        return view('admin.order.index', compact('orders'));
    }
}