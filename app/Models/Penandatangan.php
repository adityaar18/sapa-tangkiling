<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penandatangan extends Model
{
    protected $table = 'penandatangan';

    protected $fillable = [
        'nama',
        'nip',
        'jabatan_id',
        'pangkat',
    ];

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }
}
