<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Farmer;
use App\Models\Fasilitator;
use Illuminate\Http\Request;

class MasterController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $desas = Desa::with(['kecamatan', 'targetArea.kabupaten', 'targetArea.province'])
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->paginate(10);

        return $desas;
    }

    public function farmer(Request $request)
    {
        $search = $request->input('search');

        $farmers = Farmer::with([
            'desa',
            'kecamatan',
            'kabupaten',
            'province',
            'managementUnit',
        ])
            ->leftJoin('target_areas', 'farmers.target_area', '=', 'target_areas.area_code')
            ->select('farmers.*', 'target_areas.name as target_area_name')
            ->when($search, function ($query) use ($search) {
                return $query->where('farmers.name', 'like', "%{$search}%");
            })
            ->paginate(10);

        return response()->json($farmers);
    }

    public function facilitator(Request $request)
    {
        $search = $request->input('search');

        $farmers = Fasilitator::with([
            'managementUnit',
        ])
            ->leftJoin('desas', 'field_facilitators.village', '=', 'desas.kode_desa')
            ->leftJoin('kabupatens', 'field_facilitators.city', '=', 'kabupatens.kabupaten_no')
            ->leftJoin('kecamatans', 'field_facilitators.kecamatan', '=', 'kecamatans.kode_kecamatan')
            ->leftJoin('provinces', 'field_facilitators.province', '=', 'provinces.province_code')
            ->leftJoin('target_areas', 'field_facilitators.target_area', '=', 'target_areas.area_code')
            ->select('field_facilitators.*', 'target_areas.name as target_area_name', 'desas.name as desas_name', 'kabupatens.name as kabupaten_name', 'kecamatans.name as kecamatan_name', 'provinces.name as province_name')
            ->when($search, function ($query) use ($search) {
                return $query->where('farmers.name', 'like', "%{$search}%");
            })
            ->paginate(10);

        return response()->json($farmers);
    }

}
