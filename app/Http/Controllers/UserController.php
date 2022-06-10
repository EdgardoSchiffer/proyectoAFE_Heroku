<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('role')->orderBy('id', 'ASC')->paginate(10);
        return [
            'pagination' => [
                'total' => $users->total(),
                'current_page' => $users->currentPage(),
                'per_page' => $users->perPage(),
                'last_page' => $users->lastPage(),
                'from' => $users->firstItem(),
                'to' => $users->lastPage(),
            ],
            'users' => $users
        ];
    }

    public function list()
    {
        return User::with('role')->orderBy('id', 'ASC')->get();
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
        $user = new User();
        $user->name = $request->user["name"];
        $user->last_name = $request->user["last_name"];
        $user->username = $request->user["username"];
        $user->email = $request->user["email"];
        $user->password = $request->user["password"];
        $user->role_id = $request->user["role_id"];
        $user->save();
        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if ($user) {
            $user->name = $request->user["name"];
            $user->last_name = $request->user["last_name"];
            $user->username = $request->user["username"];
            $user->email = $request->user["email"];
            $user->password = $request->user["password"];
            $user->role_id = $request->user["role_id"];
            $user->save();

            return $user;
        }
        return "Usuario no encontrado";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $users = User::find($id);
        if ($users) {
            $users->delete();
            return "Accesorio eliminado";
        }
        return "Accesorio no encontrado";
    }
}
