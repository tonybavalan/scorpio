@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="flex justify-center">
    <div class="w-4/12 p-5 bg-white rounded-lg">
        <form action="{{ url('register') }}" method="post">

            @csrf

            <div class="mb-4">
                <label for="name" class="sr-only">Name</label>
                <input type="text" name="name" id="name" placeholder="Your Name" class="bg-gray-100 border-2 w-full p-4 rounded-lg 
                            @error('name') border-red-500 @enderror" value="{{ old('name') }}">

                @error('name')
                <div class="text-red-500 mt-2 text-sm">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="sr-only">Email</label>
                <input type="email" name="email" id="email" placeholder="Your Email" class="bg-gray-100 border-2 w-full p-4 rounded-lg
                            @error('email') border-red-500 @enderror" value="{{ old('email') }}">

                @error('email')
                <div class="text-red-500 mt-2 text-sm">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="phone_no" class="sr-only">Ph.No</label>
                <input type="number" name="phone_no" id="phone_no" placeholder="Your phone no" class="bg-gray-100 border-2 w-full p-4 rounded-lg 
                            @error('phone_no') border-red-500 @enderror" value="{{ old('phone_no') }}">

                @error('phone_no')
                <div class="text-red-500 mt-2 text-sm">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="sr-only">Password</label>
                <input type="password" name="password" id="password" placeholder="Type your password" class="bg-gray-100 border-2 w-full p-4 rounded-lg
                            @error('password') border-red-500 @enderror" value="">

                @error('password')
                <div class="text-red-500 mt-2 text-sm">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="sr-only">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm your password" class="bg-gray-100 border-2 w-full p-4 rounded-lg" value="">
            </div>

            <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">Register</button>
            </div>
        </form>
    </div>
</div>
@endsection