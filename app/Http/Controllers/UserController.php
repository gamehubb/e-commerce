<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Brand;
use App\Models\VerifyUser;
use Auth;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('is_admin', '!=', 1)->get();
        return view('admin.user.index', compact('users'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function verify(Request $request)
    {
        $token = $request->token;
        $verifyUser = User::where('email_verify_token', $token)->first();
        if (!is_null($verifyUser)) {
            if (!$verifyUser->email_verified) {
                $verifyUser->email_verified = 1;
                $verifyUser->email_verified_at = Carbon::now()->toDateTimeString();
                $verifyUser->save();
                return redirect()->route('login')->with('info', 'Your email is verified successfully. You can now login')->with('verifiedEmail', $verifyUser->email);
                // return view('login')->with('verifiedEmail',$user->email);
            } else {
                return redirect()->route('login')->with('infoconfirm', 'Your email already verified successfully. You can now login')->with('verifiedEmail', $verifyUser->email);
                // return 'Already Verified';
            }
        }
    }
    public function userAccountInfo()
    {
        $user_id = Auth::id();
        $userInfo = User::where('id', $user_id)->get()->first();
        $categories = Category::get();
        $brands = Brand::get();
        return view('auth.accountInfo', compact('userInfo', 'categories', 'brands'));
    }
}