<?php

namespace App\Http\Controllers;

use App\Models\Municipality;
use Illuminate\Http\Request;

class MunicipalityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $municipalities = Municipality::with('department')->OrderBy('id', 'ASC')->paginate(10);
        return [
            'pagination' => [
                'total' => $municipalities->total(),
                'current_page' => $municipalities->currentPage(),
                'per_page' => $municipalities->perPage(),
                'last_page' => $municipalities->lastPage(),
                'from' => $municipalities->firstItem(),
                'to' => $municipalities->lastPage(),
            ],
            'municipalities' => $municipalities
        ];
    }

    public function list()
    {
        return Municipality::with('department')->orderBy('id', 'ASC')->get();
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
        $municipality = new Municipality();
        $municipality->department_id = $request->municipality["department_id"];
        $municipality->municipality_name = $request->municipality["municipality_name"];
        $municipality->save();
        return $municipality;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Municipality  $municipality
     * @return \Illuminate\Http\Response
     */
    public function show(Municipality $municipality)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Municipality  $municipality
     * @return \Illuminate\Http\Response
     */
    public function edit(Municipality $municipality)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Municipality  $municipality
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $municipality = Municipality::find($id);
        if ($municipality) {
            $municipality->department_id = $request->municipality["department_id"];
            $municipality->municipality_name = $request->municipality["municipality_name"];
            $municipality->save();

            return $municipality;
        }
        return "Municipio no encontrado";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Municipality  $municipality
     * @return \Illuminate\Http\Response
     */
    public function destroy(Municipality $municipality, $id)
    {
        $municipality = Municipality::find($id);
        if ($municipality) {
            $municipality->delete();
            return "Municipalidad eliminado";
        }
        return "Municipalidad no encontrado";
    }
}
