<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Session;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    protected function validator(array $data)
    {
        $validator = Validator::make($data,
            [
                'email' => 'required|email',
                'password' => 'required'
            ],
            [
                'email.required' => 'Email is required',
                'email.email' => 'Email is invalid',
                'password.required' => 'Password is required',
            ]
        );
        return $validator;
    }

    protected function login(Request $request){
        $validator = $this->validator($request->all());
        if($validator->fails()){
            return back()->withErrors($validator);
        }
        $auth = Auth::attempt([
           'email'    => $request->email,
           'password' => $request->password,
        ], $request->remember == 1 ? true : false);
        if($auth){
            return redirect(route('home'));
        }else{
            return back()->withErrors(['message' => 'Incorrect username or password']);
        }
    }

    protected function logout(){
        Auth::logout();
        return redirect(route('login'));
    }

}
