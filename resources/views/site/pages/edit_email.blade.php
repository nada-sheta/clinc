@extends('site.app')
@section('title','Edit Email')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow rounded">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Edit Email Information</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.update.email', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- User Email --}}
                        <div class="form-group mb-3">
                            <label for="email">User Email</label>
                            <input type="email" name="email" class="form-control" id="email" value="{{ $user->email }}">
                            @error('email')
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
