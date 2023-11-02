<?php

namespace App\Http\Controllers;

use App\Models\Regency;
use App\Models\Village;
use App\Models\District;
use Illuminate\Http\Request;

class DaerahController extends Controller
{
    public function fetchregency(Request $request){
        $data['regencys'] = Regency::where("province_id",$request->provinsi_id)->get(["name", "id"]);
        return response()->json($data);
    }
    public function fetchdistrict(Request $request){
        $data['district'] = District::where("regency_id",$request->regency_id)->get(["name", "id"]);
        return response()->json($data);
    }

    public function fetchvillage(Request $request){
        $data['village'] = Village::where("district_id",$request->district_id)->get(["name", "id"]);
        return response()->json($data);
    }

    
}
