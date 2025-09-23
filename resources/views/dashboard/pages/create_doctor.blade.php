@extends('dashboard.app')
@section('title','Add New Doctor')
@section('content')
<div class="content-wrapper">
<form action="{{ $doctor ? route('dashboard.doctors.store', $doctor->id) : route('dashboard.doctors.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
        @if (session()->has('success'))
        <div class="alert alert-success">{{session('success')}}</div> 
    @endif
     <br>
  <div class="col-sm-6">
          <h4 class="font-weight-bold text-dark" class="m-0">Add Doctor In Site ⤵️</h4>
  </div>
    <div class="card-body">
      <div class="form-group">
        <label class="form-check-label" for="name">Doctor Name</label>
        <input type="text" name="name" class="form-control"id="name">
        @error('name')
          <span class="text-danger">{{$message}}</span>
          @enderror
      </div>

      <div class="form-group">
        <label class="form-check-label" for="name">Description</label>
        <input type="text" name="description" class="form-control"id="name">
        @error('description')
          <span class="text-danger">{{$message}}</span>
          @enderror
      </div>

      <div class="form-group">
        <label class="form-check-label" for="name">Booking_Price</label>
        <input type="text" name="booking_price" class="form-control"id="booking_price">
        @error('booking_price')
          <span class="text-danger">{{$message}}</span>
          @enderror
      </div>

      <div class="form-group">
        <label class="form-check-label" for="major_id">Select Major</label>
        <select name="major_id" class="form-control" id="major_id">
        <option value=""> Select Major </option>
    @foreach ($majors as $major)
        <option value="{{ $major->id }}">{{ $major->name }}</option>
    @endforeach
        </select>
    @error('major_id')
        <span class="text-danger">{{ $message }}</span>
    @enderror
    </div>


    <div class="form-check-label" class="form-group">
        <label class="form-check-label" for="exampleInputFile">Image</label>
        <div class="input-group">
          <div class="custom-file">
            <input type="file" name="image" class="custom-file-input" id="image">
            <label class="custom-file-label" for="image">Choose file</label>
            @error('image')
              <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
          <div class="input-group-append">
            <span class="input-group-text">Upload</span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
          <h4 class="font-weight-bold text-dark" class="m-0">Create Doctor Account ⤵️</h4>
      </div>
      <div class="form-items">
        <div class="card-body">
          <div class="mb-3">
            <label class="form-check-label" for="email">Email</label>
            <input type="email" class="form-control" id="email" name='email'value="{{ old('email') }}" required>
                @error('email')
                <span class="text-danger">{{$message}}</span>
                @enderror
          </div>
          <div class="mb-3">
            <label class="form-check-label" for="password">password</label>
            <input type="password" class="form-control" id="password" name='password'value="{{ old('password') }}" required>
                @error('password')
                <span class="text-danger">{{$message}}</span>
                @enderror
          </div>
        </div>
      </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </form>
</div>
@endsection