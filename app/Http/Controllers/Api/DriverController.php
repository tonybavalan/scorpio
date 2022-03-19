<?php

namespace App\Http\Controllers\Api;

use App\Models\Driver;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\DriverResource;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DriverResource::collection(Driver::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'drivername' => 'required|string',
            'email' => 'required|string|unique:drivers,email',
            'phone_no' => 'required|string|unique:drivers,phone_no',
            'location' => 'required|string',
            'password' => 'required|string|confirmed',
        ]);

        $driver = Driver::create([
            'name' => $fields['name'],
            'drivername' => $fields['drivername'],
            'email' => $fields['email'],
            'phone_no' => $fields['phone_no'],
            'location' => $fields['location'],
            'password' => bcrypt($fields['password']),
        ]);

        $token = $driver->createToken('myapptoken')->plainTextToken;

        $response = [
            'driver' => new DriverResource($driver),
            'token' => $token,
        ];

        return response($response, 201);
    }

    /**
     * Login using resource & credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        // Check Email
        $driver = Driver::where('email', $fields['email'])->first();
        
        // Check Password
        if(!$driver || !Hash::check($fields['password'], $driver->password)) {
            return response([
                'message' => 'Bad creds',
            ], 401);
        }
        
        $token = $driver->createToken('myapptoken')->plainTextToken;

        $response = [
            'driver' => new DriverResource($driver),
            'token' => $token,
        ];

        return response($response, 201);
    }

    /**
     * Logout using credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        auth('driver')->user()->currentAccessToken()->delete();

        return response([
            'message' => 'Driver logged out'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function show(Driver $driver)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Driver $driver)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function destroy(Driver $driver)
    {
        //
    }
}
