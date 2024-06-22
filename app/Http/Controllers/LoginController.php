<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }


    public function login_proses(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        Alert::success('Success', 'berhasil masuk.');
        if (Auth::attempt($data)) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('login')->with('failed', 'Email atau password salah!');
        }
    }

    public function logout()
    {
        Alert::success('success', 'Berhasil Logout.');
        Auth::logout();
        return redirect()->route('login')->with('success', 'Kamu telah Logout');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function register_proses(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
        ]);

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = hash::make($request->password);

        User::create($data);
        $login = [
            'email' => $request->email,
            'password' => $request->password
        ];

        Alert::success('Success', 'Berhasil masuk.');
        if (Auth::attempt($login)) {
        } else {
            return redirect()->route('login')->with('failed', 'Email atau password salah!');
        }
    }
}
