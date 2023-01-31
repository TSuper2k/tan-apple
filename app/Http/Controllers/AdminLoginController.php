<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminLoginController extends Controller
{
    public function loginAdmin(){
        if(auth()->check()){
            return redirect()->to('home');
        }
        return view('admin.login.login');
    }
    
    public function postLoginAdmin(Request $request){
        $remember = $request->has('remember_me') ? true : false;
        if(auth()->attempt([
            'email' => $request->email,
            'password' => $request->password
        ], $remember)){
            return redirect()->to('admin.home');
        }
    }
}
