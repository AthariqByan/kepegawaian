<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Posisi;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showAdmin()
    {
        return view('dashboard/admin-dashboard');
    }

    public function index()
    {
        $pegawaiCount = Pegawai::count();
        $posisiCount = Posisi::count();

        $jumlahPegawai = Pegawai::count();
        $jumlahPosisi = Posisi::count();

        return view('dashboard/admin-dashboard', compact('pegawaiCount', 'posisiCount', 'jumlahPegawai', 'jumlahPosisi'));
    }
    public function showUsers()
    {
        $users = User::all();
        return view('dashboard/admin-users', compact('users'));
    }
}
