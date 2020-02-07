<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;


class TechsupportLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:techsupport',['except' => ['logout']]);
    }
    
    public function showLoginForm()
    {
        return view('auth.techsupport-login');
    }
    
    public function login(Request $request)
    {
        //validate
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        
        //attempt to login
        if (Auth::guard('techsupport')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            
            return redirect('/techsupport/tickets');
        }
           
        return redirect()->back()->withInput($request->only('email','remember'))->withErrors('Invalid email/password!');
    }
    
    public function logout()
    {
        Auth::guard('techsupport')->logout();
        return redirect('/techsupport/login');
    }
}