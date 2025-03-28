<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginUserRequest;
use App\Http\Resources\CustomerResource;
use App\Http\Controllers\Api\MapController;
use App\Http\Requests\StoreCustomerRequest;

class CustomerController extends Controller
{
    /**
     * Display a listing of all the customers resource.
     *
     * @return \Illuminate\Http\Response
     * @group User Endpoints
     * @authenticated
     */
    public function index()
    {
        if (request()->is('api/*')) {
            return CustomerResource::collection(Customer::all());
        }

        return view('customers.index');
    }

    /**
     * Store a newly created customer resource in storage.
     * 
     * @param  \Illuminate\Http\Requests\StoreCustomerRequest  $request
     * @return \Illuminate\Http\Response
     * @group Customer Endpoints
     */
    public function store(StoreCustomerRequest $request): ?object
    {
        $mapCode = MapController::geocoding($request->location);

        $customer = Customer::create([
            'name' => $request->name,
            'uid' => $this->createUid(),
            'email' => $request->email,
            'phone_no' => $request->phone_no,
            'location' => $mapCode->address ?? null,
            'latlng' => $mapCode->position ?? null,
            'password' => bcrypt($request->password),
        ]);

        $response = [
            'message' => "customer created successfully",
            'customer' => new CustomerResource($customer),
        ];

        return response($response, 201);
    }

    /**
     * Login using customer resource & credentials.
     *
     * @param  \Illuminate\Http\Requests\LoginUserRequest  $request
     * @return \Illuminate\Http\Response
     * @group Customer Endpoints
     */
    public function login(LoginUserRequest $request)
    {
        // Check Email
        $customer = Customer::where('email', $request->email)->first();

        // Check Password
        if (!$customer || !Hash::check($request->password, $customer->password)) {
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
     * Logout as customer resource.
     *
     * @return \Illuminate\Http\Response
     * @group Customer Endpoints
     * @authenticated
     */
    public function logout(): ?object
    {
        $user = auth('customer')->user();

        if ($user) {
            $user->currentAccessToken()->delete();

            return response([
                'message' => 'Customer logged out successfully'
            ]);
        } else {
            return response([
                'message' => 'Customer not authenticated'
            ], 401);
        }
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
