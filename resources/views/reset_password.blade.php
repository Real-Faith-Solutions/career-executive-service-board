@extends('layout_plain')

@section('content')
<!-- Outer Row -->
<div class="row justify-content-center">
    <div class="col-xl-9 col-lg-12 col-md-12">
        <h1 class="h1 text-gray-900 mt-4 text-center">Career Executive Service Board</h1>
        <p class="h5 text-gray-700 mb-4 text-center">Reset Password</p>

        <div class="card o-hidden border-0 shadow-lg my-2">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-login-image" style="background-image: url('{{ asset('images/alpha_logo.png') }}'); background-size: 70% auto; background-repeat: no-repeat;background-color: #4e73df;"></div>
                    <div class="col-lg-7">
                        <div class="p-5 mx-5">
                            <div class="text-center">
                                <h1 class="h2 text-gray-900 mb-4">Reset Password</h1>
                                <p class="mb-4">Required Password Pattern: Minimum of eight characters, at least one uppercase letter, one lowercase letter, one number and one special character.</p>
                            </div>
                            <form class="user" method="POST" action="javascript:void(0);" id="reset_password" onsubmit="submitResetPassword()">
                                @csrf

                                <input type="hidden" name="token" value="{{ $token }}">
                                <div class="form-group">
                                    <input id="email" type="email" class="form-control form-control-user" name="email" value="{{ $email }}" placeholder="Email Address" required autocomplete="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input id="password" type="password" class="form-control form-control-user" name="password" placeholder="Password" required autocomplete="new-password">
                                </div>
                                <div class="form-group">
                                    <input id="password-confirm" type="password" class="form-control form-control-user" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">Reset Password</button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="{{ env('APP_URL') }}login">Go to Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br/>

@endsection
