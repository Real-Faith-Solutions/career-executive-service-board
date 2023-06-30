@extends('layouts.guest')

@section('content')
    <!-- Outer Row -->

    @if ($message_status == 'Reset password link successfully sent to your email')
        <div class="p-5 text-center">
            <h1 class="h2 mb-4 text-gray-900">Reset link sent!</h1>
            <p class="mb-4">{{ $message_status }}.</p>
            <p class="mb-4">You may close this window.</p>
        </div>
    @elseif($message_status == 'User not found please check the provided email')
        <div class="text-center">
            <h1 class="h2 mb-4 text-gray-900">Not found!</h1>
            <p class="mb-4">{{ $message_status }}.</p>
        </div>
        <form class="user" action="{{ env('APP_URL') }}forgot-password" onsubmit="processAlert()">
            @csrf

            <div class="mb-3">
                <label for="email">Email</label>
                <input type="email" name="email" value="{{ $email }}" required autofocus autocomplete="email">
                @error('email')
                    <span class="invalid" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="btn btn-primary">Reset Password</button>
            </div>

            <div class="my-5 flex justify-end">
                <a class="text-sm text-slate-500 hover:underline" href="{{ env('APP_URL') }}login">Already have an account? Login!</a>
            </div>

        </form>
    @elseif($message_status == 'Throttled reset attempt')
        <div class="text-center">
            <h1 class="h2 mb-4 text-gray-900">Stop!</h1>
            <p class="mb-4">Multiple request is not allowed please check your previous request first.</p>
        </div>
        <hr>
        <div class="text-center">
            <a class="small" href="{{ env('APP_URL') }}login">Go to login</a>
        </div>
    @elseif($message_status == 'Throttled reset attempt')
        <div class="text-center">
            <h1 class="h2 mb-4 text-gray-900">Stop!</h1>
            <p class="mb-4">Multiple request is not allowed please check your previous request first.</p>
        </div>
        <hr>
        <div class="text-center">
            <a class="small" href="{{ env('APP_URL') }}login">Go to login</a>
        </div>
    @elseif($message_status == 'The Server encounters an error for your request!')
        <div class="text-center">
            <h1 class="h2 mb-4 text-gray-900">Server Error!</h1>
            <p class="mb-4">The Server encounters an error for your request!</p>
            <p class="mb-4">Kindly coordinate with your Administrator.</p>
        </div>
        <hr>
        <div class="text-center">
            <a class="small" href="{{ env('APP_URL') }}login">Go to login</a>
        </div>
    @else
        <div class="text-center">
            <p>{{ $message_status }}</p>
            <h1 class="h2 mb-4 text-gray-900">Forgot your Password?</h1>
            <p class="mb-4">We get it, stuff happens. Just enter your email address below and we'll send you a link to reset your password.</p>
        </div>
        <form class="user" action="{{ env('APP_URL') }}forgot-password" onsubmit="processAlert()">
            @csrf

            <div class="mb-3">
                <label for="email">Email</label>
                <input type="email" name="email" required autofocus autocomplete="email">
                @error('email')
                    <span class="invalid" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="btn btn-primary">Reset Password</button>
            </div>

            <div class="my-5 flex justify-end">
                <a class="text-sm text-slate-500 hover:underline" href="{{ env('APP_URL') }}login">Already have an account? Login!</a>
            </div>
        </form>
    @endif
@endsection
