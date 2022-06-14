<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Rental;
use App\Models\Rental_user;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $rentals = Rental::with('client')->with('vehicle')->orderBy('id', 'ASC')->paginate(10);
        return [
            'pagination' => [
                'total' => $rentals->total(),
                'current_page' => $rentals->currentPage(),
                'per_page' => $rentals->perPage(),
                'last_page' => $rentals->lastPage(),
                'from' => $rentals->firstItem(),
                'to' => $rentals->lastPage(),
            ],
            'rentals' => $rentals
        ];
    }

    public function listRentalByClient($id)
    {
        $users = Client::where('user_id', '=', $id)->get();
        if (count($users) > 0) {
            $rentals = Rental::with('client')->with('vehicle')->with('rental_users')->where('client_id', '=', $users[0]->id)->get();
            if (count($rentals) > 0) {
                return $rentals;
            }else{
                return "No hay registros";    
            }
        } else {
            return "El usuario no es cliente";
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
        $rental = new Rental;
        $rental->rental_date = now();
        $rental->vehicle_id = $request->rental["vehicle_id"];
        $rental->client_id = $request->rental["client_id"];
        $rental->advance = 0.0;
        $rental->late_delivery_charge = 0.0;
        $rental->comment = $request->rental["comment"];
        $rental->damage_charge = $request->rental["damage_charge"];
        $rental->rental_time = $request->rental["rental_time"];
        $rental->save();
        return $rental;
    }

    //store new rental 
    public function storeRentalClient(Request $request)
    {
        $users = Client::where('user_id', '=', $request->rental["user_id"])->get()->first();
        $rental = new Rental;
        $rental->rental_date = now();
        $rental->vehicle_id = $request->rental["vehicle_id"];
        $rental->client_id = $users->id;
        $rental->advance = 0.0;
        $rental->late_delivery_charge = 0.0;
        $rental->comment = $request->rental["comment"];
        $rental->damage_charge = 0.0;
        $rental->rental_time = $request->rental["rental_time"];
        $rental->save();
        return $rental;
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rental  $rental
     * @return \Illuminate\Http\Response
     */
    public function show(Rental $rental)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rental  $rental
     * @return \Illuminate\Http\Response
     */
    public function edit(Rental $rental)
    {
        //
    }

    public function list()
    {
        $renta_users = Rental_user::where('option','=','Completado')->get('rental_id');
        $rentals = Rental::with('rental_users')->whereNotIn('id', $renta_users)->get();
        //return Rental::with(['rental_users'=>function ($query){$query->where('option','!=','Comletado');}])->orderBy('id', 'ASC')->get();        
        //return Rental::select('*', 'rentals.id as id')->join('rental_users as ru','rentals.id','=','ru.id');
        return $rentals;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rental  $rental
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rental = Rental::find($id);
        if ($rental) {
            //$rental->rental_date = now();
            $rental->vehicle_id = $request->rental["vehicle_id"];
            $rental->client_id = $request->rental["client_id"];
            $rental->advance = 0.0;
            $rental->late_delivery_charge = $request->rental["late_delivery_charge"];
            $rental->comment = $request->rental["comment"];
            $rental->damage_charge = $request->rental["damage_charge"];
            $rental->rental_time = $request->rental["rental_time"];
            $rental->save();
            return $rental;
        }
        return "Reserva no encontrada";
    }

    public function updateAdvance(Request $request, $id)
    {
        $rental = Rental::find($id);
        if ($rental) {
            $rental->advance = $request->rental_deposit["advance"];
            $rental->save();
            return $rental;
        }
        return "Reserva no encontrada";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rental  $rental
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $rental = Rental::find($id);
        if ($rental) {
            
            $rental->delete();
            return "Reserva eliminada";
        }
        return "Reserva no encontrada";
    }
}
