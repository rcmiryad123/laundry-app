<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class TopbarController extends Controller
{
    public function index()
    {
        // Ambil data pengguna yang sedang login
        $user = auth()->user();

        // Kirim data ke view topbar.blade.php
        return view('layouts.topbar', ['user' => $user]);
    }
}
