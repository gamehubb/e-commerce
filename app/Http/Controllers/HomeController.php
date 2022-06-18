<?php

namespace App\Http\Controllers;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Models\Cart;
use App\Models\Carts;
use Illuminate\Support\Facades\Hash;

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
            $data = User::where("email",'=',$request->email)->get()->first();

            if($data == null)
            {
                return redirect('login')->with('message', "User does not exists");
            }elseif($data->count() > 0 && $data->email_verified == 0){
                return redirect('login')->with('message', "Please verify your email");
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

    public function userRegister(RegisterRequest $request)
    {
        $user_create = new User();
        $user_create->name = $request->name;
        $user_create->email = $request->email;
        $user_create->phone_number = $request->phone;
        $user_create->role = $request->role ? $request->role : '1';
        $user_create->password = Hash::make($request->password);
        $save = $user_create->save();
        $last_id = $user_create->id;
        $hash = $this->generateTokenVerify();
        $token = $last_id.$hash;
        $verifyURL = route('verify',['token'=>$token,'service'=>'Email_verification']);
        User::where('id',$last_id)->update([
            'email_verify_token'=>$token,
        ]);
        $message = 'Dear <b>'.$request->name.'</b>';
        $message = 'Thanks for singing up, we just need to verify your email address';
        $mail_data=[
            'recipient' =>$request->email,
            'fromEmail' =>'noreply@gamehubmyanmar.com',
            'fromName' =>'GameHub Myanmar',
            'subject' =>'Email Verification',
            'body'=>$message,
            'actionLink' =>$verifyURL,
        ];
        \Mail::send('email-template',$mail_data,function($message) use ($mail_data){
            $message->to($mail_data['recipient'])
                    ->from($mail_data['fromEmail'], $mail_data['fromName'])
                    ->subject($mail_data['subject']);
        });

        if($request->role == 2)
        {
            return redirect()->back();
        }else{
            return redirect('/login')->with('success','You need to verify your account. We have sent you an activation link, please check your mail');
        }

    } 

    public function generateTokenVerify()
    {
        $characters = 'MV4560GM678ZA0B0E1DABCDEFGHIJKLM';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 6; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
            $finalVerifynumber = 'GH' . $randomString;
        }
        return $finalVerifynumber;
    }
}
