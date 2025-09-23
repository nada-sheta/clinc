@extends('dashboard.app')
@section('title','Doctors')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">All Doctors</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">All Doctors</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    @if (session()->has('success'))
            <div class="alert alert-success">{{session('success')}}</div> 
    @endif

    <div class="container-fluid">
      <div class="mb-3">
        <a href="{{route('dashboard.doctors.create')}}" class="btn btn-primary">Add New Doctor</a>
      </div>
    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Doctors Table</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>Name</th>
                <th>Image</th>
                <th>Major</th>
                <th>Description</th>
                <th>Booking_price</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($doctors as $doctor)
              <tr>
                <td>{{$doctor->id}}</td>
                <td>{{$doctor->name}}</td>
                <td><img src="{{App\Helpers\FileHelper::profile_image($doctor->image)}}" 
                         class="profile-user-img img-fluid img-circle" alt="major"></td>
                <td>{{$doctor->major->name}}</td>
                <td>{{$doctor->description}}</td>
                <td>{{$doctor->booking_price}}</td>
                <td>
                  <a class="btn btn-secondary" href="{{route('dashboard.doctors.edit',$doctor->id)}}" >Edit</a>
                  <form action="{{route('dashboard.doctors.destroy',$doctor->id)}}" method="POST">
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
        <!-- /.card-body -->
        {{-- <div class="card-footer clearfix">
          <ul class="pagination pagination-sm m-0 float-right">
            <li class="page-item"><a class="page-link" href="#">«</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">»</a></li>
          </ul>
        </div> --}}
      </div>
    </div>
</div>
@endsection