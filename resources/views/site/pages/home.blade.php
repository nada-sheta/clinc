@extends('site.app')
@section('title','Home')
@section('content')
<div class="container-fluid bg-blue text-white pt-3">
    <div class="container pb-5">
        <div class="row gap-2">
            <div class="col-sm order-sm-2">
                <img src="{{asset('assets')}}/images/banner.jpg" class="img-fluid banner-img banner-img" alt="banner-image"
                    height="200">
            </div>
            <div class="col-sm order-sm-1">
                <h1 class="h1">Have a Medical Question?</h1>
                <br>
                <a type="button" class="btn btn-navbar btn-lg" href="{{ route('show.chat') }}">
                    <h3>
                    ➡️ Ask CliNC 
                    </h3>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <h2 class="h1 fw-bold text-center my-4">Majors</h2>
    <div class="d-flex flex-wrap gap-4 justify-content-center">
        @foreach ($majors as $major)
        <div class="card p-2" style="width: 18rem;">
            <img src="{{App\Helpers\FileHelper::major_image($major->image)}}" class="card-img-top rounded-circle card-image-circle"
                alt="major">
            <div class="card-body d-flex flex-column gap-1 justify-content-center">
                <h4 class="card-title fw-bold text-center">{{$major->name}}</h4>
                <a href="{{route('majors.show',$major->id)}}"
                   class="btn btn-outline-primary card-button">Browse Doctors</a>
            </div>
        </div>
        @endforeach
    </div>
    <h2 class="h1 fw-bold text-center my-4">Doctors</h2>
    <section class="splide home__slider__doctors mb-5">
        <div class="splide__track ">
            <ul class="splide__list">
                @foreach ($doctors as $doctor)
                <li class="splide__slide">
                    <div class="card p-2" style="width: 18rem;">
                        <img src="{{App\Helpers\FileHelper::profile_image($doctor->image)}}" class="card-img-top rounded-circle card-image-circle"
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
                               class="btn btn-outline-primary card-button"> Book an appointment</a>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </section>
</div>
<div class="banner container">
    <div class="info">
        <div class="info__details">
            <img src="https://d1aovdz1i2nnak.cloudfront.net/vezeeta-web-reactjs/55619/_next/static/images/medical-care-icon.svg"
                alt="" width="50" height="50">
            <h4 class="title m-0">
                everything you need is found at VCare.
            </h4>
            <p class="content">
                search for a doctor and book an appointment in a hospital, clinic, home visit or even by phone,
                you
                can also order medicine or book a surgery.
            </p>
        </div>
    </div>
    <div class="bottom--left bottom--content bg-blue text-white">
        <h4 class="title">download the application now</h4>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus facere eveniet in id, quod
            explicabo minus ut, sint possimus, fuga voluptas. Eius molestias eveniet labore ullam magnam sequi
            possimus quaerat!</p>
        <div class="app-group">
            <div class="app">
                <img src="https://d1aovdz1i2nnak.cloudfront.net/vezeeta-web-reactjs/55619/_next/static/images/google-play-logo.svg"
                     href="https://play.google.com/store/games?device=windows">
                    Google Play
            </div>
            <div class="app"><img
                    src="https://d1aovdz1i2nnak.cloudfront.net/vezeeta-web-reactjs/55619/_next/static/images/apple-logo.svg"
                    alt="">App Store</div>
        </div>
    </div>
    <div class="bottom--right bg-blue text-white">
        <img src="{{asset('assets')}}/images/banner.jpg" class="img-fluid banner-img">
    </div>
</div>
</div>   
    @endsection
    @push('script')
    <script src="{{asset('assets/scripts/home.js')}}"></script>
    
    @endpush