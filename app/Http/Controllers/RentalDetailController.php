<?php

namespace App\Http\Controllers;

use App\Models\Accessory;
use App\Models\Rental_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class RentalDetailController extends Controller
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
            return Rental_detail::where('rental_id', '=', $id)->with('accessory')->get()->unique();
    }

    public function listAccessoriesUnAssigned($id)
    {
        if ($id > 0){
            $accessories = Accessory::get();
            //$differenceArray = [];
            $rental_detail_accessories= Rental_detail::where('rental_id', '=', $id)->with('accessory')->get('accessory_id');
            $data = [];//new Accessory();
            foreach ($rental_detail_accessories as $key => $value) {
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
        $rental_detail = new Rental_detail();
        $rental_detail->rental_id = $request->rental_detail["rental_id"];
        $rental_detail->accessory_id = $request->rental_detail["accessory_id"];
        $rental_detail->previous_state = $request->rental_detail["previous_state"];
        $rental_detail->later_state = $request->rental_detail["later_state"];
        $rental_detail->save();
        return $rental_detail;
    }


    public function createDefaultRentalDetail($id)
    {
        try {
            if ($id > 0) {
                $rentalDetailFilter = Rental_detail::where('rental_id', '=', $id)->take(1)->get()->unique();
                if (count($rentalDetailFilter) > 0) {
                    return "process data existing only add new register" . $rentalDetailFilter;
                } else {
                    $accessories = Accessory::orderBy('id', 'ASC')->get();;
                    if (count($accessories) > 0) {
                        foreach ($accessories as $key => $value) {
                            $rentalDetail = new Rental_detail();
                            $rentalDetail->rental_id = $id;
                            $rentalDetail->accessory_id = $value["id"];
                            $rentalDetail->previous_state = "Descripción del estado al momento de realizar la reserva por defecto: ";
                            $rentalDetail->later_state = "Descripción del estado al momento de dar por finalizada la reserva: ";
                            $rentalDetail->save();
                        }
                    }
                    return $rentalDetail;
                }
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function updateRentalDetail(Request $request)
    {
        //return "data";

/*
        try {
          */  
            //dd($request->vehicle_detail[0]);
            
            if (count($request->rental_details)) {

                //$vehicle_detail_update = Vehicle_detail::find($request->vehicle_details[0]["id"]);
                for ($i = 0; $i < count($request->rental_details); $i++) {
                    $rental_detail_update = Rental_detail::find($request->rental_details[$i]["id"]);
                    if ($rental_detail_update) {
                        $rental_detail_update->previous_state = $request->rental_details[$i]["previous_state"];
                        $rental_detail_update->later_state = $request->rental_details[$i]["later_state"];
                        $rental_detail_update->save();
                    }
                }
                return "datos guardados con exito";
            }
        /*
        } catch (\Throwable $th) {
            throw $th;
        }*/
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rental_detail  $rental_detail
     * @return \Illuminate\Http\Response
     */
    public function show(Rental_detail $rental_detail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rental_detail  $rental_detail
     * @return \Illuminate\Http\Response
     */
    public function edit(Rental_detail $rental_detail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rental_detail  $rental_detail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rental_detail $rental_detail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rental_detail  $rental_detail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rental_detail $rental_detail)
    {
        //
    }
}
