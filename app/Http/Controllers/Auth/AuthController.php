<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Input;
use Mail;
use Url;
// use App\Url;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
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
            'name' => 'Required|max:255',
            'email' => 'Required|email|max:255|unique:users',
            'password' => 'Required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        
        $validator = Validator::make($data, [
            'name' => 'Required|max:255',
            'email' => 'Required|email|max:255|unique:users',
            'password' => 'Required|min:6|confirmed',
        ]);
        if($validator->fails())
        {// validator dosn't work
            $errors = $validator->messages();
            return view ('auth.register',compact('errors'));
        }
        else
        {
            $name = $data['name'];;
            $email = $data['email'];
            $confirmation_code = str_random(30);
            // die($confirmation_code);
            if (Input::hasFile('image') && Input::file('image')->isValid()) 
            {
                $file = Input::file('image');
                $destinationPath = public_path(). '/users_pictures/';
                $extension = Input::file('image')->getClientOriginalExtension();
                $filename = $data['name'].'.'.$extension;
                Input::file('image')->move($destinationPath, $filename);
                $imagepath = '/users_pictures/'.$filename;
                $user =  User::create([
                'name' => $data['name'],
                'image' => $imagepath,
                'email' => $data['email'],
                'confirmation_code' => $confirmation_code,
                'is_active' => 0,
                'password' => bcrypt($data['password']),
                ]);
            }
            else
            {
                $user =  User::create([
                'name' => $data['name'],
                'image' => '/users_pictures/co.png',
                'email' => $data['email'],
                'confirmation_code' => $confirmation_code,
                'is_active' => 0,
                'password' => bcrypt($data['password']),
                ]);
            }

            if($user)
            {
                //send vertification code to user
            Mail::send('auth.emails.verify', array('link'=>route('confirmation_path',$confirmation_code),'confirmation_code'=>$confirmation_code,'name'=> $data['name']), function($message) use ($user){
                $message->to($user->email, $user->name)
                        ->subject('Verify your email address');
            });
            // Flash::message('Thanks for signing up! Please check your email.');
            $massage = 'Thanks for signing up! Please check your email.';
            die($massage);
            return view('auth.register',compact('massage'));

            }
        }

        
        

        
    }
    public function confirm($confirmation_code)
    {
        if( ! $confirmation_code)
        {
            throw new InvalidConfirmationCodeException;
        }

        $user = User::whereConfirmationCode($confirmation_code)->first();

        if ( ! $user)
        {
            throw new InvalidConfirmationCodeException;
        }

        $user->confirmed = 1;
        $user->active = 1;
        $user->confirmation_code = null;
        $user->save();

        // Flash::message('You have successfully verified your account.');

        // return Redirect::route('login_path');
        $massage = 'You have successfully verified your account.';
        return view('/auth.login',compact('massage'));;
    }
}
