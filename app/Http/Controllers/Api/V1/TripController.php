<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Trip;
use App\Models\Customer;
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
     * @group Customer Endpoints
     * @authenticated
     */
    public function store(StoreTripRequest $request)
    {
        if($request->is('customer/trip'))
        {
            $customer = auth('customer')->user();
            $is_user = '0';
            $creater = $customer->id;
        }
        else{
            $customer = Customer::find($request->customer_id);
            $is_user = '1';
            $creater = auth()->user()->id;
        }

        $pickup = (new MapController())->geocoding($request->pickup);

        $drop = (new MapController())->geocoding($request->drop);

        $trip = Trip::create([
            'customer_id' => $customer->id,
            'pickup' => $pickup->address,
            'source' => $pickup->position,
            'drop' => $drop->address,
            'destination' => $drop->position,
        ]);

        $route = (new MapController())->routing(json_decode($trip->source), json_decode($trip->destination));

        $trip->kilometers = $route->lengthInMeters/1000;

        $trip->is_user = $is_user;

        $trip->created_by = $creater;

        $trip->updated_by = $creater;

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
