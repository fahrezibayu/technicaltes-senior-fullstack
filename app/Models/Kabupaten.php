<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    use HasFactory;

    protected $table = 'kabupatens';

    protected $fillable = [
        'kabupaten_no',
        'name',
        'province_code',
        'kab_code'
    ];

    public function targetAreas()
    {
        return $this->hasMany(TargetArea::class, 'kabupaten_no', 'kabupaten_no');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_code', 'province_code');
    }
}
