<body>
    <div class="page-wrapper">
        <nav class="navbar navbar-expand-lg navbar-expand-md bg-blue sticky-top">
                <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
            <div class="container">
                <div class="navbar-brand">
                    <a class="fw-bold text-white m-0 text-decoration-none h3" 
                     href="{{route('site.home')}}">VCare</a>
                </div>
                <button class="navbar-toggler btn-outline-light border-0 shadow-none" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <div class="d-flex gap-3 flex-wrap justify-content-center" role="group">
                        <a type="button" class="btn btn-outline-light navigation--button" 
                           href="{{route('site.home')}}">Home</a>
                        <a type="button" class="btn btn-outline-light navigation--button"
                            href="{{route('site.majors')}}">Majors</a>
                        <a type="button" class="btn btn-outline-light navigation--button"
                            href="{{route('site.doctors')}}">Doctors</a>
                        <a type="button" class="btn btn-outline-light navigation--button"
                            href="{{route('doctor.application.show')}}">Doctor Application Form</a>
                        @if (auth()->check())
                            @can('is-user')
                                <a type="button" class="btn btn-outline-light navigation--button"
                                href="{{ route('profile.user') }}">User Profile</a>
                            @elsecan('is-doctor')
                                <a type="button" class="btn btn-outline-light navigation--button"
                                href="{{ route('profile.doctor') }}">Doctor Profile</a>
                            @endcan
                        @endif
                        @if (auth()->check())
                                <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outline-light navigation--button">LogOut</button>
                                </form>
                            @else
                                <a type="button" class="btn btn-outline-light navigation--button"
                                href="{{route('login.show')}}">Login</a>
                        @endif
                    </div>
                </div>
            </div>
        </nav>