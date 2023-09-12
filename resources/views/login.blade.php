@extends('layouts.guest')

@section('content')

<h1 class="text-lg font-semibold text-center text-blue-500 mt-2">Welcome to CES Board</h1>

<form class="user" method="POST" action="{{ route('login') }}">
    @csrf

    <div class="mb-3">
        <label for="email">Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="email">
        @error('email')
        <span class="invalid" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password">Password</label>
        <input type="password" name="password" value="{{ old('password') }}" required>
        @error('password')
        <span class="invalid" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="flex justify-end">
        <button class="btn btn-primary">Login</button>
    </div>

    <div class="mt-4 flex items-center justify-end">
        <a class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
            href="{{ route('forgotPassword') }}">
            Forgot your password?
        </a>
    </div>

</form>

@endsection