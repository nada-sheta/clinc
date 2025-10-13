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
        {{-- search --}}
        <div class="mb-4 d-flex justify-content-center">
            <div class="input-group w-50">
                <input type="text" id="search-input" class="form-control rounded-start"
                        placeholder="Find a doctor...">
                <span class="input-group-text bg-primary text-white rounded-end">
                    <i class="bi bi-search"></i>
                </span>
            </div>
        </div>

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
    </div>
</div>
@endsection
    @push('script')
<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/js/bootstrap.min.js"
    integrity="sha512-fHY2UiQlipUq0dEabSM4s+phmn+bcxSYzXP4vAXItBvBHU7zAM/mkhCZjtBEIJexhOMzZbgFlPLuErlJF2b+0g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- Live Search JS -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-input');
    const doctorsGrid = document.querySelector('.doctors-grid .d-flex');

    searchInput.addEventListener('keyup', function() {
        const query = this.value;

        fetch(`{{ route('search.doctors') }}?query=${query}`)
            .then(response => response.json())
            .then(data => {
                let html = '';

                if(data.doctors.length === 0) {
                    html = '<p class="text-center">No doctors found</p>';
                } else {
                    data.doctors.forEach(doctor => {
                        // حساب النجوم
                        let stars = '';
                        const rating = doctor.ratings_avg_rating ? Math.round(doctor.ratings_avg_rating) : 0;
                        for(let i = 1; i <= 5; i++){
                            if(i <= rating){
                                stars += '<span style="color: gold; font-size:20px;">&#9733;</span>';
                            } else {
                                stars += '<span style="color: #ccc; font-size:20px;">&#9733;</span>';
                            }
                        }
                        if(rating === 0) stars = '<span style="color: #999;">No ratings yet</span>';

                        html += `
                        <div class="card p-2" style="width: 18rem;">
                            <img src="${doctor.image}" class="card-img-top rounded-circle card-image-circle" alt="doctor">
                            <div class="card-body d-flex flex-column gap-1 justify-content-center">
                                <h4 class="card-title fw-bold text-center">${doctor.name}</h4>
                                <h5 class="card-title text-center">${doctor.major_name}</h5>
                                <h6 class="card-title text-center">Booking Price : ${doctor.booking_price}</h6>
                                <p class="text-center">${stars}</p>
                                <a href="doctors/${doctor.id}" class="btn btn-outline-primary card-button">Book an appointment</a>
                            </div>
                        </div>
                        `;
                    });
                }

                doctorsGrid.innerHTML = html;
            })
            .catch(error => {
                console.error('Error fetching doctors:', error);
            });
    });
});
</script>

@endpush