<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fasilitator extends Model
{
    use HasFactory;

    protected $table = 'field_facilitators';

    protected $fillable = [
        'ff_no',
        'fc_no',
        'name',
        'birthday',
        'religion',
        'gender',
        'join_date',
        'ktp_no',
        'phone',
        'rt',
        'rw',
        'address',
        'village',
        'kecamatan',
        'city',
        'province',
        'post_code',
        'mu_no',
        'target_area',
        'working_area',
        'bank_account',
        'bank_branch',
        'bank_name',
        'marrital'
    ];

    public function managementUnit()
    {
        return $this->belongsTo(ManagementUnit::class, 'mu_no', 'mu_no');
    }

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'village', 'kode_desa');
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan', 'kode_kecamatan');
    }

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class, 'city', 'kabupaten_no');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'province', 'province_code');
    }

    public function targetArea()
    {
        return $this->belongsTo(TargetArea::class, 'target_area', 'area_code');
    }
}
