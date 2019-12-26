<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;


class CustomerLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:customer',['except' => ['logout']]);
    }
    
    public function showLoginForm()
    {
        return view('auth.customer-login');
    }
    
    public function login(Request $request)
    {
        //validate
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        
        //attempt to login
        if (Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            
            return redirect()->intended(route('customer.dashboard'));
        }
           
        return redirect()->back()->withInput($request->only('email','remember'));
    }
    
    public function logout()
    {
        Auth::guard('customer')->logout();
        return redirect('/');
    }
}