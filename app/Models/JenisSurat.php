<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisSurat extends Model
{
    protected $table = 'jenis_surat';

    protected $fillable = [
        'nama_jenis',
        'deskripsi',
        'bidang_surat_id',
        'template_id',
    ];

    public function bidangSurat()
    {
        return $this->belongsTo(BidangSurat::class, 'bidang_surat_id');
    }

    public function templateSurat()
    {
        return $this->belongsTo(TemplateSurat::class, 'template_id');
    }
}
