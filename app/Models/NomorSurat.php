<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NomorSurat extends Model
{
    protected $table = 'nomor_surat';

    protected $fillable = [
        'bidang_surat_id',
        'nomor_surat',
        'tahun',
    ];

    public function bidangSurat()
    {
        return $this->belongsTo(BidangSurat::class);
    }
}
