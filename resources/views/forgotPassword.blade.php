@extends('layouts.guest')

@section('content')

    <h2 class="text-lg font-semibold text-center text-blue-500 mt-2">Enter your registered email to get new temporary password.</h2>

    <form class="user" method="POST" action="{{ route('sendPassword') }}">
        @csrf

        <div class="mb-3">
            <label for="email">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="email">
            @error('email')
                <span class="text-red-500 text-xs mt-1" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="flex justify-center">
            <button class="btn btn-primary">Reset Password</button>
        </div>

        <div class="mt-4 flex items-center justify-end">
            <a class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" href="{{ route('login') }}">
                Log in your account
            </a>
        </div>

    </form>

@endsection
