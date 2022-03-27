<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use App\Mail\Sendmail;
use Illuminate\Http\Request;

use Cartalyst\Stripe\Laravel\Facades\Stripe;

class CartController extends Controller
{
    public function addToCart(Product $product){
        if(session()->has('cart')){
            $cart = new Cart(session()->get('cart'));
        }
        else{
            $cart = new Cart();
        }   
        $cart->add($product);
        // dd($cart);
        session()->put('cart',$cart);
        notify()->success('Added To Cart Successfully');
        return redirect()->back();
        // return redirect('/auth/subcategory/index');
    }
    public function showCart(){
        if(session()->has('cart')){
            $cart = new Cart(session()->get('cart'));
        }
        else{
            $cart = null;
        }
        return view('cart',compact('cart'));
    }
    public function updateCart(Request $request, Product $product){
        $request->validate([
            'qty'=>'required|numeric|min:1'
        ]);
        $cart = new Cart(session()->get('cart'));
        $cart->updateQty($product->id,$request->qty);
        session()->put('cart',$cart);
        notify()->success('Cart Updated Successfully');
        return redirect()->back();
    } 
    public function removeCart(Product $product){
        $cart = new Cart(session()->get('cart'));
        $cart->remove($product->id);
        if($cart->totalQty <= 0){
            session()->forget('cart');
        }else{
            session()->put('cart',$cart); 
        }
        notify()->success('Cart Removed Successfully');
        return redirect()->back(); 
    }
    public function checkout($amount){
        if(session()->has('cart')){
            $cart = new Cart(session()->get('cart'));
        }
        else{
            $cart = null;
        }
        return view('checkout',compact('amount','cart'));
    }
    public function charge(Request $request){
        $charge = Stripe::charges()->create([
            'currency'=>"USD",
            'source'=>$request->stripeToken,
            'amount'=>$request->amount,
            'description'=>'Test'
        ]);
        $chargeId = $charge['id'];
        if(session()->has('cart')){
            $cart = new Cart(session()->get('cart'));
        }
        else{
            $cart = null;
        }
        \Mail::to(auth()->user()->email)->send(new Sendmail($cart));
        if($chargeId){
            auth()->user()->orders()->create([
                'cart'=>serialize(session()->get('cart'))
            ]);
            session()->forget('cart');
            notify()->success('Transaction Completed');
            return redirect()->to('/');
        }else{
            return redirect()->back();
        }
    }
    public function order(){
        $orders = auth()->user()->orders;
        $carts = $orders->transform(function($cart,$key){
            return unserialize($cart->cart);
        });
        return view('order',compact('carts'));
    }
}
