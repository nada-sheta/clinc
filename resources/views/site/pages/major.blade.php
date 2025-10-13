@extends('site.app')
@section('title','Majors')
@section('content')
    <div class="container">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="fw-bold my-4 h4">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a class="text-decoration-none" 
                    href="{{route('site.home')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Majors</li>
            </ol>
        </nav>
        {{-- search --}}
        <div class="mb-4 d-flex justify-content-center">
            <div class="input-group w-50">
                <input type="text" id="search-input" class="form-control rounded-start"
                        placeholder="Find a major...">
                <span class="input-group-text bg-primary text-white rounded-end">
                    <i class="bi bi-search"></i>
                </span>
            </div>
        </div>
        <div class="majors-grid">
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
    </div>
</div>
@endsection
@push('script')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-input');
    const majorsGrid = document.querySelector('.majors-grid');

    // نحفظ الكروت الأصلية لو حابة ترجعيها بعد مسح البحث
    const originalCards = majorsGrid.innerHTML;

    searchInput.addEventListener('keyup', function() {
        const query = this.value.trim();

        if (query === '') {
            majorsGrid.innerHTML = originalCards;
            return;
        }

        fetch(`{{ route('search.majors') }}?query=${query}`)
            .then(response => response.json())
            .then(data => {
                let html = '';

                if (data.majors.length === 0) {
                    html = '<p class="text-center">No majors found</p>';
                } else {
                    data.majors.forEach(major => {
                        html += `
                        <div class="card p-2" style="width: 18rem;">
                            <img src="${major.image}" class="card-img-top rounded-circle card-image-circle" alt="major">
                            <div class="card-body d-flex flex-column gap-1 justify-content-center">
                                <h4 class="card-title fw-bold text-center">${major.name}</h4>
                                <a href="{{ url('/CLINC/majors') }}/${major.id}" class="btn btn-outline-primary card-button">
                                    Browse Doctors
                                </a>
                            </div>
                        </div>
                        `;
                    });
                }

                majorsGrid.innerHTML = html;
            })
            .catch(error => {
                console.error('Error fetching majors:', error);
            });
    });
});
</script>
@endpush

