@extends('dashboard.app')
@section('title','Add New Major')
@section('content')
<div class="content-wrapper">
<form action="{{route('dashboard.majors.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    @if (session()->has('success'))
        <div class="alert alert-success">{{session('success')}}</div> 
    @endif
    <div class="card-body">
    
      <div class="form-group">
        <label for="name">Major Name</label>
        <input type="text" name="name" class="form-control"id="name">
        @error('name')
          <span class="text-danger">{{$message}}</span>
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
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </form>
</div>
@endsection