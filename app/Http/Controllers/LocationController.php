<?php

namespace App\Http\Controllers;

use App\Models\DevvnQuanhuyen;
use App\Models\DevvnTinhthanhpho;
use App\Models\DevvnXaphuongthitran;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LocationController extends Controller
{
    public function communeList($district)
    {
        $list = DevvnXaphuongthitran::where('maqh', $district)->get();
        return response()->json(['msg' => 'ok', 'data' => $list], Response::HTTP_OK);
    }
    public function districtList($province)
    {
        $list = DevvnQuanhuyen::where('matp', $province)->get();
        return response()->json(['msg' => 'ok', 'data' => $list], Response::HTTP_OK);
    }
    public function provinceList()
    {
        $list = DevvnTinhthanhpho::all();
        return response()->json(['msg' => 'ok', 'data' => $list], Response::HTTP_OK);
    }
}
