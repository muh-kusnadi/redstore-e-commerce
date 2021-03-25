@extends('layouts.master_front')
@section('content')

<!-- start account page -->
<div class="account-page">
    <div class="container">
        <div class="row">
            <div class="col-2">
                <img src="{{ asset('assets/images/image1.png') }}" alt="image1" width="100%">
            </div>
            <div class="col-2">
                <div class="form-container">
                    <div class="form-btn">
                        <span onclick="login()">Login</span>
                        <span onclick="register()">Register</span>
                        <hr id="indicator">
                    </div>

                    {{-- @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div>{{$error}}</div>
                        @endforeach
                    @endif --}}

                    <form id="loginForm" method="POST" action="{{ route('auth.login') }}">
                    @csrf
                    <input 
                        id="email" 
                        type="email" 
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="E-Mail"
                        required autocomplete="email" autofocus>
                    <input 
                        id="password" 
                        type="password" 
                        placeholder="Password"
                        name="password"
                        required autocomplete="current-password">
                    <button type="submit" class="btn">Login</button>
                    {{-- <a href="">Forgot Password</a> --}}
                    </form>

                    <form id="registerForm" method="POST" action="{{ route('auth.register') }}">
                    @csrf
                    <input 
                        type="text" 
                        placeholder="Name" 
                        id="name"
                        name="name" 
                        value="{{ old('name') }}" 
                        autocomplete="name" autofocus>
                    <input 
                        type="email" 
                        placeholder="Email" 
                        id="email"
                        name="email" 
                        value="{{ old('email') }}" 
                        autocomplete="email">
                    <input 
                        type="password" 
                        placeholder="Password"
                        id="password"
                        name="password">
                    <input 
                        type="password" 
                        placeholder="Retype Password" 
                        id="password-confirm"
                        name="password_confirmation">
                    <button type="submit" class="btn">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end account page -->

@endsection

@push('scripts')
<!-- js for toggle form -->
<script>
    var loginForm = document.getElementById("loginForm");
    var registerForm = document.getElementById("registerForm");
    var indicator = document.getElementById("indicator");

    function register() {
        registerForm.style.transform = "translateX(-300px)";
        loginForm.style.transform = "translateX(-300px)";
        indicator.style.transform = "translateX(100px)";
    }

    function login() {
        registerForm.style.transform = "translateX(0px)";
        loginForm.style.transform = "translateX(0px)";
        indicator.style.transform = "translateX(0px)";
    }
</script>
@endpush