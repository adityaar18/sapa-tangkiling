<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AhliWaris extends Model
{
    protected $table = 'ahli_waris';

    protected $fillable = [
        'tanggal_meninggal',
        'tempat_meninggal',
        'nama_ahli_waris',
        'nik_ahli_waris',
        'jenis_kelamin',
        'umur',
        'hubungan_ahli_waris',
        'detail_surat_id',
    ];

    public function detailSurat()
    {
        return $this->belongsTo(DetailSurat::class);
    }
}
