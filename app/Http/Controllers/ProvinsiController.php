<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Village;

class ProvinsiController extends Controller
{
    public function kabupaten(Request $request)
    {
        $cities = City::where('province_id', $request->get('id'))
            ->pluck('name', 'id');

        return response()->json($cities);
    }

    public function kecamatan(Request $request)
    {
        $cities = District::where('city_id', $request->get('id'))
            ->pluck('name', 'id');

        return response()->json($cities);
    }

    public function kelurahan(Request $request)
    {
        $cities = Village::where('district_id', $request->get('id'))
            ->pluck('name', 'id');

        return response()->json($cities);
    }
}
