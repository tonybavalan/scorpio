<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Trip;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TripResource;

class TripController extends Controller
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

    /**
     * Store a newly created trip resource in storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $trip = new Trip;

        $trip->customer_id = $request->customer_id;
        $trip->pickup = $request->pickup;
        $trip->source = json_encode($request->source);
        $trip->drop = $request->drop;
        $trip->destination = json_encode($request->destination);
        $trip->save();

        $response = [
            'message' => 'trip created successfully',
            'trip' => new TripResource($trip),
        ];

        return response($response, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
