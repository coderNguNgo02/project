<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {   
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $email = $request->input('ip_email');
        $pass = $request->input('ip_pass');

        if (Auth::attempt(['email' => $email, 'password' => $pass, 'level' => '1'])) {
            // Đăng nhập thành công
            return redirect()->route('index_admin');
        } else if (Auth::attempt(['email' => $email, 'password' => $pass, 'level' => '2'])) {
            Session::put('cartItems', []);
            return redirect()->route('index_user');
        } else {
            die('err');
        }
    }
}
