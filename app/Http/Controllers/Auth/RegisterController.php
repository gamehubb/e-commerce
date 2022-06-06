<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\VerifyUser;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // $user_create = User::create([
        //     'name' => $data['name'],
        //     'email' => $data['email'],
        //     'password' => Hash::make($data['password']),
        // ]);
        $user_create = new User();
        $user_create->name = $data['name'];
        $user_create->email = $data['email'];
        $user_create->password = Hash::make($data['password']);
        $save = $user_create->save();
        // $user = User::all();
        $last_id = $user_create->id;
        // $token = $last_id.hash('GHM256',\Str::random(120));
        $hash = $this->generateTokenVerify();
        $token = $last_id . $hash;
        $verifyURL = route('verify', ['token' => $token, 'service' => 'Email_verification']);
        VerifyUser::create([
            'user_id' => $last_id,
            'token' => $token,
        ]);
        $message = 'Dear <b>' . $data['name'] . '</b>';
        // $message = 'Dear YeLinnAung';
        $message = 'Thanks for singing up, we just need to verify your email address';
        $mail_data = [
            'recipient' => $data['email'],
            'fromEmail' => $data['email'],
            'fromName' => $data['name'],
            'subject' => 'Email Verification',
            'body' => $message,
            'actionLink' => $verifyURL,
        ];
        \Mail::send('email-template', $mail_data, function ($message) use ($mail_data) {
            $message->to($mail_data['recipient'])
                ->from($mail_data['fromEmail'], $mail_data['fromName'])
                ->subject($mail_data['subject']);
        });

        $this->guard()->login($user_create);

        // if($save){
        // return redirect()->back()->with('success','You need to verify your account. We have sent you an activation link, please check your mail');
        return redirect('/register')->with('success', 'You need to verify your account. We have sent you an activation link, please check your mail');
        // return $user_create;
        // return redirect('register')->with('success','Please Check Your Email');
        // }else{
        // return redirect('/register')->with('fail','Somethig went wrong');
        // return redirect('register')->with('fail','Somethig went wrong');
        // }
        return $save;
    }
    public function generateTokenVerify()
    {
        $characters = 'MV4560GM678ZA0B0E1D';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 6; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
            $finalVerifynumber = 'GH#' . $randomString;
        }
        return $finalVerifynumber;
    }
}