<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'buku';

    protected $fillable = [
        
        'judul',
        'stok',
        'tahun',
        'pengarang',
        'penerbit',
        'cover',
    ];
    public function peminjaman()
{
    return $this->hasMany(Peminjaman::class);
}


}