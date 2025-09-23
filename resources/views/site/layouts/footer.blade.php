<footer class="container-fluid bg-blue text-white py-3">
    <div class="row gap-2">

        <div class="col-sm order-sm-1">
            <h1 class="h1">About Us</h1>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ipsa nesciunt repellendus itaque,
                laborum
                saepe
                enim maxime, delectus, dicta cumque error cupiditate nobis officia quam perferendis consequatur
                cum
                iure
                quod facere.</p>
        </div>
        <div class="col-sm order-sm-2">
            <h1 class="h1">Links</h1>
            <div class="links d-flex gap-2 flex-wrap">
                    <a href="{{route('site.home')}}" class="link text-white">Home</a>
                    <a href="{{route('site.majors')}}" class="link text-white">Majors</a>
                    <a href="{{route('site.doctors')}}" class="link text-white">Doctors</a>
                    <a href="{{route('doctor.application.show')}}"class="link text-white">Doctor Application Form</a>
                    @if (auth()->check())
                        @can('is-user')
                            <a href="{{ route('profile.user') }}" class="link text-white">User Profile</a>
                        @elsecan('is-doctor')
                            <a href="{{ route('profile.doctor') }}" class="link text-white">Doctor Profile</a>
                        @endcan
                    @endif
                    @if (auth()->check())
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                            <a class="link text-white" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        </form>
                    @else
                        <a class="link text-white" href="{{ route('login.show') }}">Login</a>
                    @endif
            </div>
        </div>
    </div>
</footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/js/bootstrap.min.js"
    integrity="sha512-fHY2UiQlipUq0dEabSM4s+phmn+bcxSYzXP4vAXItBvBHU7zAM/mkhCZjtBEIJexhOMzZbgFlPLuErlJF2b+0g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@stack('script')
</body>

</html>