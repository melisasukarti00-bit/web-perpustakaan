<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class PetugasController extends Controller
{
    public function dashboard()
    {
        return view('petugas.dashboard');
    }

    public function profile()
    {
        return view('petugas.buku');
    }
}