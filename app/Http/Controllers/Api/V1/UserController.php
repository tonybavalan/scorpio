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
        if(request()->is('api/*')){
            return UserResource::collection(User::all());
        }
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
        $validated = $request->validated();
        
        $user = User::create([
            'name' => $validated['name'],
            'uid' => $this->createUid(),
            'phone_no' => $validated['phone_no'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        if(request()->is('api/*')){
            $response = [
                'message' => "user created successfully",
                'user' => new UserResource($user),
            ];
    
            return response($response, 201);
        }

        auth()->attempt($request->only('email','password'));

        return view('dashboard');
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
        $validated = $request->validated();
        
        if(request()->is('api/*')):

            // Check Email
            $user = User::where('email', $validated['email'])->first();

            // Check Password
            if(!$user || !Hash::check($validated['password'], $user->password)) {
                return response([
                    'message' => 'Invalid Login Details',
                ], 401);
            }

            $token = $user->createToken($user->name)->plainTextToken;

            $response = [
                'user' => new UserResource($user),
                'token' => $token,
            ];

            return response($response, 201);    

        endif;

        if(!auth()->attempt($request->only('email', 'password'), $request->remember)){
            return back()->with('status', "Invalid Login Details");
        }
        
        return redirect()->route('dashboard');
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
        if(request()->is('api/*')):

            auth('user')->user()->currentAccessToken()->delete();

            return response([
                'message' => 'User logged out successfully'
            ]);

        endif;

        auth()->logout();

        return redirect()->route('login');
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
