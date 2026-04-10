<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KepalaController extends Controller
{
        // =========================
    // DASHBOARD KEPALA
    // =========================
public function dashboard()
{
    $totalBuku = Buku::count();
    $totalPetugas = User::where('role', 'petugas')->count();
    $totalAnggota = User::where('role', 'anggota')->count();

    $bukuDipinjam = Peminjaman::where('status', 'approved')->count();
    $pengembalianMenunggu = Peminjaman::where('status', 'pending')->count();

    // ambil 5 peminjaman terbaru
    $riwayatPeminjaman = Peminjaman::with('user', 'buku')
        ->orderBy('tanggal_pinjam', 'desc')
        ->take(5)
        ->get();

    return view('kepala.dashboard', compact(
        'totalBuku',
        'totalPetugas',
        'totalAnggota',
        'bukuDipinjam',
        'pengembalianMenunggu',
        'riwayatPeminjaman'
    ));
}
    // =========================
    // DAFTAR PETUGAS
    // =========================
    public function index()
    {
        $petugas = User::where('role', 'petugas')->get();
        return view('kepala.petugas.index', compact('petugas'));
    }

    // =========================
    // FORM TAMBAH PETUGAS
    // =========================
    public function create()
    {
        return view('kepala.petugas.create');
    }

    // =========================
    // SIMPAN PETUGAS BARU
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'petugas',
        ]);

        return redirect()->route('kepala.petugas.index')
                         ->with('success', 'Petugas berhasil ditambahkan');
    }

    // =========================
    // FORM EDIT PETUGAS
    // =========================
    public function edit($id)
    {
        $petugas = User::findOrFail($id);
        return view('kepala.petugas.edit', compact('petugas'));
    }

    // =========================
    // UPDATE PETUGAS
    // =========================
    public function update(Request $request, $id)
    {
        $petugas = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
        ]);

        $petugas->name = $request->name;
        $petugas->email = $request->email;
        if ($request->password) {
            $petugas->password = Hash::make($request->password);
        }
        $petugas->save();

        return redirect()->route('kepala.petugas.index')
                         ->with('success', 'Petugas berhasil diperbarui');
    }

    // =========================
    // HAPUS PETUGAS
    // =========================
    public function destroy($id)
    {
        $petugas = User::findOrFail($id);
        $petugas->delete();

        return redirect()->route('kepala.petugas.index')
                         ->with('success', 'Petugas berhasil dihapus');
    }

    // =========================
    // LAPORAN PEMINJAMAN
    // =========================
    public function laporan()
    {
        $laporan = Peminjaman::with(['user', 'buku'])
            ->orderBy('tanggal_pinjam', 'desc')
            ->get();

        return view('kepala.laporan', compact('laporan'));
    }

        public function dataBuku()
    {
        $buku = Buku::all(); 

        return view('kepala.buku', compact('buku'));
    }
}