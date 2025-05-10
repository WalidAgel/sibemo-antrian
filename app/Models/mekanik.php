<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mekanik extends Model
{
    protected $table = 'mekanik';

    protected $fillable = ['nama', 'spesialisasi'];

    // public function riwayatServis()
    // {
    //     return $this->hasMany(RiwayatServis::class);
    // }
}
