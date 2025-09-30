@extends('site.app')
@section('title','Doctors')
@section('content')
    <div class="container">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="fw-bold my-4 h4">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a class="text-decoration-none"
                     href="{{route('site.home')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">doctors</li>
            </ol>
        </nav>
        <div class="doctors-grid">
            <div class="d-flex flex-wrap gap-4 justify-content-center">
                @foreach ($doctors as $doctor)
            <div class="card p-2" style="width: 18rem;">
                <img src="{{App\Helpers\FileHelper::profile_image($doctor->image)}}"  class="card-img-top rounded-circle card-image-circle"
                    alt="major">
                <div class="card-body d-flex flex-column gap-1 justify-content-center">
                    <h4 class="card-title fw-bold text-center">{{$doctor->name}}</h4>
                    <h5 class="card-title text-center">{{$doctor->major->name}}</h5>
                    <h6 class="card-title text-center">Booking Price : {{$doctor->booking_price}}</h6>
                            {{-- متوسط التقييم --}}
                            <p class="text-center">
                                @if($doctor->ratings_avg_rating)
                                @php
                                    $rating = round($doctor->ratings_avg_rating); // نقرب المتوسط لأقرب عدد صحيح
                                @endphp

                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $rating)
                                        <span style="color: gold; font-size:20px;">&#9733;</span> {{-- نجم متلوّن --}}
                                    @else
                                        <span style="color: #ccc; font-size:20px;">&#9733;</span> {{-- نجم فاضي --}}
                                    @endif
                                @endfor
                            @else
                                <span style="color: #999;">No ratings yet</span>
                            @endif
                            </p>

                    <a href="{{route('doctors.show',$doctor->id)}}" 
                    class="btn btn-outline-primary card-button">Book an appointment</a>
                </div>
            </div>
                @endforeach
            </div>
         </div>        
        {{-- <nav class="mt-5" aria-label="navigation">
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link page-prev" href="#" aria-label="Previous">
                        <span aria-hidden="true">
                            < </span>
                    </a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link page-next" href="#" aria-label="Next">
                        <span aria-hidden="true"> > </span>
                    </a>
                </li>
            </ul>
        </nav> --}}
    </div>
</div>
@endsection
    @push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/js/bootstrap.min.js"
    integrity="sha512-fHY2UiQlipUq0dEabSM4s+phmn+bcxSYzXP4vAXItBvBHU7zAM/mkhCZjtBEIJexhOMzZbgFlPLuErlJF2b+0g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @endpush