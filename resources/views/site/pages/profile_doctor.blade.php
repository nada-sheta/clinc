@extends('site.app')
@section('title','Profile')
@section('content')

<!-- Sidebar -->
<aside id="mainSidebar" class="bg-blue text-white vh-100 position-fixed sidebar-hidden"
 style="width: 280px; top: 0; left: 0; transition: transform 0.3s ease-in-out; z-index: 1000;">
    <div class="sidebar p-3">
        <!-- Logo -->
        <a href="{{ asset($doctor->image) }}" class="d-flex align-items-center text-white text-decoration-none mb-4">
            <img src="{{App\Helpers\FileHelper::profile_image($doctor->image)}}" alt="VCare Logo" class="brand-image img-circle elevation-3" style="width: 40px; height: 40px; opacity: 0.8;">
            <span class="brand-text font-weight-light">{{$doctor->name }}</span>
        </a> 
         <a href="{{ asset($doctor->image) }}" class="d-flex align-items-center text-white text-decoration-none mb-4">
            <img src="{{App\Helpers\FileHelper::profile_image($doctor->image)}}" alt="VCare Logo" class="rounded-circle me-2" style="width: 40px; height: 40px; opacity: 0.8;">
            <span class="fw-bold h5 mb-0">{{$doctor->name }}</span>
        </a>
        <!-- Logo -->
        <!-- Links -->
        <nav>
            <h4> SettIng </h4>
            <ul class="nav flex-column gap-2">
                <li class="nav-item">
                    <a href="{{route('doctor.edit',$doctor->id)}}" class="nav-link text-white d-flex align-items-center">
                        <i class="fas fa-home me-2"></i> Edit My Account Data
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('doctor.edit.info')}}" class="nav-link text-white d-flex align-items-center">
                        <i class="fas fa-home me-2"></i> Edit My Data In Site
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('show.schedule', $doctor->id) }}" class="nav-link text-white d-flex align-items-center">
                        <i class="fas fa-home me-2"></i> Manage Schedule
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

<!-- 🔔 زرار الجرس + 💌 زرار الرسائل -->
<div class="d-flex gap-3 align-items-center position-absolute" 
     style="top: 12px; right: 40px; z-index:1100;">

   <!-- زرار النوتفكيشن -->
<div class="dropdown">
    <button class="btn bg-white border shadow-sm position-relative d-flex align-items-center justify-content-center"
            id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false"
            title="Notifications" style="width:42px; height:42px; border-radius:8px;">
        <i class="bi bi-bell text-primary fs-5"></i>

        @if($unreadCount > 0)
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                {{ $unreadCount }}
            </span>
        @endif
    </button>

    <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="notificationDropdown"
        style="width:300px; max-height:350px; overflow-y:auto;">
        
        @forelse($notifications as $notification)
            <li class="p-2 border-bottom notification-item {{ $notification->is_read ? '' : 'fw-bold unread' }}">
                 @if(!$notification->is_read)
                    <span class="me-2 mt-1 bg-primary rounded-circle" style="width:8px; height:8px; display:inline-block;"></span>
                @else
                    <span class="me-2 mt-1" style="width:8px; height:8px; display:inline-block;"></span>
                @endif
                <strong>{{ $notification->title }}</strong><br>
                <small class="text-muted">{{ $notification->message }}</small><br>
                <small class="text-secondary">
                    {{ $notification->created_at->diffForHumans() }}
                </small>
            </li>
        @empty
            <li class="p-2 text-center text-muted">No Notifications</li>
        @endforelse
    </ul>
</div>


    <!-- زرار الرسائل -->
    <div class="dropdown">
        <button class="btn bg-white border shadow-sm position-relative d-flex align-items-center justify-content-center" 
                id="messagesDropdown" data-bs-toggle="dropdown" aria-expanded="false" 
                title="Messages" style="width:42px; height:42px; border-radius:8px;">
            <i class="bi bi-envelope text-primary fs-5"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">2</span>
        </button>

        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="messagesDropdown"
            style="width:300px; max-height:350px; overflow-y:auto;">
            <li class="p-2 border-bottom">
                <strong>Dr. Ahmed</strong><br>
                <small class="text-muted">Your results are ready.</small><br>
                <small class="text-secondary">10 min ago</small>
            </li>
            <li class="p-2 border-bottom">
                <strong>Dr. Sarah</strong><br>
                <small class="text-muted">Reminder for your session tomorrow.</small><br>
                <small class="text-secondary">3 hours ago</small>
            </li>
            <li class="text-center text-muted p-2">
                <a href="#" class="text-decoration-none">View all messages</a>
            </li>
        </ul>
    </div>
</div>

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
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{route('show.rating', auth()->id())}}">My Rating</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Appointments</li>
                </ol>
            </nav>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Name of Booking</th>
                        <th scope="col">phone</th>
                        <th scope="col">Patient Name</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                        <tr>
                            <td>{{ $booking->booking_date }}</td>
                            <td>{{ $booking->name }}</td>
                            <td>{{ $booking->phone }}</td>
                            <td class="d-flex align-items-center gap-2">
                            <img src="{{App\Helpers\FileHelper::profile_image($booking->user->image)}}" alt="" width="25" height="25" class="rounded-circle">
                            {{$booking->user->name}}
                            </td>
                            <td>
                            <form action="{{route('booking.doctor.destroy',$booking->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">DELETE</button>
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
<script>
document.getElementById('notificationDropdown').addEventListener('hide.bs.dropdown', function () {
    fetch('{{ route('notifications.read') }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // شيل الرقم الأحمر بعد ما القائمة تتقفل
            document.querySelector('.badge.bg-danger')?.remove();

            // غير شكل النوتفكيشنات بعد ما القائمة تتقفل
            document.querySelectorAll('.notification-item.unread').forEach(item => {
                item.classList.remove('fw-bold');
                item.classList.remove('unread');
                const dot = item.querySelector('.bg-primary');
                if (dot) dot.style.visibility = 'hidden'; 
            });
        }
    });
});
</script>



@endsection
