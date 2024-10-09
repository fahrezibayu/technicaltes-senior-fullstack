<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManagementUnit extends Model
{
    use HasFactory;


    protected $table = 'managementunits';

    protected $fillable = [
        'mu_no',
        'name',
        'program_year',
        'active'
    ];

    public function farmers()
    {
        return $this->hasMany(Farmer::class, 'mu_no', 'mu_no');
    }
}
