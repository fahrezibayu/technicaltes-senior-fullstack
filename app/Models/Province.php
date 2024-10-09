<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    protected $table = 'provinces';

    protected $fillable = [
        'province_code',
        'name'
    ];

    public function targetAreas()
    {
        return $this->hasMany(TargetArea::class, 'province_code', 'province_code');
    }

    public function kabupatens()
    {
        return $this->hasMany(Kabupaten::class, 'province_code', 'province_code');
    }
}
