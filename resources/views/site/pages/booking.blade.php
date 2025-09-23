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
            <a class="text-decoration-none" href="{{route('site.doctors')}}">doctors</a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">
            {{ $doctor->name}}
          </li>
        </ol>
      </nav>
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
        <form action="{{route('doctors.store',$doctor->id)}}" method="POST">
          @csrf
          <div class="form-items">
            <div class="mb-3">
              <label for="" >Name</label>
              <input type="text" name="name" class="form-control" />
              @error('name')
                <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
            <div class="mb-3">
              <label for="" >Phone</label>
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
                        <?php
                            echo "<!-- Schedule ID: {$schedule->id}, Day From: {$schedule->day_from}, Day To: {$schedule->day_to} -->";
                            $daysOfWeek = [
                                'saturday' => 'Saturday',
                                'sunday' => 'Sunday',
                                'monday' => 'Monday',
                                'tuesday' => 'Tuesday',
                                'wednesday' => 'Wednesday',
                                'thursday' => 'Thursday',
                                'friday' => 'Friday'
                            ];
                            
                            // Find the index of day_from and day_to
                            $dayKeys = array_keys($daysOfWeek);
                            $startIndex = array_search(strtolower($schedule->day_from), $dayKeys);
                            $endIndex = array_search(strtolower($schedule->day_to), $dayKeys);
                            
                            // Check if days are valid
                            if ($startIndex === false || $endIndex === false) {
                                echo "<!-- Error: Invalid day for schedule {$schedule->id}: day_from={$schedule->day_from}, day_to={$schedule->day_to} -->";
                                continue;
                            }
                            
                            // Generate list of days between day_from and day_to
                            $selectedDays = [];
                            for ($i = $startIndex; $i <= $endIndex; $i++) {
                                $selectedDays[] = [
                                    'en' => $dayKeys[$i], // Day in English (lowercase for value)
                                    'display' => $daysOfWeek[$dayKeys[$i]] // Day in English (capitalized for display)
                                ];
                            }
                        ?>
                        @foreach($selectedDays as $day)
                            <option value="{{ $schedule->id . '_' . $day['en'] }}">
                                {{ $day['display'] }}
                            </option>
                        @endforeach
                    @endforeach
                </select>
                @error('day')
                    <span class="text-danger">{{ $message }}</span>
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
              <script>
                const daySelect = document.getElementById('day-select');
                const timeSelect = document.getElementById('time-select');
                const schedules = @json($schedules);

                daySelect.addEventListener('change', () => {
                    const dayValue = daySelect.value;
                    timeSelect.innerHTML = '<option value="">-- Select Time --</option>';

                    if (dayValue) {
                        const [scheduleId] = dayValue.split('_'); // نفصل schedule_id
                        const schedule = schedules.find(s => s.id == scheduleId);
                        if (schedule) {
                            let start = parseInt(schedule.time_from.split(':')[0]);
                            let end = parseInt(schedule.time_to.split(':')[0]);

                            for (let t = start; t <= end; t++) {
                                timeSelect.innerHTML += `<option value="${schedule.id}-${t}">${t}:00</option>`;
                            }
                        }
                    }
                });
            </script>
        
          </div>
          <button type="submit" class="btn btn-primary">
            Confirm Booking
          </button>
        </form>
      </div>

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
    const stars = document.querySelectorAll(".star");

    stars.forEach((star, index) => {
      star.addEventListener("click", () => {
        const isActive = star.classList.contains("active");
        if (isActive) {
          star.classList.remove("active");
        } else {
          star.classList.add("active");
        }
        for (let i = 0; i < index; i++) {
          stars[i].classList.add("active");
        }
        for (let i = index + 1; i < stars.length; i++) {
          stars[i].classList.remove("active");
        }
      });
    });
  </script>
  @endpush