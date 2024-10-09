<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    use HasFactory;

    protected $table = 'desas'; // Nama tabel

    protected $fillable = [
        'kode_desa ',
        'name',
        'kode_kecamatan',
        'kode_ta',
        'post_code',
        'proogram_year',
        'status'
    ];

}
