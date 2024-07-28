<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function auth(LoginRequest $request)
    {
        $credentials = $request->only('user_email', 'password');
      
        if (auth()->attempt($credentials)) {

            //email verified
            if (auth()->user()->email_verified_at == null) {
                auth()->logout();

                return back()->with('errorMessage', 'Please verify your email first');
            }

            //user status
            if (! auth()->user()->user_status) {
                auth()->logout();

                return back()->with('errorMessage', 'Your account is not active. Please contact system support');
            }
            
            $role = auth()->user()->getRoles()[0];
            
            return to_route($role.'.index');
        }

        return back()->with([
            'errorMessage' => 'Invalid email or password',
        ])->withInput($request->except('password'));
    }

    public function logout()
    {
        auth()->logout();

        return to_route('index')->with([
            'successMessage' => 'Successfully logout',
        ]);
    }
}
