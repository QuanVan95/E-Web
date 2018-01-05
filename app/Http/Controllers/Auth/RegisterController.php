<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/';

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
    public function showRegistrationForm()
    {
        return view('admin.auth.register');
    }

    protected function validator(array $data)
    {
        $validator = Validator::make($data, [
            'name' => 'required',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|confirmed',
        ],
        [
            'name.required'      => 'Name is required',
            'email.required'     => 'Email is required',
            'email.email'        => 'Email is invalid',
            'password.required'  => 'Password is required',
            'password.confirmed' => 'Password confirmation does not match',
        ]
        );
        return $validator;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function register(Request $request)
    {
        $validator = $this->validator($request->all());
        if($validator->fails()){
          return back()->withErrors($validator);
        };

        $register = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        if($register){
            Session::flash('success', 'Register successfully');
            return redirect(route('login'));
        }else{
            return back()->withErrors(['message' => 'Error Register']);
        }
    }
}
