<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailSurat extends Model
{
    protected $table = 'detail_surat';

    protected $fillable = [
        'surat_id',
        'nama',
        'nik',
        'path_ktp',
        'no_kk',
        'path_kk',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'pekerjaan',
        'alamat',
        'rt',
        'rw',
        'status_perkawinan',
    ];

    public function surat()
    {
        return $this->belongsTo(Surat::class, 'surat_id');
    }
}
