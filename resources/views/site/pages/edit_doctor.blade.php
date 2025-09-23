@extends('site.app')
@section('title','Edit Doctor')
@section('content')

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow rounded">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Edit Doctor Information</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('doctor.update', $doctor->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- doctor Name --}}
                        <div class="form-group mb-3">
                            <label for="name">Doctor Name</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{ $doctor->name }}">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- doctor Email --}}
                        <div class="form-group mb-3">
                            <label for="email">Doctor Email</label>
                            <input type="email" name="email" class="form-control" id="email" value="{{ $doctor->email }}">
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- doctor Password --}}
                        <div class="form-group mb-3">
                            <label for="password">Doctor Password</label>
                            <input type="password" name="password" class="form-control" id="password">
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- doctor Image --}}
                        <div class="form-group mb-3">
                            <label for="image">Profile Image</label>
                            <input type="file" name="image" class="form-control" id="image">
                            @error('image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Submit Button --}}
                        <div class="form-group text-end">
                            <button type="submit" class="btn btn-primary px-4">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

