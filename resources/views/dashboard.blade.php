@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="flex justify-center">
    <div class="w-8/12 p-6 bg-white rounded-lg">
        Good afternoon, {{ auth()->user()->name }}. 👋 Here is what’s happening with your projects today:
    </div>
</div>

@endsection