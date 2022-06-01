<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Vehicle::with('fuel_type')->with('brand')->with('vehicle_type')->orderBy('id', 'ASC')->get();
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
        $vehicle = new Vehicle;
        $vehicle->vehicle_type_id = $request->vehicle["vehicle_type"];
        $vehicle->vehicle_name = $request->vehicle["vehicle_name"];
        $vehicle->color = $request->vehicle["color"];
        $vehicle->year = $request->vehicle["year"];
        $vehicle->doors_number = $request->vehicle["doors_number"];
        $vehicle->fuel_type_id = $request->vehicle["fuel_type"];
        $vehicle->rental_price = $request->vehicle["rental_price"];
        $vehicle->status = $request->vehicle["status"];
        $vehicle->brand_id = $request->vehicle["brand"];
        $vehicle->registry_number = $request->vehicle["registry_number"];
        $vehicle->stock = $request->vehicle["stock"];
        $vehicle->save();
        return $vehicle;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $vehicle = Vehicle::find($id);
        if ($vehicle) {
            $vehicle->vehicle_type_id = $request->vehicle["vehicle_type"];
            $vehicle->vehicle_name = $request->vehicle["vehicle_name"];
            $vehicle->color = $request->vehicle["color"];
            $vehicle->year = $request->vehicle["year"];
            $vehicle->doors_number = $request->vehicle["doors_number"];
            $vehicle->fuel_type_id = $request->vehicle["fuel_type"];
            $vehicle->rental_price = $request->vehicle["rental_price"];
            $vehicle->status = $request->vehicle["status"];
            $vehicle->brand_id = $request->vehicle["brand"];
            $vehicle->registry_number = $request->vehicle["registry_number"];
            $vehicle->stock = $request->vehicle["stock"];
            $vehicle->save();
            return $vehicle;
        }
        return "Vehículo no encontrado";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $vehicle = Vehicle::find($id);
        if ($vehicle) {
            $vehicle->delete();
            return "Vehículo eliminado";
        }
        return "Vehículo no encontrado";
    }
}
