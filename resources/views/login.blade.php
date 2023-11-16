@extends('layouts.guest')

@section('content')

<h1 class="text-xl font-semibold text-center text-blue-400 mt-2">Welcome to CES Board</h1>

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

    <div class="mb-3">
        {!! htmlFormSnippet() !!}
        @error('g-recaptcha-response')
        <span class="invalid" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    
    <div class="flex justify-center">
        <button class="items-center py-2 px-20 uppercase tracking-widest text-sm hover:opacity-80 rounded bg-blue-500 text-white">Login</button>
    </div>

    <div class="flex justify-between">
        <div class="flex items-center">
            <input id="remember" type="checkbox" name="remember" value="true" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
            <label for="remember" class="ml-2 mt-2 text-sm font-medium text-gray-900">Remember Me</label>
        </div>

        <div class="flex items-center">
            <a class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                href="{{ route('forgotPassword') }}">
                Forgot your password?
            </a>
        </div>
    </div>
        
</form>

@endsection