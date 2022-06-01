<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $brands = Brand::OrderBy('id', 'DESC')->paginate(10);
        return [
            'pagination' => [
                'total' => $brands->total(),
                'current_page' => $brands->currentPage(),
                'per_page' => $brands->perPage(),
                'last_page' => $brands->lastPage(),
                'from' => $brands->firstItem(),
                'to' => $brands->lastPage(),
            ],
            'brands' => $brands
        ];
    }

    public function listar()
    {
        //
        return  Brand::OrderBy('id', 'DESC')->get();
        
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
        $newBrand = new Brand();
        $newBrand->brand_name = $request->brand["brand_name"];
        $newBrand->save();
        return $newBrand;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $existingBrand = Brand::find($id);
        if ($existingBrand) {
            $existingBrand->brand_name = $request->brand["brand_name"];
            $existingBrand->save();
            return $existingBrand;
        }
        return "Brand not found";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $existingBrand = Brand::find($id);
        if ($existingBrand) {
            $existingBrand->delete();
            return "Brand successfully deleted";
        }
        return "Brand not found";
    }
}
