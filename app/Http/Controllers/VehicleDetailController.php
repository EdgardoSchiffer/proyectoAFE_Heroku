<?php

namespace App\Http\Controllers;

use App\Models\Accessory;
use App\Models\Vehicle_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class VehicleDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function list($id)
    {
        if ($id > 0)
            return Vehicle_detail::where('vehicle_id', '=', $id)->with('accessory')->get()->unique();
    }

    public function listAccessoriesUnAssigned($id)
    {
        if ($id > 0){
            $accessories = Accessory::get();
            //$differenceArray = [];
            $vehicle_detail_accessories= Vehicle_detail::where('vehicle_id', '=', $id)->with('accessory')->get('accessory_id');
            $data = [];//new Accessory();
            foreach ($vehicle_detail_accessories as $key => $value) {
                $data = Arr::add($data, $key, $value->accessory);
            }
            $accessoriesUnAssigned = $accessories->diff($data); 
            /*foreach ($accessories as $key => $value) {
                $exist = Arr::has($data, $value->id);
                if($exist==false){
                    $differenceArray = Arr::add($differenceArray, $key, $value);
                }    
            }*/
            return $accessoriesUnAssigned;
        }
            

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $vehicle_detail = new Vehicle_detail();
        $vehicle_detail->vehicle_id = $request->vehicle_accessory["vehicle_id"];
        $vehicle_detail->accessory_id = $request->vehicle_accessory["accessory_id"];
        $vehicle_detail->status = true;
        $vehicle_detail->save();
        return $vehicle_detail;
    }


    public function createDefaultDetailVehicle($id)
    {
        try {
            if ($id > 0) {
                $vehicleDetailFilter = Vehicle_detail::where('vehicle_id', '=', $id)->take(1)->get()->unique();
                if (count($vehicleDetailFilter) > 0) {
                    return "process data existing only add new register" . $vehicleDetailFilter;
                } else {
                    $accessories = Accessory::orderBy('id', 'ASC')->get();;
                    if (count($accessories) > 0) {
                        foreach ($accessories as $key => $value) {
                            $vehicleDetail = new Vehicle_detail();
                            $vehicleDetail->vehicle_id = $id;
                            $vehicleDetail->accessory_id = $value["id"];
                            $vehicleDetail->status = true;
                            $vehicleDetail->save();
                        }
                    }
                    return $vehicleDetail;
                }
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function updateVehicleDetail(Request $request)
    {
        //return "data";

/*
        try {
          */  
            //dd($request->vehicle_detail[0]);
            
            if (count($request->vehicle_details)) {

                //$vehicle_detail_update = Vehicle_detail::find($request->vehicle_details[0]["id"]);
                for ($i = 0; $i < count($request->vehicle_details); $i++) {
                    $vehicle_detail_update = Vehicle_detail::find($request->vehicle_details[$i]["id"]);
                    if ($vehicle_detail_update) {
                        $vehicle_detail_update->status = $request->vehicle_details[$i]["status"];
                        $vehicle_detail_update->save();
                    }
                }
                return "datos guardados con exitos";
            }
        /*
        } catch (\Throwable $th) {
            throw $th;
        }*/
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehicle_detail  $vehicle_detail
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle_detail $vehicle_detail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehicle_detail  $vehicle_detail
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle_detail $vehicle_detail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehicle_detail  $vehicle_detail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehicle_detail $vehicle_detail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicle_detail  $vehicle_detail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle_detail $vehicle_detail)
    {
        //
    }
}
