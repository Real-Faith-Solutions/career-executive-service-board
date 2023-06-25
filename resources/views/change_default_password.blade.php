@extends('layout_plain')

@section('content')
<!-- Outer Row -->
<div class="row justify-content-center">
    <div class="col-xl-9 col-lg-12 col-md-12">
        <h1 class="h1 text-gray-900 mt-4 text-center">Career Executive Service Board</h1>
        <p class="h5 text-gray-700 mb-4 text-center">Welcome on your first login using the default password {{ Auth::user()->first_name }}!</p>

        <div class="card o-hidden border-0 shadow-lg my-2">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-login-image" style="background-image: url('{{ asset('images/alpha_logo.png') }}'); background-size: 70% auto; background-repeat: no-repeat;background-color: #4e73df;"></div>
                    <div class="col-lg-7">
                        <div class="p-5 mx-5">
                            <div class="text-center">
                                <p class="h2 text-gray-900 mb-4">Changed Password</p>
                                <p class="h6 text-gray-900 mb-4">You are required to change the default password.</p>
                                <p class="mb-4">Required Password Pattern: Minimum of eight characters, at least one uppercase letter, one lowercase letter, one number and one special character.</p>
                            </div>
                            <form class="user" id="change_default_password_form" method="POST" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/user/change-default-password`, `change_default_password_form`, `Update`, `None`, `None`, `None`, `None`, `@if(Auth::user()->role == 'User'){{ env('APP_URL') }}admin/profile/views/{{ Auth::user()->cesno }}@else{{ env('APP_URL') }}@endif`)">
                                @csrf

                                <div class="form-group">
                                    <input type="email" placeholder="Email" id="email" name="email" class="form-control form-control-user" value="{{ $email }}" required autofocus>
                                </div>
                                <div class="form-group">
                                    <input type="password" placeholder="Old Password" id="input_old_password" name="input_old_password" class="form-control form-control-user" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" placeholder="New Password" id="new_password" name="new_password" class="form-control form-control-user" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" placeholder="Confirm New Password" id="new_password_confirmation" name="new_password_confirmation" class="form-control form-control-user" required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">Change Password</button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="{{ env('APP_URL') }}">Home Page</a>
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
