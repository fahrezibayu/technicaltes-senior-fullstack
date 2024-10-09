<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    use HasFactory;

    protected $table = 'desas';

    protected $fillable = [
        'kode_desa',
        'name',
        'kode_kecamatan',
        'kode_ta',
        'post_code',
        'proogram_year',
        'status'
    ];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kode_kecamatan', 'kode_kecamatan');
    }

    public function targetArea()
    {
        return $this->belongsTo(TargetArea::class, 'kode_ta', 'area_code');
    }
}
