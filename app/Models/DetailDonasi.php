<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailDonasi extends Model
{
    public function donasi()
    {
        return $this->belongsTo(Donasi::class);
    }

    protected $fillable = [
        'nama_donatur',
        'nominal_donasi',
    ];
}
