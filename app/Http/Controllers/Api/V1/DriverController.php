<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Driver;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\DriverResource;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreDriverRequest;

class DriverController extends Controller
{
    /**
     * Display a listing of the Driver resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DriverResource::collection(Driver::all());
    }

    /**
     * Store a newly created Driver resource in storage.
     * 
     * @param  \Illuminate\Http\Requests\StoreDriverRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDriverRequest $request)
    {
        $driver = Driver::create([
            'uid' => $this->createUid(),
            'name' => $request->name,
            'email' => $request->email,
            'phone_no' => $request->phone_no,
            'location' => $request->location,
            'password' => bcrypt($request->password),
        ]);

        $response = [
            'message' => 'driver created successfully',
            'driver' => new DriverResource($driver),
        ];

        return response($response, 201);
    }

    /**
     * Login using Driver resource & credentials.
     * 
     * @param  \Illuminate\Http\Requests\LoginUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function login(LoginUserRequest $request)
    {
        // Check Email
        $driver = Driver::where('email', $request->email)->first();
        
        // Check Password
        if(!$driver || !Hash::check($request->password, $driver->password)) {
            return response([
                'message' => 'Bad credentials',
            ], 401);
        }
        
        $token = $driver->createToken($driver->name)->plainTextToken;

        $response = [
            'driver' => new DriverResource($driver),
            'token' => $token,
        ];

        return response($response, 201);
    }

    /**
     * Logout as Driver resource.
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
