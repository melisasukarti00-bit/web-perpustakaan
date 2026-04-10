<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PeminjamanController extends Controller
{
    // =========================
    // 🔹 ANGGOTA
    // =========================

    public function peminjaman()
    {
        $data = Peminjaman::with('buku')
            ->where('user_id', Auth::id())
            ->get();

        return view('anggota.peminjaman', compact('data'));
    }

    // 🔹 klik kembalikan buku (anggota)
    public function kembalikan($id)
    {
        $pinjam = Peminjaman::findOrFail($id);

        if ($pinjam->user_id != Auth::id()) {
            return back()->with('error', 'Tidak boleh akses data ini');
        }

        $today = Carbon::now();
        $jatuhTempo = Carbon::parse($pinjam->jatuh_tempo);

        $denda = 0;
        if ($today->gt($jatuhTempo)) {
            $denda = $today->diffInDays($jatuhTempo) * 1000;
        }

        $pinjam->update([
            'tanggal_kembali' => $today,
            'status' => 'dikembalikan',
            'denda' => $denda
        ]);

        return back()->with('success', 'Buku dikembalikan');
    }

    // =========================
    // 🔹 PETUGAS
    // =========================

    public function indexPetugas()
    {
        $peminjaman = Peminjaman::with('user','buku')
            ->latest()
            ->get();

        return view('petugas.peminjaman', compact('peminjaman'));
    }

    // 🔹 KONFIRMASI PINJAM
    public function konfirmasi($id)
    {
        $pinjam = Peminjaman::with('buku')->findOrFail($id);

        if ($pinjam->status !== 'pending') {
            return back()->with('error', 'Sudah diproses');
        }

        if (!$pinjam->buku) {
            return back()->with('error', 'Buku tidak ditemukan');
        }

        if ($pinjam->buku->stok <= 0) {
            return back()->with('error', 'Stok habis');
        }

        $pinjam->buku->decrement('stok');

        $pinjam->update([
            'status' => 'approved',
            'tanggal_pinjam' => Carbon::now(),
            'jatuh_tempo' => Carbon::now()->addDays(7),
        ]);

        return back()->with('success', 'Berhasil dikonfirmasi');
    }

    // 🔹 KONFIRMASI PENGEMBALIAN
    public function konfirmasiPengembalian($id)
    {
        $pinjam = Peminjaman::with('buku')->findOrFail($id);

        if ($pinjam->status !== 'dikembalikan') {
            return back()->with('error', 'Belum dikembalikan');
        }

        if ($pinjam->buku) {
            $pinjam->buku->increment('stok');
        }

        $pinjam->update([
            'status' => 'selesai'
        ]);

        return back()->with('success', 'Selesai');
    }

    // =========================
    // 🔹 AJUKAN PINJAM
    // =========================

    public function store($id)
{
    $user_id = Auth::id();

    $cek = Peminjaman::where('user_id', $user_id)
        ->where('buku_id', $id)
        ->where('status', 'pending')
        ->first();

    if ($cek) {
        return back()->with('error', 'Sudah ada permintaan peminjaman');
    }

    Peminjaman::create([
        'user_id' => $user_id,
        'buku_id' => $id,
        'status' => 'pending',
    ]);

    return back()->with('success', 'Peminjaman berhasil diajukan');
}
}