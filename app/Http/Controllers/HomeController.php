<?php

namespace App\Http\Controllers;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Models\Cart;
use App\Models\Carts;

use Auth;

use Illuminate\Http\Request;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // if(auth()->user()->is_admin = 0){
        //     return redirect()->to('login');
        // }else{
        //     return redirect()->to('/');
        // }
         if(auth()->user()->is_user_verify_email = 1){
            return redirect()->to('login');
        }else{
            return redirect()->to('register');
        }
        // if(auth()->user()->is_user_verify_email = 1){
        //     return redirect()->to('login');
        // }else{
        //     return redirect()->to('/');
        // }
    }

    public function userLogin(LoginRequest $request)
    {
        if($request->validated())
        {
            $data = User::where("email",'=',$request->email)->get();

            print_r(count($data));

            if(count($data) == 0)
            {
                return redirect('login')->with('message', "User does not exists");
            }else{
                $userCredentials = $request->only('email', 'password');

                if(Auth::attempt($userCredentials)){

                    if(Auth::check())
                    {
                        $userId = Auth::id();
            
                        if (session()->has('cart')) {
                            $cart = new Cart(session()->get('cart'));
                        } else {
                            $cart = new Cart();
                        }
            
                        $cart_data = Carts::where('user_id',$userId)->get();
            
                        $cart->fetchCart($cart_data);
            
                        session()->put('cart',$cart);
            
                    }

                    return redirect('home')->with('message', "");
                    
                }else{
                    return redirect('login')->with('message', "Invalid Credentials");
                }
            }
            
        }

    } 
}
