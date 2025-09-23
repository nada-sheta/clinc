@extends('site.app')
@section('title','Edit Name')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow rounded">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Edit Name Information</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.update.name', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- User Name --}}
                        <div class="form-group mb-3">
                            <label for="name">User Name</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{ $user->name }}">
                            @error('name')
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
