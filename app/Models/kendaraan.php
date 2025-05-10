<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kendaraan extends Model
{
    protected $table = 'kendaraan';

    protected $fillable = ['pelanggan_id', 'nomor_polisi', 'merek', 'tipe', 'tahun'];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function antrian()
    {
        return $this->hasMany(antrian::class);
    }
}
