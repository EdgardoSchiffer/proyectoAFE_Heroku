<?php

namespace App\Http\Controllers;

use App\Models\Galery;
use Image;
use Illuminate\Http\Request;

class GaleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //where('vehicle_id', "==", $id )->
        return Galery::orderBy('id', 'DESC')->get();
    }

    public function list($id)
    {
        //where('vehicle_id', "==", $id )->
        return Galery::where('vehicle_id', "=", $id)->orderBy('id', 'DESC')->get();
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
        if ($request->galery["image_name"] != "") {
            for ($i = 0; $i < count( $request->galery["imagesBase64"]); $i++) {
                $galery = new Galery;
                //if ($request->galery["image_name"] != "") {
                $strpos = strpos($request->galery["imagesBase64"][$i], ';');
                $sub = substr($request->galery["imagesBase64"][$i], 0, $strpos);
                $ex = explode('/', $sub)[1];
                $name = time() . "." . $ex;

                $img = Image::make($request->galery["imagesBase64"][$i])->resize(1000, 600);
                $upload_path = public_path() . "/upload/vehicles/";
                $img->save($upload_path . $name);

                $galery->image_name = "/upload/vehicles/" . $name;
                
                $galery->vehicle_id = $request->galery["vehicle_id"];
                $galery->save();
                sleep(1);
            }
            
        } else {
            $galery = new Galery;

            $galery->image_name = "/upload/vehicles/image.png";
            $galery->vehicle_id = $request->galery["vehicle_id"];
            $galery->save();
            //return $galery;
        }
        return $galery;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Galery  $galery
     * @return \Illuminate\Http\Response
     */
    public function show(Galery $galery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Galery  $galery
     * @return \Illuminate\Http\Response
     */
    public function edit(Galery $galery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Galery  $galery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Galery $galery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Galery  $galery
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Galery::find($id);

        if ($item) {
            $upload_path = public_path();
            $file = $upload_path . $item->image_name;

            if ($item->image_name != "/upload/vehicles/image.png") {
                if (file_exists($file)) {
                    @unlink($file);
                }
            }
            $item->delete();
            return "Imagen eliminada correctamente";
        }
        return "Imagen no encontrada";
    }
}
