<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Brand;
use App\Models\VerifyUser;
use Auth;
use Carbon\Carbon;
use Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where(['is_admin' =>  0, 'role' => 1])->get();
        return view('admin.user.index', compact('users'));
    }

    public function vendorList()
    {
        $vendors = User::where('role', '=', '2')->get();
        return view('admin.vendor.index', compact('vendors'));
    }

    public function vendorNew()
    {
        return view('admin.vendor.new');
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
    public function changeAccountInfo()
    {
        return view('auth.changeaccountInfo');
    }
    public function changeAccountInfoPost(Request $request)
    {
        $user_id = Auth::id();
        $useremails  = User::where('email', $request->get("email"))->where('id', '!=', $user_id)->get()->first();
        if ($useremails) {
            return redirect()->back()->with("message", "Email already used ");
        }
        $user = Auth::user();
        $user->email = $request->get('email');
        $user->name = $request->get('name');
        $user->phone_number = $request->get('phone');
        $user->save();
        $request->session()->flush();
        return redirect('login')->with('infoconfirm', 'User Info Changed Successfully.Login again to continue.');
    }
    public function changePassword()
    {
        return view('auth.passwords.changepassword');
    }
    public function changePasswordPost(Request $request)
    {
        if (!(Hash::check($request->get('oldpassword'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("message", "Your current password does not matches with the password.");
        }
        if ($request->get('newpassword') != $request->get('confpasowrd')) {
            // Current password and new password same
            return redirect()->back()->with("message", "New Password cannot be same as your current password.");
        }
        $user = Auth::user();
        $user->password = bcrypt($request->get('newpassword'));
        $user->save();
        $request->session()->flush();
        return redirect('login')->with('infoconfirm', 'Password Changed Successfully.Login again to continue.');
    }
}