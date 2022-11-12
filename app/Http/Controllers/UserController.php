<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Auth;
use Carbon\Carbon;
use Hash;
use Laravel\Socialite\Facades\Socialite;

use DB;


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

    public function dashboard()
    {
        $products = Product::get()->count();
        $users = User::where(['is_admin' => '0', 'role' => '1'])->get()->count();
        $vendors = User::where(['is_admin' => '0', 'role' => '2'])->get()->count();
        $pending = User::where(['is_admin' => '0', 'role' => '1' ,'email_verified' => '0'])->get()->count();
        $orders = Order::count();
        $order_data = Order::orderBy('created_at','DESC')->get();
        $sold_products = OrderItem::get();
        $monthly_amounts = Order::select(DB::raw("(SUM(total_amount)) as total_amount"),DB::raw("MONTHNAME(created_at) as monthname"))
                            ->groupBy('monthname')
                            ->orderBy('monthname','DESC')
                            ->get();
        foreach ($monthly_amounts as $ma) {

            $dataPoints[] =[ 
                "months" =>
                $ma['monthname']
                ,
                "data" =>
                $ma['total_amount']
                ,
        ];

        }

        return view('admin.dashboard')->with(['monthly_amount' => $dataPoints,'sold_products' => $sold_products,'order_data'=> $order_data,'products'=>$products,'users' => $users, 'vendors' => $vendors, 'orders' => $orders, 'pending' => $pending]);
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
    public function destroy(Request $request)
    {
        User::where('id',$request->user_id)->update(['status' => '0']);
        notify()->success('User Account Delete');
        return redirect('/auth/users');
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
    public function userAccountInfo(Request $request)
    {
        $user_id = Auth::id();
        $userInfo = User::where('id', $user_id)->get()->first();
        $categories = Category::get();
        $brands = Brand::get();
        return view('auth.accountInfo', compact('userInfo', 'categories', 'brands'));
    }

    public function adminuserAccountInfo($id)
    {
        $user_id = $id;
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

    public function behaviourOfStatus(Request $request){
        $obj = new \stdClass();
        $obj = User::where('id', $request->id)->update(['email_verified' => $request->status]);
        return $obj;
    }

    public function statusToggle(Request $request){
        $obj = new \stdClass();
        $obj = User::where('id', $request->id)->update(['status' => $request->status]);
        return $obj;
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->stateless()->user();
        } catch (\Exception $e) {
            print_r($e);
        }
        // only allow people with @company.com to login
    
        // check if they're an existing user
        $existingUser = User::where('email', $user->email)->first();
        if($existingUser){
            // log them in
            auth()->login($existingUser, true);
        } else {
            // create a new user
            $newUser                  = new User;
            $newUser->name            = $user->name;
            $newUser->email           = $user->email;
            $newUser->google_id       = $user->id;
            $newUser->avatar          = $user->avatar;
            $newUser->avatar_original = $user->avatar_original;
            $newUser->email_verified = 1;
            $newUser->email_verified_at = Carbon::now()->toDateTimeString();
            $newUser->save();
            auth()->login($newUser, true);
        }
        return redirect()->to('/home');
    }

    public function checkPassword(Request $request)
    {   
        $user_id = $request->id;

        $result = User::where('id',$user_id)->value('password');

        if($result == null){
            echo '0';
        }else{
            echo '1';
        }

    }

    public function savePassword(Request $request)
    {
    
       $password = Hash::make($request->password);
       $user_id = $request->user_id;

       User::where('id',$user_id)->update(['password' => $password]);

       return redirect()->to('/home');
    }
}