<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Desa;

class DesaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $desas = Desa::when($search, function ($query) use ($search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->paginate(10);

        return $desas;
    }
}
