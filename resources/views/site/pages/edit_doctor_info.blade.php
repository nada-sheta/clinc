@extends('site.app')
@section('title','Edit Doctor Info')
@section('content')

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow rounded">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Edit Doctor Information</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('doctor.updateInfo') }}" method="POST" enctype="multipart/form-data">
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

                        {{-- Booking Price --}}
                        <div class="form-group mb-3">
                            <label for="booking_price">Booking Price</label>
                            <input type="number" name="booking_price" id="booking_price" class="form-control"
                                   value="{{ $doctor->booking_price }}">
                            @error('booking_price')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Description --}}
                        <div class="form-group mb-3">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control">{{ $doctor->description }}</textarea>
                            @error('description')
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

                        {{-- Submit --}}
                        <div class="form-group text-end">
                            <button type="submit" class="btn btn-primary px-4">Update Info</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
