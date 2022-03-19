<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'customername' => 'required|string',
            'email' => 'required|string|unique:customers,email',
            'phone_no' => 'required|string|unique:customers,phone_no',
            'location' => 'required|string',
            'password' => 'required|string|confirmed',
        ]);

        $customer = Customer::create([
            'name' => $fields['name'],
            'customername' => $fields['customername'],
            'email' => $fields['email'],
            'phone_no' => $fields['phone_no'],
            'location' => $fields['location'],
            'password' => bcrypt($fields['password']),
        ]);

        $token = $customer->createToken('myapptoken')->plainTextToken;

        $response = [
            'customer' => new CustomerResource($customer),
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
        $customer = Customer::where('email', $fields['email'])->first();
        
        // Check Password
        if(!$customer || !Hash::check($fields['password'], $customer->password)) {
            return response([
                'message' => 'Bad creds',
            ], 401);
        }
        
        $token = $customer->createToken('myapptoken')->plainTextToken;

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
