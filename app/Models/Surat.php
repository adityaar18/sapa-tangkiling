<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    protected $table = 'surat';

    protected $fillable = [
        'kode_unik',
        'nomor_surat',
        'tanggal_surat',
        'file_docx_path',
        'file_pdf_path',
        'persetujuan',
        'catatan',
        'bidang_surat_id',
        'jenis_surat_id',
        'penandatangan_id'
    ];

    public function bidangSurat()
    {
        return $this->belongsTo(BidangSurat::class);
    }

    public function jenisSurat()
    {
        return $this->belongsTo(JenisSurat::class);
    }

    public function penandatangan()
    {
        return $this->belongsTo(Penandatangan::class);
    }

    public function detailSurat()
    {
        return $this->hasOne(DetailSurat::class);
    }
}
