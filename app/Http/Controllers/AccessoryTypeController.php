<?php

namespace App\Http\Controllers;

use App\Models\Accessory_type;
use Illuminate\Http\Request;

class AccessoryTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Accessory_type::orderBy('id', 'DESC')->get();
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
        $accessoryType = new Accessory_type;
        $accessoryType->accessory_type_name = $request->accessory_type["accessory_type_name"];
        $accessoryType->save();
        return $accessoryType;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Accessory_type  $accessory_type
     * @return \Illuminate\Http\Response
     */
    public function show(Accessory_type $accessory_type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Accessory_type  $accessory_type
     * @return \Illuminate\Http\Response
     */
    public function edit(Accessory_type $accessory_type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Accessory_type  $accessory_type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $accessoryType = Accessory_type::find($id);
        if($accessoryType){
            $accessoryType->accessory_type_name = $request->accessory_type["accessory_type_name"];
            $accessoryType->save();
            return $accessoryType;
        }
        return "Tipo de accesorio no encontrado";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Accessory_type  $accessory_type
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $accessoryType = Accessory_type::find($id);
        if($accessoryType){
            $accessoryType->delete();
            return "Tipo de accesorio eliminado correctamente";
        }
        return "Tipo de accesorio no encontrado";
    }
}
