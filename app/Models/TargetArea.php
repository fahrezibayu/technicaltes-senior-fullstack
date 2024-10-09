<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TargetArea extends Model
{
    use HasFactory;

    protected $table = 'target_areas';

    protected $fillable = [
        'area_code',
        'name',
        'mu_no',
        'active',
        'kabupaten_no',
        'province_code',
        'luas',
        'program_year'
    ];

    public function desas()
    {
        return $this->hasMany(Desa::class, 'kode_ta', 'area_code');
    }

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class, 'kabupaten_no', 'kabupaten_no');
    }

    public function province()
    {
        return $this->hasOneThrough(Province::class, Kabupaten::class, 'kabupaten_no', 'province_code', 'kabupaten_no', 'province_code');
    }
}
