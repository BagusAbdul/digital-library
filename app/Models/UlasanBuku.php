<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UlasanBuku extends Model
{
    protected $table = 'ulasan_buku';
    protected $fillable = ['user_id', 'buku_id', 'ulasan', 'rating'];
}
