@extends('dashboard.app')
@section('title','Edit Doctor')
@section('content')
<div class="content-wrapper">
<form action="{{route('dashboard.doctors.update',$doctor->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="card-body">
    
      <div class="form-group">
        <label for="name">Doctor Name</label>
        <input type="text" name="name" class="form-control"id="name" value="{{$doctor->name}}">
        @error('name')
          <span class="text-danger">{{$message}}</span>
          @enderror
      </div>

      <div class="form-group">
        <label for="name">Description</label>
        <input type="text" name="description" class="form-control"id="name" value="{{$doctor->description}}">
        @error('description')
          <span class="text-danger">{{$message}}</span>
          @enderror
      </div>

      <div class="form-group">
        <label for="name">Booking_Price</label>
        <input type="text" name="booking_price" class="form-control"id="booking_price" value="{{$doctor->booking_price}}">
        @error('booking_price')
          <span class="text-danger">{{$message}}</span>
          @enderror
      </div>


      <div class="form-group">
        <label for="major_id">Select Major</label>
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


      <div class="form-group">
        <label for="exampleInputFile">Image</label>
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
      {{-- <div class="form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
      </div> --}}
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <button type="submit" class="btn btn-primary">EDIT</button>
    </div>
  </form>
</div>
@endsection