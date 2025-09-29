@extends('site.app')
@section('title','Booking')
@section('content')
<div class="page-wrapper">
  
    <div class="container">
      <nav
        style="--bs-breadcrumb-divider: '>'"
        aria-label="breadcrumb"
        class="fw-bold my-4 h4"
      >
        <ol class="breadcrumb justify-content-center">
          <li class="breadcrumb-item">
            <a class="text-decoration-none" href="{{route('site.home')}}">Home</a>
          </li>
          <li class="breadcrumb-item">
            <a class="text-decoration-none" href="{{route('site.doctors')}}">Doctors</a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">
            {{ $doctor->name}}
          </li>
        </ol>
      </nav>

      <!-- Doctor Details -->
      <div class="d-flex flex-column gap-3 details-card doctor-details">
        <div class="details d-flex gap-2 align-items-center">
          <img
            src="{{App\Helpers\FileHelper::profile_image($doctor->image)}}"
            alt="doctor"
            class="img-fluid rounded-circle"
            height="150"
            width="150"
          />
          <div class="details-info d-flex flex-column gap-3">
            <h3 class="card-title fw-bold">{{ $doctor->name}}</h3>
            <h7 class="card-title fw-bold">
              {{ $doctor->description}}
            </h7>
          </div>
        </div>
        <hr />

        <!-- Booking Form -->
        <form action="{{route('doctors.store',$doctor->id)}}" method="POST">
          @csrf
          <div class="form-items">

            <!-- Patient Name -->
            <div class="mb-3">
              <label for="">Name</label>
              <input type="text" name="name" class="form-control" />
              @error('name')
                <span class="text-danger">{{$message}}</span>
              @enderror
            </div>

            <!-- Patient Phone -->
            <div class="mb-3">
              <label for="">Phone</label>
              <input type="text" name="phone" class="form-control" />
              @error('phone')
                <span class="text-danger">{{$message}}</span>
              @enderror
            </div>

            <!-- Dropdown اليوم -->
            <div class="mb-3">
              <label for="">Choose Day</label>
              <select name="day" id="day-select" class="form-control" required>
                <option value="">-- Select a Day --</option>
                @foreach($schedules as $schedule)
                  <option value="{{ $schedule['schedule_id'].'_'.$schedule['day'] }}">
                      {{ ucfirst($schedule['day']) }}
                  </option>
                @endforeach
              </select>
              @error('day')
                <span class="text-danger">{{$message}}</span>
              @enderror
            </div>

            <!-- Dropdown الوقت -->
            <div class="mb-3">
              <label for="">Choose Time</label>
              <select name="time" id="time-select" class="form-control" required>
                <option value="">-- Select Time --</option>
              </select>
              @error('time')
                <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
        
          </div>
          <button type="submit" class="btn btn-primary">
            Confirm Booking
          </button>
        </form>
      </div>

      <!-- Patient Reviews -->
      <div class="card mt-4">
        <div class="card-header fw-bold">
            Patient Reviews
        </div>
        <div class="card-body" style="max-height: 300px; overflow-y: auto;">
            @if($doctor->ratings->count() > 0)
                @foreach($doctor->ratings as $rating)
                    <div class="mb-3 border-bottom pb-2">
                        <strong>{{ $rating->user->name ?? 'Anonymous' }}</strong>
                        <div>
                            @for ($i = 1; $i <= 5; $i++)
                                <span style="color: {{ $i <= $rating->rating ? '#ffc107' : '#e4e5e9' }}">★</span>
                            @endfor
                        </div>
                        <p class="mb-0">{{ $rating->comment }}</p>
                    </div>
                @endforeach
            @else
                <p class="text-muted">No reviews yet.</p>
            @endif
        </div>
      </div>

    </div>
  </div>
@endsection

@push('script')
<script>
  const daySelect = document.getElementById('day-select');
  const timeSelect = document.getElementById('time-select');
  const schedules = @json($schedules);

  daySelect.addEventListener('change', () => {
      const selectedValue = daySelect.value;
      timeSelect.innerHTML = '<option value="">-- Select Time --</option>';

      if (selectedValue) {
          const [scheduleId, selectedDay] = selectedValue.split('_');

          const schedule = schedules.find(
              s => s.schedule_id == scheduleId && s.day === selectedDay
          );

          if (schedule) {
              schedule.available_hours.forEach(hour => {
                  timeSelect.innerHTML += `<option value="${schedule.schedule_id}-${hour}">${hour}</option>`;
              });
          }
      }
  });
</script>
@endpush
