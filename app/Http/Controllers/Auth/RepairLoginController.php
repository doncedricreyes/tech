<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;


class RepairLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:repair',['except' => ['logout']]);
    }
    
    public function showLoginForm()
    {
        return view('auth.repair-login');
    }
    
    public function login(Request $request)
    {
        //validate
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required|min:6'
        ]);
        
        //attempt to login
        if (Auth::guard('repair')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            
            return redirect('/repair/repairs');
        }
           
        return redirect()->back()->withInput($request->only('email','remember'))->withErrors('Invalid email/password!');
    }
    
    public function logout()
    {
        Auth::guard('repair')->logout();
        return redirect('/repair');
    }
}