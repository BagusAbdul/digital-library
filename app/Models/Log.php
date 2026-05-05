<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    public $timestamps = false; // Karena kita menggunakan useCurrent() di migration
    protected $fillable = ['user_id', 'aktivitas'];
}
