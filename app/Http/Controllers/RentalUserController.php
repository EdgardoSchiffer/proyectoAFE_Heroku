<?php

namespace App\Http\Controllers;

use App\Models\Rental_user;
use Illuminate\Http\Request;

class RentalUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $rental_users = Rental_user::with('user')->with('rental')-> OrderBy('id', 'DESC')->paginate(10);
        return [
            'pagination' => [
                'total' => $rental_users->total(),
                'current_page' => $rental_users->currentPage(),
                'per_page' => $rental_users->perPage(),
                'last_page' => $rental_users->lastPage(),
                'from' => $rental_users->firstItem(),
                'to' => $rental_users->lastPage(),
            ],
            'rental_users' => $rental_users
        ];
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
        $rental_user = new Rental_user();
        $rental_user->rental_id = $request->rental_user["rental_id"];
        $rental_user->user_id = $request->rental_user["user_id"];
        $rental_user->option = $request->rental_user["option"];
        $rental_user->date = now();
        $rental_user->save();
        return $rental_user;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rental_user  $rental_user
     * @return \Illuminate\Http\Response
     */
    public function show(Rental_user $rental_user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rental_user  $rental_user
     * @return \Illuminate\Http\Response
     */
    public function edit(Rental_user $rental_user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rental_user  $rental_user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rental_user = Rental_user::find($id);
        if ($rental_user) {
            $rental_user->user_id = $request->rental_user["user_id"];
            $rental_user->option = $request->rental_user["option"];
            $rental_user->date = now();
            $rental_user->save();
            return $rental_user;
        }
        return "Reservación no encontrado";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rental_user  $rental_user
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        /*
        $rental_user = Rental_user::find($id);
        if ($rental_user) {
            $rental_user->delete();
            return "Reservacion elimnada";
        }
        return "Reservación no encontrado";*/
    }
}
