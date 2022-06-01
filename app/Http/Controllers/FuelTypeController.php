<?php

namespace App\Http\Controllers;

use App\Models\Fuel_type;
use Illuminate\Http\Request;

class FuelTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
        return Fuel_type::orderBy('id', 'DESC')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
        $newFuelType = new Fuel_type;
        $newFuelType->fuel_type_name = $request->fuel_type["fuel_type_name"];
        $newFuelType->description = $request->fuel_type["description"];
        $newFuelType->save();
        return $newFuelType;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fuel_type  $fuel_type
     * @return \Illuminate\Http\Response
     */
    public function show(Fuel_type $fuel_type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fuel_type  $fuel_type
     * @return \Illuminate\Http\Response
     */
    public function edit(Fuel_type $fuel_type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fuel_type  $fuel_type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $fuelType = Fuel_type::find($id);
        if($fuelType){
            $fuelType->fuel_type_name = $request->fuel_type["fuel_type_name"];
        $fuelType->description = $request->fuel_type["description"];
        $fuelType->save();
        return $fuelType;
        }
        return "Tipo de combustible no encontrado";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fuel_type  $fuel_type
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $fuelType = Fuel_type::find($id);
        if($fuelType){
            $fuelType->delete();
            return "Tipo de combustible eliminado";
        }
        return "Tipo de combustible no encontrado";
    }
}
