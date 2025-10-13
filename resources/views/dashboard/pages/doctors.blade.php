@extends('dashboard.app')
@section('title','Doctors')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">All Doctors</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">All Doctors</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    @if (session()->has('success'))
            <div class="alert alert-success">{{session('success')}}</div> 
    @endif

    <div class="container-fluid">
      <div class="mb-3">
        <a href="{{route('dashboard.doctors.create')}}" class="btn btn-primary">Add New Doctor</a>
      </div>
      {{-- 🔍 مربع البحث --}}
        <div class="mb-4 d-flex justify-content-center">
            <div class="input-group w-50">
                <input type="text" id="search-input" class="form-control rounded-start"
                        placeholder="Find a doctor...">
                <span class="input-group-text bg-primary text-white rounded-end">
                    <i class="fas fa-search"></i>
                </span>
            </div>
        </div>

    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Doctors Table</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>Name</th>
                <th>Image</th>
                <th>Major</th>
                <th>Description</th>
                <th>Average rating</th>
                <th>Booking_price</th>

              </tr>
            </thead>
            <tbody id="doctors-body">
                @foreach ($doctors as $doctor)
              <tr>
                <td>{{$doctor->id}}</td>
                <td>{{$doctor->name}}</td>
                <td><img src="{{App\Helpers\FileHelper::profile_image($doctor->image)}}" 
                         class="profile-user-img img-fluid img-circle" alt="major"></td>
                <td>{{$doctor->major->name}}</td>
                <td>{{$doctor->description}}</td>
                <td>
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
                </td>
                <td>{{$doctor->booking_price}}</td>
                <td>
                  <a class="btn btn-secondary" href="{{route('dashboard.doctors.edit',$doctor->id)}}" >Edit</a>
                  <form action="{{route('dashboard.doctors.destroy',$doctor->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">DELETE</button>
                    </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>
{{-- 🧠 JavaScript --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-input');
    const doctorsBody = document.getElementById('doctors-body');
    const originalHTML = doctorsBody.innerHTML;

    searchInput.addEventListener('keyup', function() {
        const query = this.value.trim();

        // ✅ لو فاضي رجّع الجدول الأصلي
        if (query === '') {
            doctorsBody.innerHTML = originalHTML;
            return;
        }

        fetch(`{{ route('dashboard.search.doctors') }}?query=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                let html = '';

                if (data.doctors.length === 0) {
                    html = `<tr><td colspan="8" class="text-center">No doctors found</td></tr>`;
                } else {
                    data.doctors.forEach(doctor => {
                        html += `
                        <tr>
                            <td>${doctor.id}</td>
                            <td>${doctor.name}</td>
                            <td><img src="${doctor.image}" class="profile-user-img img-fluid img-circle" alt="doctor"></td>
                            <td>${doctor.major_name}</td>
                            <td>${doctor.description ?? ''}</td>
                            <td>${doctor.average_rating ?? 'No ratings yet'}</td>
                            <td>${doctor.booking_price}</td>
                            <td>
                                <a class="btn btn-secondary" href="doctors/${doctor.id}/edit">Edit</a>
                                <form action="doctors/${doctor.id}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">DELETE</button>
                                </form>
                            </td>
                        </tr>`;
                    });
                }

                doctorsBody.innerHTML = html;
            })
            .catch(error => {
                console.error('Error fetching doctors:', error);
            });
    });
});
</script>

@endsection