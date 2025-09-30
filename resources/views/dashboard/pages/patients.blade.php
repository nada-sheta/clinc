@extends('dashboard.app')
@section('title','Patients')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">All Patients</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">All Patients</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Patients Table</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Name</th>
                <th>Image</th>
                <th>phone</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($patients as $patient)
              <tr>
                <td>{{$patient->name}}</td>
                <td>
                    @if(App\Helpers\FileHelper::profile_image($patient->image))
                  <img src="{{ App\Helpers\FileHelper::profile_image($patient->image) }}" 
                      class="profile-user-img img-fluid img-circle" alt="service">
                    @else
                        <span>No Image</span>
                    @endif
                <td>
                    @if($patient->phone)
                       {{$patient->phone}}
                    @else
                        <span>No Phone</span>
                    @endif
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