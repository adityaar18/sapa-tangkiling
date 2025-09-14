<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KetTidakMampu extends Model
{
    protected $table = 'ket_tidakmampu';

    protected $fillable = [
        'nama_ayah',
        'nama_ibu',
        'pekerjaan_ayah',
        'pekerjaan_ibu',
        'alamat',
        'kelurahan',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'keterangan',
        'detail_surat_id',
    ];

    public function detailSurat()
    {
        return $this->belongsTo(DetailSurat::class);
    }
}
