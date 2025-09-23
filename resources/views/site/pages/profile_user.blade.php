@extends('site.app')
@section('title','Profile')
@section('content')

<!-- Sidebar -->
<aside id="mainSidebar" class="bg-blue text-white vh-100 position-fixed sidebar-hidden"
 style="width: 280px; top: 0; left: 0; transition: transform 0.3s ease-in-out; z-index: 1000;">
    <div class="sidebar p-3">
        <!-- Logo -->
        <a href="{{App\Helpers\FileHelper::profile_image($user->image)}}" class="d-flex align-items-center text-white text-decoration-none mb-4">
            <img src="{{App\Helpers\FileHelper::profile_image($user->image)}}" alt="VCare Logo" class="brand-image img-circle elevation-3" style="width: 40px; height: 40px; opacity: 0.8;">
            <span class="brand-text font-weight-light">{{$user->name }}</span>
        </a>
        <a href="{{App\Helpers\FileHelper::profile_image($user->image)}}" class="d-flex align-items-center text-white text-decoration-none mb-4">
            <img src="{{App\Helpers\FileHelper::profile_image($user->image)}}" alt="VCare Logo" class="rounded-circle me-2" style="width: 40px; height: 40px; opacity: 0.8;">
            <span class="fw-bold h5 mb-0">{{$user->name }}</span>
        </a>
        <!-- Logo -->
        <!-- Links -->
        <nav>
            <h4> SettIng </h4>
            <ul class="nav flex-column gap-2">
                <li class="nav-item">
                    <a href="{{route('user.edit.name',$user->id)}}" class="nav-link text-white d-flex align-items-center">
                        <i class="fas fa-home me-2"></i> Edit My Name
                    </a>
                    <a href="{{route('user.edit.email',$user->id)}}" class="nav-link text-white d-flex align-items-center">
                        <i class="fas fa-home me-2"></i> Edit My Email
                    </a>
                    <a href="{{route('user.edit.password',$user->id)}}" class="nav-link text-white d-flex align-items-center">
                        <i class="fas fa-home me-2"></i> Edit My Password
                    </a>
                    <a href="{{route('user.edit.image',$user->id)}}" class="nav-link text-white d-flex align-items-center">
                        <i class="fas fa-home me-2"></i> Edit My Image
                    </a>
                </li>
                @if (auth()->check())
                    <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-light navigation--button">LogOut</button>
                    </form>
                @else
                    <a type="button" class="btn btn-outline-light navigation--button"
                    href="{{route('login.show')}}">Login</a>
                @endif
            </ul>
        </nav>
    </div>
</aside>

<!-- زرار التلت شرط -->
<button id="sidebarToggle" onclick="toggleSidebar()" style="position:fixed;top:20px;left:20px;z-index:1100;background:#0d6efd;border:none;padding:8px 12px;border-radius:4px;box-shadow:0 2px 5px rgba(0,0,0,0.2); color:#fff;">
    <span id="toggleIcon">&#9776;</span>
</button>



<!-- Overlay للموبايل -->
<div id="sidebarOverlay" class="d-md-none" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:999;"></div>

<!-- CSS -->
<style>
    .sidebar-hidden {
        transform: translateX(-100%);
    }

    .sidebar-visible {
        transform: translateX(0);
    }

    /* Content padding to avoid sidebar overlay */
    .content-wrapper {
        padding-left: 0;
        transition: padding-left 0.3s ease-in-out;
    }

    .with-sidebar {
        padding-left: 280px;
    }

    @media (max-width: 768px) {
        .with-sidebar {
            padding-left: 0;
        }
    }
</style>

<!-- Wrapper للمحتوى -->
<div class="container">
    @if (session()->has('success'))
                 <div class="alert alert-success">{{session('success')}}</div> 
            @endif
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="fw-bold my-4 h4">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{route('site.home')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Appointment</li>
                </ol>
            </nav>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Name of Booking</th>
                        <th scope="col">phone</th>
                        <th scope="col">Doctor Name</th>
                        <th scope="col">Session Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                        <tr>
                            <td>{{ $booking->booking_date }}</td>
                            <td>{{ $booking->name }}</td>
                            <td>{{ $booking->phone }}</td>
                            <td class="d-flex align-items-center gap-2">
                            <img src="{{App\Helpers\FileHelper::profile_image($booking->doctor->image)}}" alt="" width="50" height="40" class="rounded-circle">
                            {{$booking->doctor->name}}
                            </td>
                            <td>{{ $booking->doctor->booking_price }}</td>
                            <td>
                            <form action="{{route('booking.destroy',$booking->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">DELETE</button>
                                <a class="btn btn-warning" href="{{route('rate.doctor',$booking->doctor->id)}}">Rate Doctor</a>
                            </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
<!-- JavaScript -->
<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('mainSidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const toggleIcon = document.getElementById('toggleIcon');
        const contentWrapper = document.getElementById('contentWrapper');

        const isVisible = sidebar.classList.contains('sidebar-visible');

        if (isVisible) {
            sidebar.classList.remove('sidebar-visible');
            sidebar.classList.add('sidebar-hidden');
            toggleIcon.innerHTML = "&#9776;";
            overlay.style.display = "none";
            contentWrapper.classList.remove('with-sidebar');
        } else {
            sidebar.classList.remove('sidebar-hidden');
            sidebar.classList.add('sidebar-visible');
            toggleIcon.innerHTML = "&times;";
            overlay.style.display = "block";
            contentWrapper.classList.add('with-sidebar');
        }
    }
</script>

@endsection
