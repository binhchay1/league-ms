<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;
use Session;
use App\Models\User;

class AuthController extends Controller
{

    public function login()
    {
        return view('auth.login');
    }

    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|max:255|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');


        if (Auth::attempt($credentials)) {
            $request->session()->put('email', $credentials['email']);

            if (Auth::user()->role == Role::ADMIN) {
                return redirect()->intended('dashboard')
                    ->withSuccess('Signed in');
            } else {
                return redirect('/')
                    ->withSuccess('Signed in');
            }
        }

        return redirect("login")->withSuccess('Login details are not valid');
    }

    public function registration()
    {
        return view('auth.register');
    }

    public function customRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();
        $check = $this->create($data);

        return redirect("dashboard")->withSuccess('You have signed-in');
    }

    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    public function dashboard()
    {
        if (Auth::check()) {
            return view('layout.admin_layout');
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }

    public function signOut()
    {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
}
