<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function registerCompany()
    {
        return view('registerCompany');
    }

    public function login()
    {
        return view('login');
    }

    public function companyRegistration(UserRequest $request)
    {
        $reg = new Company;

        $reg->name = $request->name;
        $reg->email = $request->email;
        $reg->password = bcrypt($request->password);
        $reg->location = $request->location;
        $reg->phone = $request->phone;
        $reg->description = $request->description;
        $reg->save();
        return redirect('registerCompany')->with('status', 'Register succeed');
    }

    public function userLogIn(Request $request)
    {
        $name = $request->name;
        $password = $request->password;

        if($request->remember_me) {
            Cookie::queue('name_cookie', $name, 120);
            Cookie::queue('password_cookie', $password, 120);
        }

        $credentials = $request->validate([
            'email'  => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            return redirect('login')->with('status', 'Log in succeed');
        } else {
            return redirect('login')->with('status', 'Log in failed');
        }
    }
}
