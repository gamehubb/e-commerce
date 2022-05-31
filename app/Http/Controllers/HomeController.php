<?php

namespace App\Http\Controllers;

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
        $this->middleware('auth');
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
}
