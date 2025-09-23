@extends('site.app')
@section('title','Doctor Application Form')
@section('content') 
<div class="container">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="fw-bold my-4 h4">
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{route('site.home')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Doctor Application Form</li>
        </ol>
    </nav>
    <div class="d-flex flex-column gap-3 account-form mx-auto mt-5">
        <form class="form"action="{{route('doctor.application.store')}}" method="POST"enctype="multipart/form-data">
            @csrf
            @if (session()->has('success'))
                 <div class="alert alert-success">{{session('success')}}</div> 
            @endif
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
                    <label class="form-label required-label" for="major">Major</label>
                    <input type="major" class="form-control" id="major" name='major'value="{{ old('major') }}" required>
                        @error('major')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label required-label" for="session_price">Session_Price</label>
                    <input type="session_price" class="form-control" id="session_price" name='session_price'value="{{ old('session_price') }}" required>
                        @error('session_price')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label required-label" for="exampleInputFile">Degree_Certificate</label>
                    <div class="custom-file">
                        <input type="file" name="degree_certificate" class="form-control" class="custom-file-input" id="degree_certificate">
                        @error('degree_certificate')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Send Application</button>
        </form>
    </div>

</div>
</div>
@endsection