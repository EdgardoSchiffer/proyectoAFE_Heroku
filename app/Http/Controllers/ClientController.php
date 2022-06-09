<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::with('user')->with('municipality')->OrderBy('id', 'ASC')->paginate(10);
        return [
            'pagination' => [
                'total' => $clients->total(),
                'current_page' => $clients->currentPage(),
                'per_page' => $clients->perPage(),
                'last_page' => $clients->lastPage(),
                'from' => $clients->firstItem(),
                'to' => $clients->lastPage(),
            ],
            'clients' => $clients
        ];

    }

    public function list()
    {
        return Client::with('user')->with('municipality')->orderBy('id', 'ASC')->get();        
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
        $client = new Client();
        $client->client_name = $request->client["client_name"];
        $client->dui = $request->client["dui"];
        $client->email = $request->client["email"];
        $client->address = $request->client["address"];
        $client->phone = $request->client["phone"];
        $client->municipality_id = $request->client["municipality_id"];
        $client->save();
        return $client;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $clients = Client::find($id);
        if ($clients) {
            $clients->delete();
            return "Accesorio eliminado";
        }
        return "Accesorio no encontrado";
    }
}
