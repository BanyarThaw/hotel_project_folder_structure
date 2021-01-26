<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index() {
        return view("Login.login");
    }

    public function login() {
        $input = request()->all();

        if(Auth::attempt ([
            'email' => $input['email'],
            'password' => $input['password']
        ])) {
            $user = Auth::user();
            return redirect('hotel-admin/contact');
        } else {
            return redirect('hotel-admin/login');
        }
    }

    public function register() {
        if(Auth::check()) 
            return redirect("hotel-admin/contact");

        return view("Login.register");
    }

    public function create() {
        $validatedData = request()->validate([
            "name" => "required",
            "email" => "required|email|unique:users",
            "password" => "required|min:6",
            "remember_token" => "required"
        ]);

        $user = new User();

        $user->name = request()->name;
        $user->email = request()->email;
        $user->password = Hash::make(request()->password);
        $user->remember_token = request()->remember_token;
        $user->save();
        return redirect('hotel-admin/contact');
    }

    public function logout() {
        Auth::logout();
        return redirect('hotel-admin/login');
    }
}
