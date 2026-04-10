<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class AnggotaController extends Controller
{

public function dashboard()
{
    $userId = Auth::id();

    // total peminjaman
    $totalPeminjaman = Peminjaman::where('user_id', $userId)->count();

    // sedang dipinjam (approved & belum dikembalikan)
    $sedangDipinjam = Peminjaman::where('user_id', $userId)
        ->where('status', 'approved')
        ->whereNull('tanggal_kembali')
        ->count();

    // sudah dikembalikan
    $sudahDikembalikan = Peminjaman::where('user_id', $userId)
        ->where('status', 'selesai')
        ->count();

    // total denda
    $totalDenda = Peminjaman::where('user_id', $userId)
        ->sum('denda') ?? 0;

    // riwayat terbaru
    $riwayat = Peminjaman::where('user_id', $userId)
        ->latest()
        ->take(5)
        ->get();

    return view('anggota.dashboard', compact(
        'totalPeminjaman',
        'sedangDipinjam',
        'sudahDikembalikan',
        'totalDenda',
        'riwayat'
    ));
}

    public function katalog(Request $request)
{
    $search = $request->query('search') ?? null;

    if ($search) {
        $buku = Buku::where('judul', 'like', "%{$search}%")->get();
    } else {
        $buku = Buku::all();
    }

    return view('anggota.katalog', compact('buku', 'search'));
}
    
    public function pinjam($id)
{
    $buku = \App\Models\Buku::findOrFail($id);

    // Cek stok
    if ($buku->stok <= 0) {
        return back()->with('error', 'Stok buku habis');
    }

    // Cek apakah user sudah meminjam buku yang sama
    $sudahPinjam = \App\Models\Peminjaman::where('user_id', Auth::id())
        ->where('buku_id', $buku->id)
        ->where('status', 'pending')
        ->exists();

    if ($sudahPinjam) {
        return back()->with('error', 'Kamu sudah meminjam buku ini');
    }

    // Buat peminjaman
    \App\Models\Peminjaman::create([
        'user_id'       => Auth::id(),
        'buku_id'       => $buku->id,
        'judul'         => $buku->judul,
        'tanggal_pinjam' => now(),
        'jatuh_tempo'   => now()->addDays(7),
        'status'        => 'pending',
        'denda'         => 0,
    ]);

    return redirect()->route('anggota.peminjaman')->with('success', 'Buku berhasil dipinjam!');
}

public function profile()
{
    $user = Auth::user();
    return view('anggota.profile', compact('user'));
}

public function updateProfile(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name'                  => 'required|string|max:255',
        'email'                 => 'required|email|unique:users,email,' . $user->id,
        'password'              => 'nullable|min:6|confirmed',
        'photo'                 => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    $user->name  = $request->name;
    $user->email = $request->email;

    if ($request->filled('password')) {
        $user->password = bcrypt($request->password);
    }

    if ($request->hasFile('photo')) {
        // Hapus foto lama
        if ($user->photo) {
            Storage::disk('public')->delete('photos/' . $user->photo);
        }

        $filename = time() . '_' . $request->file('photo')->getClientOriginalName();
        $request->file('photo')->storeAs('photos', $filename, 'public');
        $user->photo = $filename;
    }

    $user->save();

    return redirect()->route('anggota.profile')->with('success', 'Profil berhasil diperbarui!');
}
    public function pengembalian()
    {
    return view('anggota.pengembalian');
}
}