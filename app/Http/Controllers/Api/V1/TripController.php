<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Trip;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TripResource;
use App\Http\Requests\StoreTripRequest;
use App\Http\Controllers\Api\MapController;

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
     * @param  \Illuminate\Http\Requests\StoreTripRequest  $request
     * @return \Illuminate\Http\Response
     * @group User Endpoints
     * @authenticated
     */
    public function store(StoreTripRequest $request)
    {
        $pickup = (new MapController())->geocoding($request->pickup);

        $drop = (new MapController())->geocoding($request->drop);

        $trip = Trip::create([
            'customer_id' => auth('customer')->user()->id,
            'pickup' => $pickup->address,
            'source' => $pickup->position,
            'drop' => $drop->address,
            'destination' => $drop->position,
        ]);

        $route = (new MapController())->routing(json_decode($trip->source), json_decode($trip->destination));

        $trip->kilometers = $route->lengthInMeters/1000;

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
