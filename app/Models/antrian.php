<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class antrian extends Model
{
    protected $table = 'antrian';

    protected $fillable = ['kendaraan_id', 'tanggal', 'waktu', 'keluhan', 'status'];

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }

    // public function riwayatServis()
    // {
    //     return $this->hasOne(RiwayatServis::class);
    // }
}
