<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Farmer;
use App\Models\Fasilitator;
use App\Models\Kecamatan;
use App\Models\Kabupaten;
use App\Models\Province;
use Illuminate\Http\Request;

class MasterController extends Controller
{
    public function index(Request $request)
    {
        $query = Desa::with(['kecamatan', 'kecamatan.kabupaten', 'kecamatan.kabupaten.province', 'targetArea']);

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('kecamatan')) {
            $query->where('kode_kecamatan', $request->kecamatan);
        }

        if ($request->filled('provinsi')) {
            $query->whereHas('kecamatan.kabupaten.province', function ($q) use ($request) {
                $q->where('province_code', $request->provinsi);
            });
        }

        if ($request->filled('kabupaten')) {
            $query->whereHas('kecamatan.kabupaten', function ($q) use ($request) {
                $q->where('kabupaten_no', $request->kabupaten);
            });
        }

        $desas = $query->paginate(10);

        return $desas;
    }

    public function farmer(Request $request)
    {
        $search = $request->input('search');

        $query = Farmer::with([
            'desa',
            'kecamatan',
            'kabupaten',
            'province',
            'managementUnit',
        ])
            ->leftJoin('target_areas', 'farmers.target_area', '=', 'target_areas.area_code')
            ->select('farmers.*', 'target_areas.name as target_area_name');

        if ($request->filled('search')) {
            $query->where('farmers.name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('kecamatan')) {
            $query->where('farmers.kecamatan', $request->kecamatan);
        }

        if ($request->filled('provinsi')) {
            $query->whereHas('province', function ($q) use ($request) {
                $q->where('province_code', $request->provinsi);
            });
        }

        if ($request->filled('kabupaten')) {
            $query->whereHas('kabupaten', function ($q) use ($request) {
                $q->where('kabupaten_no', $request->kabupaten);
            });
        }

        $farmers = $query->paginate(10);

        return response()->json($farmers);
    }

    public function facilitator(Request $request)
    {
        $search = $request->input('search');

        $query = Fasilitator::with([
            'managementUnit',
        ])
            ->leftJoin('desas', 'field_facilitators.village', '=', 'desas.kode_desa')
            ->leftJoin('kabupatens', 'field_facilitators.city', '=', 'kabupatens.kabupaten_no')
            ->leftJoin('kecamatans', 'field_facilitators.kecamatan', '=', 'kecamatans.kode_kecamatan')
            ->leftJoin('provinces', 'field_facilitators.province', '=', 'provinces.province_code')
            ->leftJoin('target_areas', 'field_facilitators.target_area', '=', 'target_areas.area_code')
            ->select('field_facilitators.*', 'target_areas.name as target_area_name', 'desas.name as desas_name', 'kabupatens.name as kabupaten_name', 'kecamatans.name as kecamatan_name', 'provinces.name as province_name');

        if ($request->filled('search')) {
            $query->where('field_facilitators.name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('kecamatan')) {
            $query->where('field_facilitators.kecamatan', $request->kecamatan);
        }

        if ($request->filled('provinsi')) {
            $query->whereHas('province', function ($q) use ($request) {
                $q->where('province_code', $request->provinsi);
            });
        }

        if ($request->filled('kabupaten')) {
            $query->whereHas('kabupaten', function ($q) use ($request) {
                $q->where('kabupaten_no', $request->kabupaten);
            });
        }

        $facilitator = $query->paginate(10);

        return response()->json($facilitator);
    }

    public function kecamatan(Request $request)
    {
        $kecamatan = Kecamatan::with([
            'kabupaten',
        ])->get();

        return $kecamatan;
    }

    public function kabupaten(Request $request)
    {
        $kabupaten = Kabupaten::with([
            'province',
        ])->get();

        return $kabupaten;
    }

    public function province(Request $request)
    {
        $province = Province::all();

        return $province;
    }

}
