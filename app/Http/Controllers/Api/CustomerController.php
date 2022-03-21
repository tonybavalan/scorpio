<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\CustomerResource;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CustomerResource::collection(Customer::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $customer = Customer::create([
            'name' => $request->name,
            'customername' => $request->customername,
            'email' => $request->email,
            'phone_no' => $request->phone_no,
            'location' => $request->location,
            'password' => bcrypt($request->password),
        ]);

        $response = [
            'message' => "customer created successfully",
            'customer' => new CustomerResource($customer),
        ];

        return response($response, 201);
    }

    /**
     * Login using resource & credentials.
     *
     * @param  \Illuminate\Http\Requests\LoginUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function login(LoginUserRequest $request)
    {
        // Check Email
        $customer = Customer::where('email', $request->email)->first();
        
        // Check Password
        if(!$customer || !Hash::check($request->password, $customer->password)) {
            return response([
                'message' => 'Bad Credentials',
            ], 401);
        }
        
        $token = $customer->createToken($customer->name)->plainTextToken;

        $response = [
            'customer' => new CustomerResource($customer),
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
        auth('customer')->user()->currentAccessToken()->delete();

        return response([
            'message' => 'Customer logged out'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
