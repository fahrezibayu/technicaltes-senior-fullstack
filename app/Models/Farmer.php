<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farmer extends Model
{
    use HasFactory;

    protected $table = 'farmers';

    protected $fillable = [
        'farmer_no',
        'name',
        'nickname',
        'birthday',
        'religion',
        'ethnic',
        'origin',
        'gender',
        'join_date',
        'number_family_member',
        'ktp_no',
        'phone',
        'rt',
        'rw',
        'address',
        'total_land_owned',
        'legal_land_categories',
        'project_model',
        'village',
        'kecamatan',
        'city',
        'province',
        'post_code',
        'mu_no',
        'target_area',
        'group_no',
        'mou_no',
        'main_income',
        'side_income',
        'avg_income_permonth',
        'is_farmer_partner_helping',
        'avg_food_outcome_monthly',
        'avg_farming_income_yearly',
        'avg_wood_bussines_income_yearly',
        'avg_farm_income_yearly',
        'avg_fishery_income_yearly',
        'avg_nature_tourism_yearly',
        'avg_other_source_income_yearly',
        'general_medicine_source',
        'general_food_source',
        'general_drink_water_source',
        'general_clean_water_source',
        'marrital_status',
        'main_job',
        'side_job',
        'education',
        'non_formal_education'
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
