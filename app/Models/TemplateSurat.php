<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemplateSurat extends Model
{
    protected $table = 'template_surat';

    protected $fillable = [
        'nama',
        'file_path',
        'deskripsi',
    ];

    public function jenisSurat()
    {
        return $this->hasMany(JenisSurat::class, 'template_id');
    }
}
