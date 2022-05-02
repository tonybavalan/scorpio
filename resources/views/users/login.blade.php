@extends('layouts.app')

@section('title', 'Login')

@section('content')
        <div class="flex justify-center">
            <div class="w-4/12 p-5 bg-white rounded-lg">
                <form action="{{ url('login') }}" method="post">

                    @csrf

                    <div class="mb-4">
                        <label for="email" class="sr-only">Email</label>
                        <input type="email" name="email" id="email" placeholder="Your Email"
                        class="bg-gray-100 border-2 w-full p-4 rounded-lg
                            @error('username') border-red-500 @enderror" value="">

                        @error('email')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="sr-only">Password</label>
                        <input type="password" name="password" id="password" placeholder="Type your password"
                        class="bg-gray-100 border-2 w-full p-4 rounded-lg
                            @error('username') border-red-500 @enderror" value="">

                        @error('password')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">Login</button>
                    </div>
                </form>
            </div>
        </div>
@endsection