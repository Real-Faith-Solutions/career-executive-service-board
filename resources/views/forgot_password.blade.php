@extends('layout_plain')

@section('content')
<!-- Outer Row -->
<div class="row justify-content-center">
    <div class="col-xl-9 col-lg-12 col-md-12">
        <h1 class="h1 text-gray-900 mt-4 text-center">Career Executive Service Board</h1>
        <p class="h5 text-gray-700 mb-4 text-center">Forgot Password</p>

        <div class="card o-hidden border-0 shadow-lg my-2">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-login-image" style="background-image: url('{{ asset('images/alpha_logo.png') }}'); background-size: 70% auto; background-repeat: no-repeat;background-color: #4e73df;"></div>
                    <div class="col-lg-7">
                        <div class="p-5 mx-5">

                            @if($message_status == 'Reset password link successfully sent to your email')

                            <div class="text-center p-5">
                                <h1 class="h2 text-gray-900 mb-4">Reset link sent!</h1>
                                <p class="mb-4">{{ $message_status }}.</p>
                                <p class="mb-4">You may close this window.</p>
                            </div>
                            @elseif($message_status == 'User not found please check the provided email')

                            <div class="text-center">
                                <h1 class="h2 text-gray-900 mb-4">Not found!</h1>
                                <p class="mb-4">{{ $message_status }}.</p>
                            </div>
                            <form class="user" action="{{ env('APP_URL') }}forgot-password" onsubmit="processAlert()">
                                @csrf 

                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" name="email" value="{{ $email }}" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">Reset Password</button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="{{ env('APP_URL') }}login">Already have an account? Login!</a>
                            </div>
                            @elseif($message_status == 'Throttled reset attempt')

                            <div class="text-center">
                                <h1 class="h2 text-gray-900 mb-4">Stop!</h1>
                                <p class="mb-4">Multiple request is not allowed please check your previous request first.</p>
                            </div>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="{{ env('APP_URL') }}login">Go to login</a>
                            </div>
                            @elseif($message_status == 'Throttled reset attempt')

                            <div class="text-center">
                                <h1 class="h2 text-gray-900 mb-4">Stop!</h1>
                                <p class="mb-4">Multiple request is not allowed please check your previous request first.</p>
                            </div>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="{{ env('APP_URL') }}login">Go to login</a>
                            </div>
                            @elseif($message_status == 'The Server encounters an error for your request!')

                            <div class="text-center">
                                <h1 class="h2 text-gray-900 mb-4">Server Error!</h1>
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
                                <h1 class="h2 text-gray-900 mb-4">Forgot your Password?</h1>
                                <p class="mb-4">We get it, stuff happens. Just enter your email address below and we'll send you a link to reset your password.</p>
                            </div>
                            <form class="user" action="{{ env('APP_URL') }}forgot-password" onsubmit="processAlert()">
                                @csrf 

                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" name="email" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">Reset Password</button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="{{ env('APP_URL') }}login">Already have an account? Login!</a>
                            </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br/>

@endsection
