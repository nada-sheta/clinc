@extends('site.app')
@section('title','Manage Schedule')
@section('content')

<div class="container my-5">
    <h2 class="mb-4">Manage Your Appointments</h2>
<!-- Form to add a new slot -->
<form action="{{ route('store.schedule', $doctorId) }}" method="POST" class="mb-5">
    @csrf
    @if (session()->has('success'))
                 <div class="alert alert-success">{{session('success')}}</div> 
            @endif
    <div class="row g-3">

        <!-- اليوم من -->
        <div class="col-md-3">
            <label class="form-label">Day From</label>
            <select name="day_from" class="form-select" required>
                <option value="saturday">Saturday</option>
                <option value="sunday">Sunday</option>
                <option value="monday">Monday</option>
                <option value="tuesday">Tuesday</option>
                <option value="wednesday">Wednesday</option>
                <option value="thursday">Thursday</option>
                <option value="friday">Friday</option>
            </select>
             @error('day_from')
                <span class="text-danger">{{$message}}</span>
              @enderror
        </div>

        <!-- اليوم إلى -->
        <div class="col-md-3">
            <label class="form-label">Day To</label>
            <select name="day_to" class="form-select" required>
                <option value="saturday">Saturday</option>
                <option value="sunday">Sunday</option>
                <option value="monday">Monday</option>
                <option value="tuesday">Tuesday</option>
                <option value="wednesday">Wednesday</option>
                <option value="thursday">Thursday</option>
                <option value="friday">Friday</option>
            </select>
             @error('day_to')
                <span class="text-danger">{{$message}}</span>
              @enderror
        </div>

        <!-- الوقت -->
        <div class="col-md-3">
            <label class="form-label">Time From</label>
            <input type="time" name="time_from" class="form-control" required>
             @error('time_from')
                <span class="text-danger">{{$message}}</span>
              @enderror
        </div>
        <div class="col-md-3">
            <label class="form-label">Time To</label>
            <input type="time" name="time_to" class="form-control" required>
             @error('time_to')
                <span class="text-danger">{{$message}}</span>
              @enderror
        </div>

       <!-- تاريخ بداية تطبيق الجدول -->
        <div class="col-md-3">
            <label class="form-label">Start Date</label>
            <input type="date" name="start_date" class="form-control" required>
             @error('start_date')
                <span class="text-danger">{{$message}}</span>
              @enderror
        </div>


        <!-- زرار الاضافة -->
        <div class="col-md-2 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">Add</button>
        </div>
    </div>
</form>



    <!-- Existing slots -->
    <h4>My Available Slots</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Day From</th>
                <th>Day To</th>
                <th>Time From</th>
                <th>Time To</th>
                <th>Start Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($schedules as $slot)
                <tr>
                    <td>{{ $slot->day_from }}</td>
                    <td>{{ $slot->day_to }}</td>
                    <td>{{ $slot->time_from }}</td>
                    <td>{{ $slot->time_to }}</td>
                    <td>{{ $slot->start_date}}</td>
                    <td>
                        <form action="{{ route('doctor.schedule.destroy',$slot->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection
