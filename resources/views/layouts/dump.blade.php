<div class="flex justify-center">
    <div class="w-4/12 p-5 bg-white rounded-lg">

        @if(session('status'))
        <div class="bg-red-500 p-4 rounded-lg mb-6 text-white text-center">
            {{session('status')}}
        </div>
        @endif

        <form action="{{ url('login') }}" method="post">

            @csrf

            <div class="mb-4">
                <label for="email" class="sr-only">Email</label>
                <input type="email" name="email" id="email" placeholder="Your Email" class="bg-gray-100 border-2 w-full p-4 rounded-lg
                            @error('username') border-red-500 @enderror" value="">

                @error('email')
                <div class="text-red-500 mt-2 text-sm">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="sr-only">Password</label>
                <input type="password" name="password" id="password" placeholder="Type your password" class="bg-gray-100 border-2 w-full p-4 rounded-lg
                            @error('username') border-red-500 @enderror" value="">

                @error('password')
                <div class="text-red-500 mt-2 text-sm">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-4">
                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember" class="mr-2">
                    <label for="remember">Remember me</label>
                </div>
            </div>

            <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">Login</button>
            </div>
        </form>
    </div>
</div>



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



<div class="flex justify-center">
    <div class="w-8/12 p-6 bg-white rounded-lg">
        Good afternoon, {{ auth()->user()->name }}. 👋 Here is what’s happening with your trips today:
    </div>
</div>

<nav class="p-5 bg-white flex justify-between mb-5">
        <ul class="flex items-center">
            <li>
                <a href="#" class="p-3 no-underline hover:underline font-normal hover:font-bold">
                    Home
                </a>
            </li>

            <li>
                <a href="{{ url('dashboard') }}" class="p-3 no-underline hover:underline font-normal hover:font-bold">
                    Dashboard
                </a>
            </li>

            @auth
            <li>
                <a href="#" class="p-3 no-underline hover:underline font-normal hover:font-bold">
                    Trips
                </a>
            </li>
            @endauth
        </ul>

        <ul class="flex items-center">

            @auth
            <li>
                <a href="#" class="p-3 font-normal hover:font-bold">{{ auth()->user()->name }}</a>
            </li>
            <li>
                <form action="{{ route('logout') }}" method="post" class="p-3 inline">
                    @csrf
                    <button type="submit" class="font-normal hover:font-bold">Logout</button>
                </form>
            </li>
            @endauth

            @guest
            <li>
                <a href="{{ route('login') }}" class="p-3 no-underline hover:underline font-normal hover:font-bold">
                    Login
                </a>
            </li>
            <li>
                <a href="{{ route('register') }}" class="p-3 no-underline hover:underline font-normal hover:font-bold">
                    Register
                </a>
            </li>
            @endguest

        </ul>
    </nav>