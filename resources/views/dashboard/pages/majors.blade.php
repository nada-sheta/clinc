@extends('dashboard.app')
@section('title','Majors')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">All Majors</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">All Majors</li>
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
        <a href="{{route('dashboard.majors.create')}}" class="btn btn-primary">Add New Major</a>
      </div>

      {{-- 🔍 مربع البحث --}}
        <div class="mb-4 d-flex justify-content-center">
            <div class="input-group w-50">
                <input type="text" id="search-input" class="form-control rounded-start"
                        placeholder="Find a major...">
                <span class="input-group-text bg-primary text-white rounded-end">
                    <i class="fas fa-search"></i>
                </span>
            </div>
        </div>

    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Majors Table</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>name</th>
                <th>image</th>
              </tr>
            </thead>
            <tbody id="majors-body">
                @foreach ($majors as $major)
              <tr>
                <td>{{$major->id}}</td>
                <td>{{$major->name}}</td>
                <td><img src="{{App\Helpers\FileHelper::major_image($major->image)}}" 
                         class="profile-user-img img-fluid img-circle" alt="major"></td>
                <td>
                    <a class="btn btn-secondary" href="{{route('dashboard.majors.edit',$major->id)}}" >Edit</a>
                  <form action="{{route('dashboard.majors.destroy',$major->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">DELETE</button>
                  </form>
                    <a class="btn btn-warning" href="{{route('dashboard.majors.show',$major->id)}}">Show Doctors</a>
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
    const majorsBody = document.getElementById('majors-body');
    const originalHTML = majorsBody.innerHTML;

    searchInput.addEventListener('keyup', function() {
        const query = this.value.trim();

        // ✅ لو فاضي رجّع الجدول الأصلي
        if (query === '') {
            majorsBody.innerHTML = originalHTML;
            return;
        }

        fetch(`{{ route('dashboard.search.majors') }}?query=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                let html = '';

                if (data.majors.length === 0) {
                    html = `<tr><td colspan="8" class="text-center">No majors found</td></tr>`;
                } else {
                    data.majors.forEach(major => {
                        html += `
                        <tr>
                            <td>${major.id}</td>
                            <td>${major.name}</td>
                            <td><img src="${major.image}" class="profile-user-img img-fluid img-circle" alt="doctor"></td>
                            <td>
                                <a class="btn btn-secondary" href="majors/${major.id}/edit">Edit</a>
                                <form action="majors/${major.id}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">DELETE</button>
                                </form>
                                <a class="btn btn-warning" href="majors/${major.id}">Show Doctors</a>
                            </td>
                        </tr>`;
                    });
                }

                majorsBody.innerHTML = html;
            })
            .catch(error => {
                console.error('Error fetching majors:', error);
            });
    });
});
</script>
@endsection