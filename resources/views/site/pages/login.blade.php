@extends('site.app')
@section('title','Login')
@section('content') 
<div class="container">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="fw-bold my-4 h4">
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{route('site.home')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">login</li>
        </ol>
    </nav>
    <div class="d-flex flex-column gap-3 account-form mx-auto mt-5" style="max-width: 400px;">
        <form class="form" action="{{route('login.auth')}}" method="POST">
            @csrf
            @if (session()->has('error'))
                <div class="alert alert-danger">{{session('error')}}</div> 
            @endif
            <div class="mb-3">
                <label class="form-label required-label" for="email" >Email</label>
                <input type="email" class="form-control" id="email" name='email' required>
                @error('email')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            
            <div class="mb-3 position-relative">
                <label class="form-label required-label" for="password">Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" required>
                    <span class="input-group-text" onclick="togglePassword()" style="cursor: pointer;">
                        <i class="bi bi-eye" id="toggleIcon"></i>
                    </span>
                </div>
                @error('password')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="remember" id="remember">
                <label class="form-check-label" for="remember">Remember Me</label>
            </div>
            <br>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>

        <a href="{{ route('google.login') }}" class="google-btn mt-2">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 533.5 544.3" width="20" height="20">
                <path fill="#4285F4" d="M533.5 278.4c0-17.8-1.5-35-4.4-51.8H272v98h146.9c-6.4 34-25 62.8-53.4 82v68h86.2c50.6-46.6 81.8-115.3 81.8-196.2z"/>
                <path fill="#34A853" d="M272 544.3c72.4 0 133.2-23.8 177.6-64.8l-86.2-68c-24.2 16.2-55.2 25.8-91.4 25.8-70.4 0-130-47.4-151.3-111.3H33.5v69.9C77.8 480.4 168 544.3 272 544.3z"/>
                <path fill="#FBBC05" d="M120.7 321.9c-10.2-30.6-10.2-63.5 0-94.1V158H33.5c-36.7 72.4-36.7 158.9 0 231.3l87.2-67.4z"/>
                <path fill="#EA4335" d="M272 107.7c38.5 0 73 13.3 100.3 39.2l75.1-75.1C405.1 24.4 344.3 0 272 0 168 0 77.8 63.9 33.5 158l87.2 69.9c21.3-63.9 80.9-111.2 151.3-111.2z"/>
            </svg>
            <span>Login with Google</span>
        </a>

        <div class="text-center mt-2">
            <a href="{{ route('password.request') }}" class="link">Forgot Your Password?</a>
        </div>
        <div class="d-flex justify-content-center gap-2 flex-column flex-lg-row flex-md-row flex-sm-column">
            <span>don't have an account?</span><a class="link" href="{{route('register.show')}}">create account</a>
        </div>
    </div>
</div>

{{-- سكربت اظهار/اخفاء الباسورد --}}
<script>
    function togglePassword() {
        const passwordInput = document.getElementById("password");
        const toggleIcon = document.getElementById("toggleIcon");
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggleIcon.classList.remove("bi-eye");
            toggleIcon.classList.add("bi-eye-slash");
        } else {
            passwordInput.type = "password";
            toggleIcon.classList.remove("bi-eye-slash");
            toggleIcon.classList.add("bi-eye");
        }
    }
</script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>
.google-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    background-color: #fff;
    color: #444;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 10px;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.3s ease;
    width: 100%;
    font-size: 16px;
}
.google-btn svg {
    display: block;
}
.google-btn:hover {
    background-color: #f7f7f7;
    box-shadow: 0 2px 5px rgba(0,0,0,0.15);
    color: #000;
}
</style>
@endsection
