<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pelanggan extends Model
{
    protected $table = 'pelanggan';

    protected $fillable = ['nama', 'no_hp', 'alamat'];

    public function kendaraan()
    {
        return $this->hasMany(Kendaraan::class);
    }

}
