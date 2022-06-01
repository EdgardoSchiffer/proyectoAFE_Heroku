<?php

namespace App\Http\Controllers;

use App\Models\Vehicle_type;
use Illuminate\Http\Request;

class VehicleTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Vehicle_type::orderBy('id', 'DESC')->get();
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
        $vehicleType = new Vehicle_type;
        $vehicleType->vehicle_type_name = $request->vehicle_type["vehicle_type_name"];
        $vehicleType->save();
        return $vehicleType;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehicle_type  $vehicle_type
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle_type $vehicle_type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehicle_type  $vehicle_type
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle_type $vehicle_type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehicle_type  $vehicle_type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $vehicleType = Vehicle_type::find($id);
        if($vehicleType){
            $vehicleType->vehicle_type_name = $request->vehicle_type["vehicle_type_name"];
            $vehicleType->save();
            return $vehicleType;
        }
        return "Tipo de vehiculo no encontrado";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicle_type  $vehicle_type
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vehicleType = Vehicle_type::find($id);
        if($vehicleType){
            $vehicleType->delete();
            return "Tipo de vehiculo eliminado correctamente";
        }
        return "Tipo de vehiculo no encontrado";
    }
}
