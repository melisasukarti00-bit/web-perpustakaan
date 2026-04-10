<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\User;
use App\Models\Peminjaman;

class PetugasController extends Controller
{
    // 🔹 DASHBOARD
    public function dashboard()
    {
        $totalBuku = Buku::count();
        $totalAnggota = User::where('role','anggota')->count();
        $bukuDipinjam = Peminjaman::where('status','approved')->count();
        $bukuTerlambat = Peminjaman::where('status','approved')
            ->whereDate('jatuh_tempo','<', now())
            ->count();

        // Ambil 5 peminjaman terbaru
        $laporan = Peminjaman::with('user')
            ->orderBy('tanggal_pinjam','desc')
            ->take(5)
            ->get();

        return view('petugas.dashboard', compact(
            'totalBuku',
            'totalAnggota',
            'bukuDipinjam',
            'bukuTerlambat',
            'laporan'
        ));
    }

    // 🔹 DATA ANGGOTA
    public function anggota()
    {
        $anggota = User::where('role', 'anggota')->get();

        return view('petugas.anggota', compact('anggota'));
    }

    public function konfirmasiKembali($id)
    {
    $peminjaman = Peminjaman::findOrFail($id);

    $peminjaman->status = 'selesai';
    $peminjaman->save();

    return back()->with('success', 'Pengembalian dikonfirmasi');
    }
}