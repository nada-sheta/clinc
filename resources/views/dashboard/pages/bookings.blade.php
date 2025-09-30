@extends('dashboard.app')
@section('title','Bookings')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">All Bookings</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">All Bookings</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Bookings Table</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Name Patient</th>
                <th>phone Patient</th>
                <th>Name Doctor</th>
                <th>Doctor's Department</th>
                <th>Booking Price</th>
                <th>Booking Date</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
              <tr>
                <td>{{$booking->name}}</td>
                <td>
                    @if($booking->phone)
                       {{$booking->phone}}
                    @else
                        <span>No Phone</span>
                    @endif
                </td>
                <td>{{$booking->doctor->name}}</td>
                <td>{{$booking->doctor->major->name}}</td>
                <td>{{$booking->doctor->booking_price}}</td>
                <td>{{$booking->booking_date}}</td>
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