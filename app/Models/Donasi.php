<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detailDonasi()
    {
        return $this->hasMany(DetailDonasi::class);
    }

    protected $fillable = [
        'image',
        'judul',
        'deskripsi',
        'nomor_hp',
        'nama_rekening',
        'nomor_rekening',
        'bank',
    ];
}
