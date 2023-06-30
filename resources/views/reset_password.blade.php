@extends('layouts.guest')

@section('content')
    <h1 class="h2 mb-4 text-gray-900">Reset Password</h1>
    <p class="mb-4 text-red-500 text-sm text-justify">Required Password Pattern: Minimum of eight characters, at least one uppercase letter, one lowercase letter, one number and one special character.</p>

    <form class="user" method="POST" action="javascript:void(0);" id="reset_password" onsubmit="submitResetPassword()">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="mb-3">
            <label for="email">Email</label>
            <input type="email" name="email" value="{{ $email }}" required autofocus autocomplete="email" readonly>
            @error('email')
                <span class="invalid" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password">Password</label>
            <input type="password" name="password" required autofocus autocomplete="password">
            @error('password')
                <span class="invalid" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" required autofocus autocomplete="password_confirmation">
            @error('password_confirmation')
                <span class="invalid" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit" class="btn btn-primary btn-user btn-block">Reset Password</button>
        </div>

        <div class="my-5 flex justify-end">
            <a class="text-sm text-slate-500 hover:underline" href="{{ env('APP_URL') }}login">Already have an account? Login!</a>
        </div>

    </form>
@endsection
