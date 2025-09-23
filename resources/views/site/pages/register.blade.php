@extends('site.app')
@section('title','Register')
@section('content') 
<div class="container">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="fw-bold my-4 h4">
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{route('site.home')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Register</li>
        </ol>
    </nav>
    <div class="d-flex flex-column gap-3 account-form mx-auto mt-5">
        <form class="form"action="{{route('register.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-items">
                <div class="mb-3">
                    <label class="form-label required-label" for="name">Name</label>
                    <input type="text" class="form-control" id="name" name='name' value="{{ old('name') }}" required>
                        @error('name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label required-label" for="phone">Phone</label>
                    <input type="tel" class="form-control" id="phone" name='phone'value="{{ old('phone') }}" required>
                        @error('phone')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label required-label" for="email">Email</label>
                    <input type="email" class="form-control" id="email" name='email'value="{{ old('email') }}" required>
                        @error('email')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label required-label" for="password">password</label>
                    <input type="password" class="form-control" id="password" name='password'value="{{ old('password') }}" required>
                        @error('password')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleInputFile">Image</label>
                    <div class="custom-file">
                        <input type="file" name="image" class="form-control" class="custom-file-input" id="image">
                        @error('image')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Create account</button>
        </form>
        <div class="d-flex justify-content-center gap-2">
            <span>already have an account?</span><a class="link" href="{{route('login.show')}}"> login</a>
        </div>
    </div>

</div>
</div>
@endsection