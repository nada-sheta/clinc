@extends('dashboard.app')
@section('title','ADMIN')
@section('content')
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div>
      </div>
    </div>
  </div>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{ $doctorCount }}</h3>
              <p>Doctors</p>
            </div>
            <div class="icon">
              <i class="fas fa-user-md"></i>
            </div>
            <a href="{{route('dashboard.doctors')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{ $PatientCount }}</h3>
              <p>Patients</p>
            </div>
            <div class="icon">
              <i class="fas fa-users"></i>
            </div>
            <a href="{{route('dashboard.patients')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{ $bookingCount }}</h3>
              <p>Bookings</p>
            </div>
            <div class="icon">
              <i class="fas fa-clock"></i>
            </div>
            <a href="{{route('dashboard.bookings')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>{{ $ratingCount }}</h3>
              <p>Reviews</p>
            </div>
            <div class="icon">
              <i class="fas fa-star"></i>
            </div>
            <a href="{{route('dashboard.ratings')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Chart Section -->
  <div class="container">
    <h1 class="mb-4">Bookings Chart</h1>
    <div class="card">
      <div class="card-header">
        Bookings (Daily, Weekly, Monthly, Yearly)
      </div>
      <div class="card-body">
        <canvas id="bookingsChart" style="min-height:300px; height:300px; max-height:400px; width:100%;"></canvas>
      </div>
    </div>
  </div>
</div>

 <!-- Chart Section -->
  <div class="card">
    <div class="card-header bg-primary text-white">
      Bookings (Daily, Weekly, Monthly, Yearly)
    </div>
    <div class="card-body">
      <canvas id="bookingsChart" style="min-height:300px; height:300px; max-height:400px; width:100%;"></canvas>
    </div>
  </div>
</div>

<!-- Chart Script -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    var ctx = document.getElementById('bookingsChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Daily', 'Weekly', 'Monthly', 'Yearly'],
            datasets: [{
                label: 'Bookings Count',
                data: [
                  {{ $dailyBookings }},
                  {{ $weeklyBookings }},
                  {{ $monthlyBookings }},
                  {{ $yearlyBookings }}
                ],
                backgroundColor: ['#f56954', '#00c0ef', '#00a65a', '#f39c12']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });
});
</script>

@endsection
