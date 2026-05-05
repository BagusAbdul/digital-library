<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Buku extends Model
{
    protected $table = 'buku';
    protected $fillable = [
        'judul', 'penulis', 'penerbit', 'tahun_terbit', 'stok', 'cover', 'deskripsi'
    ];

    public function kategori(): BelongsToMany
    {
        return $this->belongsToMany(KategoriBuku::class, 'kategori_buku_relasi', 'buku_id', 'kategori_id');
    }

    public function ulasan(): HasMany
    {
        return $this->hasMany(UlasanBuku::class);
    }
}
