<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showAdmin()
    {
        return view('dashboard/admin-dashboard');
    }

    // public function index()
    // {
    //     $kategoriCount = Kategori::count();
    //     $newsCount = News::count();
    //     $userCount = User::count();

    //     return view('dashboard/admin-dashboard', compact('kategoriCount', 'newsCount', 'userCount'));
    // }
    // public function showUsers()
    // {
    //     $users = User::all();
    //     return view('dashboard/admin-users', compact('users'));
    // }
}
