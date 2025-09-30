  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{route('dashboard.home')}}" class="brand-link">
      <img src="{{ App\Helpers\FileHelper::profile_image(Auth::user()->image) }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{ Auth::user()->name }}</span>
    </a>
    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{route('dashboard.majors')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Majors
              </p>
            </a>
          </li> 
          <li class="nav-item">
            <a href="{{route('dashboard.doctors')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Doctors
              </p>
            </a>
          </li> 
          <li class="nav-item">
            <a href="{{route('dashboard.admins.create')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Add_Admins
              </p>
            </a>
          </li> 
          <li class="nav-item">
            <a href="{{route('dashboard.doctor.requests.show')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Pending Doctor Requests
              </p>
            </a>
          </li> 
        </ul>
      </nav>
    </div>
  </aside>
