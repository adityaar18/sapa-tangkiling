<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BidangSurat extends Model
{
    protected $table = 'bidang_surat';

    protected $fillable = [
        'nama_bidang',
        'kode',
        'deskripsi',
    ];
}
