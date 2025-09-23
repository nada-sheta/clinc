@extends('dashboard.app')
@section('title','Majors')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">All Majors</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">All Majors</li>
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
        <a href="{{route('dashboard.majors.create')}}" class="btn btn-primary">Add New Major</a>
      </div>
    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Majors Table</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>name</th>
                <th>image</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($majors as $major)
              <tr>
                <td>{{$major->id}}</td>
                <td>{{$major->name}}</td>
                <td><img src="{{App\Helpers\FileHelper::major_image($major->image)}}" 
                         class="profile-user-img img-fluid img-circle" alt="major"></td>
                <td>
                    <a class="btn btn-secondary" href="{{route('dashboard.majors.edit',$major->id)}}" >Edit</a>
                  <form action="{{route('dashboard.majors.destroy',$major->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">DELETE</button>
                  </form>
                    <a class="btn btn-warning" href="{{route('dashboard.majors.show',$major->id)}}">Show Doctors</a>
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