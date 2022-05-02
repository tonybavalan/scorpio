<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Trip;
use App\Models\Customer;
use App\Models\Waypoints;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TripResource;
use App\Http\Requests\StoreTripRequest;
use App\Http\Controllers\Api\MapController;

class TripController extends Controller
{
    /**
     * Display a listing of all the trips resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TripResource::collection(Trip::all());
    }

    /**
     * Store a newly created trip resource in storage.
     * 
     * @param  \Illuminate\Http\Requests\StoreTripRequest  $request
     * @return \Illuminate\Http\Response
     * @group Trip Endpoints
     * @authenticated
     */
    public function store(StoreTripRequest $request)
    {
        $model = \Laravel\Sanctum\PersonalAccessToken::findToken($request->bearerToken());

        if($model->tokenable_type === "App\Models\Customer"){
            $customer = Customer::findOrFail($request->customer_id);
            $is_admin = '0';
            $creater = $request->customer_id;
        }elseif($model->tokenable_type === "App\Models\User"){
            $customer = Customer::findOrFail($request->customer_id);
            $is_admin = '1';
            $creater = $model->tokenable->id;
        }

        $pickup = MapController::geocoding($request->pickup);

        $drop = MapController::geocoding($request->drop);

        $trip = Trip::create([
            'customer_id' => $customer->id,
            'pickup' => $pickup->address,
            'source' => $pickup->position,
            'drop' => $drop->address,
            'destination' => $drop->position,
            'is_admin' => $is_admin,
            'created_by' => $creater,
            'updated_by' => $creater, 
        ]);

        $route = MapController::routing(json_decode($trip->source), json_decode($trip->destination));

        $trip->kilometers = $route->lengthInMeters/1000;

        $trip->save();

        Waypoints::create(['trip_id' => $trip->id, 'route' => json_encode($route->route)]);

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
