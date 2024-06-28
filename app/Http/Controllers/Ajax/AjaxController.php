<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function getRegions(Request $request)
    {
        $query = $request->get('q');
        $data = \App\Models\Region::where('name', 'like', '%' . $query . '%')->orWhere('code', 'like', '%' . $query . '%')
            ->get();
        return response()->json($data);

    }

    public function getSubRegions(Request $request)
    {
        $query = $request->get('q');
        $q = \App\Models\SubRegion::query();
        if($request->region_id){
            $q->where('region_id',$request->region_id);
        }
        if($query){
            $q->where('name', 'like', '%' . $query . '%')->orWhere('code', 'like', '%' . $query . '%');
        }

        $data = $q->get();
        return response()->json($data);

    }
    public function getCountries(Request $request)
    {
        $query = $request->get('q');
        $q = \App\Models\Country::query();
        if($request->region_id){
            $q->where('region_id',$request->region_id);
        }
        if($query){
            $q->where('name', 'like', '%' . $query . '%')->orWhere('code', 'like', '%' . $query . '%');
        }
        $data = $q->get();
        return response()->json($data);

    }
    public function getStates(Request $request)
    {
        $query = $request->get('q');
        $q = \App\Models\State::query();
        if($request->country_id){
            $q->where('country_id',$request->country_id);
        }
        if($query){
            $q->where('name', 'like', '%' . $query . '%')->orWhere('code', 'like', '%' . $query . '%');
        }
        $data = $q->get();
        return response()->json($data);

    }

    public function getCities(Request $request)
    {
        $query = $request->get('q');
        $q = \App\Models\City::query();
        if($request->country_id){
            $q->where('country_id',$request->country_id);
        }
        if($request->state_id){
            $q->where('state_id',$request->state_id);
        }
        if($query){
            $q->where('name', 'like', '%' . $query . '%')->orWhere('code', 'like', '%' . $query . '%');
        }
        $data = $q->limit(10)->get();

        return response()->json($data);

    }
}
