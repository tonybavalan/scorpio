<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the user resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return UserResource::collection(User::all());
    }

    /**
     * Store a newly created user resource in storage.
     *
     * @param  \Illuminate\Http\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     * @group User Endpoints
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'uid' => $this->createUid(),
            'phone_no' => $request->phone_no,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $response = [
            'message' => "user created successfully",
            'user' => new UserResource($user),
        ];

        return response($response, 201);
    }

     /**
     * Login using user resource & credentials.
     *
     * @param  \Illuminate\Http\LoginUserRequest  $request
     * @return \Illuminate\Http\Response
     * @group User Endpoints
     */
    public function login(LoginUserRequest $request)
    {
        // Check Email
        $user = User::where('email', $request->email)->first();
        
        // Check Password
        if(!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => 'Bad credentials',
            ], 401);
        }
        
        $token = $user->createToken($user->name)->plainTextToken;

        $response = [
            'user' => new UserResource($user),
            'token' => $token,
        ];

        return response($response, 201);
    }

    /**
     * Logout using user credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @group User Endpoints
     * @authenticated
     */
    public function logout(Request $request)
    {
        auth()->user()->currentAccessToken()->delete();

        return response([
            'message' => 'User logged out successfully'
        ]);
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
