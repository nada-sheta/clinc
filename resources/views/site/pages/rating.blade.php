@extends('site.app')
@section('title','Rate Doctor')
@section('content')
<div class="container my-5">
    <div class="card shadow-lg p-4 rounded-3">
        <h2 class="fw-bold text-center text-primary">Rate Doctor</h2>
        <div class="text-center mb-4">
            <img src="{{App\Helpers\FileHelper::profile_image($doctor->image)}}"
                alt="{{ $doctor->name }}" 
                class="rounded-circle mb-3" 
                style="width: 120px; height: 120px; object-fit: cover;">
            <h4 class="fw-bold">{{ $doctor->name }}</h4>
            <p class="text-muted">{{ $doctor->specialty ?? 'Specialty not set' }}</p>
        </div>
        <form action="{{ route('rate.store', $doctor->id) }}" method="POST">
            @csrf
            <div class="mb-4 text-center">
                <label class="form-label d-block mb-2 fw-bold">Your Rating:</label>
                <div class="star-rating d-flex justify-content-center flex-row-reverse">
                    @for ($i = 5; $i >= 1; $i--)
                        <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" class="d-none" required>
                        <label for="star{{ $i }}" class="mx-1" style="font-size: 2rem; cursor: pointer; color: #ccc;">
                            ★
                        </label>
                    @endfor
                </div>
            </div>
            <div class="mb-4">
                <label for="comment" class="form-label fw-bold">Your Comment:</label>
                <textarea name="comment" id="comment" rows="4" class="form-control" placeholder="Write your feedback..."></textarea>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary px-5">Submit Rating</button>
            </div>
        </form>
    </div>
</div>

{{-- تنسيق النجوم --}}
@push('script')
<script>
    document.querySelectorAll('.star-rating input').forEach(radio => {
        radio.addEventListener('change', function() {
            let stars = document.querySelectorAll('.star-rating label');
            stars.forEach((star, index) => {
                // عشان نحول النجوم المصبوغة بناءً على القيمة
                if (5 - index < this.value) {
                    star.style.color = '#ccc';
                } else {
                    star.style.color = '#ffc107';
                }
            });
        });
    });
</script>
@endpush
@endsection