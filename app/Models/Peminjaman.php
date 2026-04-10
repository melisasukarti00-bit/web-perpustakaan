<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    // Nama tabel sesuai database
     protected $table = 'peminjaman';

    protected $fillable = [
        'user_id',
        'buku_id',
        'judul',
        'tanggal_pinjam',
        'jatuh_tempo',
        'tanggal_kembali',
        'status',
        'denda'
    ];

    // Relasi ke Buku
    public function buku()
    {
        return $this->belongsTo(\App\Models\Buku::class, 'buku_id');
    }


    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }


}