<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(){
        $dataProv = DB::table('reg_provinces')->get();
        return view('pages.main',[
            'dataProv' => $dataProv
        ]);
    }

    public function jsonRegency(Request $request){
        $regency = DB::table('reg_regencies')->where("province_id",$request->provinceID)->pluck('id','name');
        return response()->json($regency);
    }

    public function jsonSubdistrict(Request $request){
        $subdistrict = DB::table('reg_districts')->where("regency_id",$request->regencyID)->pluck('id','name');
        return response()->json($subdistrict);
    }

    public function jsonVillage(Request $request){
        $village = DB::table('reg_villages')->where("district_id",$request->subdistrictID)->pluck('id','name');
        return response()->json($village);
    }

}
