  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
 <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <form action="{{ route('dashboard.logout') }}" method="POST" class="d-inline">
          @csrf
          <button type="submit" class="btn btn-navbar btn-lg">
            <i class="fas fa-sign-out-alt"></i> Log Out
          </button>
        </form>
      </li>
    </ul>
  </nav>