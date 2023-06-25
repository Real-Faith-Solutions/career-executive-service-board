@extends('layout_plain')

@section('content')
<!-- Outer Row -->
<div class="row justify-content-center">
    <div class="col-xl-9 col-lg-12 col-md-12">
        <h1 class="h1 text-gray-900 mt-4 text-center">Career Executive Service Board</h1>
        <p class="h5 text-gray-700 mb-4 text-center">Welcome!</p>

        <div class="card o-hidden border-0 shadow-lg my-2">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-login-image" style="background-image: url('{{ asset('images/alpha_logo.png') }}'); background-size: 70% auto; background-repeat: no-repeat;background-color: #4e73df;"></div>
                    <div class="col-lg-7">
                        <div class="p-5 mx-5">
                            <div class="text-center">
                                <p class="h2 text-gray-900 mb-4">Sign-in</p>
                            </div>
                            <form class="user" method="POST" action="{{ env('APP_URL') }}login">
                                @csrf

                                <div class="form-group">
                                    <input type="email" placeholder="Email" id="email" class="form-control form-control-user" name="email" required autofocus>
                                </div>
                                <div class="form-group">
                                    <input type="password" placeholder="Password" id="password" class="form-control form-control-user" name="password" required>
                                </div>
                                <button class="btn btn-primary btn-user btn-block">Login</button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="{{ env('APP_URL') }}forgot-password">Forgot Password?</a>
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
