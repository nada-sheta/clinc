@extends('dashboard.app')
@section('title','Pending Doctor Requests')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Pending Doctor Requests</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Pending Doctor Requests</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    {{-- @if (session()->has('success'))
            <div class="alert alert-success">{{session('success')}}</div> 
    @endif --}}

    <div class="container-fluid">
      {{-- <div class="mb-3">
        <a href="{{route('dashboard.doctors.create')}}" class="btn btn-primary">Add New Doctor</a>
      </div> --}}
    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Doctors Requests</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>Name</th>
                <th>phone</th>
                <th>Major</th>
                <th>Email</th>
                <th>session_price</th>
                <th>Degree_Certificate</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($requests as $request)
              <tr>
                <td>{{$request->id}}</td>
                <td>{{$request->name}}</td>
                <td>{{$request->phone}}</td>
                <td>{{$request->major}}</td>
                <td>{{$request->email}}</td>
                <td>{{$request->session_price}}</td>
                <td>
                  <a href="{{ $request->degree_certificate }}" target="_blank">
                    <img src="{{App\Helpers\FileHelper::profile_image($request->degree_certificate)}}"
                        class="profile-user-img img-fluid img-circle"
                        alt="major"
                        style="width: 60px; height: 60px; object-fit: cover;">
                  </a>
                </td>
                <td>
                  <a class="btn btn-secondary" href="{{route('dashboard.doctors.create',$request->id)}}" >Accept ➡️ Add in site</a>
                  <form action="{{route('dashboard.doctor.request.destroy',$request->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">DELETE</button>
                    </form>
                </td>
              </tr>
            </tbody>
                @endforeach
          </table>
        </div>
      </div>
    </div>
</div>
@endsection