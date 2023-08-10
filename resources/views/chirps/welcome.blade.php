<!-- resources/views/custom-welcome.blade.php -->

@extends('layouts.app')
<!-- Logo -->
<!-- <div class="shrink-0 flex items-center">
    <a href="{{ route('welcome') }}">
        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
    </a>
</div> -->

<!-- Navigation Links -->
<div class="hidden sm:flex sm:items-center sm:ml-6">
    <a href="{{ route('register') }}" class="text-sm text-gray-700 underline">Register</a>
    <a href="{{ route('login') }}" class="ml-4 text-sm text-gray-700 underline">Login</a>
</div>

@section('content')
    <div class="bg-gradient-to-r from-blue-400 to-purple-500 p-8 text-center text-white">
        <h1 class="text-4xl font-semibold mb-4">Welcome to Idea Forum</h1>
        <p class="text-lg">Share and discuss your ideas with the community.</p>
    </div>
@endsection
