<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class KategoriBuku extends Model
{
    protected $table = 'kategori_buku'; // Menegaskan nama tabel
    protected $fillable = ['nama_kategori'];

    public function buku(): BelongsToMany
    {
        return $this->belongsToMany(Buku::class, 'kategori_buku_relasi', 'kategori_id', 'buku_id');
    }
}
