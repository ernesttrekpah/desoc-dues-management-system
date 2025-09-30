<nav class="navbar navbar-dark navbar-theme-primary px-4 col-12 d-lg-none">
  <a class="navbar-brand me-lg-5" href="{{ route('dashboard') }}">
    <img class="navbar-brand-dark" src="{{ asset('desoc/img/logo.png') }}" alt="Desoc logo">
    <img class="navbar-brand-light" src="{{ asset('desoc/img/logo.png') }}" alt="Desoc logo">
  </a>
  <div class="d-flex align-items-center">
    <button class="navbar-toggler d-lg-none collapsed" type="button" data-bs-toggle="collapse"
      data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
      aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
  </div>
</nav>

<nav id="sidebarMenu" class="sidebar d-lg-block text-white collapse" data-simplebar style="background: #00476d">
  <div class="sidebar-inner px-4 pt-3">
    <!-- User Card for mobile -->
    <div class="user-card d-flex d-md-none align-items-center justify-content-between justify-content-md-center pb-4">
      <div class="d-flex align-items-center">
        <div class="avatar-lg me-4">
          <img src="{{ 'storage/'.Auth::user()->avatar ?? asset('temp/assets/img/team/profile-picture-3.jpg') }}"
            class="card-img-top rounded-circle border-white" alt="Bonnie Green">
        </div>
        <div class="d-block">
          <h2 class="h5 mb-3">Hi, {{Auth::user()->name }}</h2>
          <a href="../examples/sign-in.html" class="btn btn-secondary btn-sm d-inline-flex align-items-center">
            <svg class="icon icon-xxs me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
              </path>
            </svg> Sign Out
          </a>
        </div>
      </div>
      <div class="collapse-close d-md-none">
        <a href="{{route('dashboard')}}#sidebarMenu" data-bs-toggle="collapse" data-bs-target="#sidebarMenu"
          aria-controls="sidebarMenu" aria-expanded="true" aria-label="Toggle navigation">
          <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd"
              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
              clip-rule="evenodd"></path>
          </svg>
        </a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <ul class="nav flex-column pt-3 pt-md-0">
      <li class="nav-item">
        <a href="{{ route('dashboard') }}" class="nav-link d-flex align-items-center">
          <span class="sidebar-icon">
            <img src="{{ asset('desoc/img/logo.png') }}" height="20" width="20" alt="Desoc Logo">
          </span>
          <span class="mt-1 ms-1 sidebar-text">Desoc Dues</span>
        </a>
      </li>

      <!-- Dashboard -->
      <li class="nav-item active">
        <a href="{{route('dashboard')}}" class="nav-link">
          <span class="sidebar-icon">
            <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20">
              <path d="M10 2L2 7v11h6v-6h4v6h6V7l-8-5z" />
            </svg>
          </span>
          <span class="sidebar-text">Dashboard</span>
        </a>
      </li>

      <!-- Students -->
      <li class="nav-item">
        <a href="{{route('students.index')}}" class="nav-link d-flex justify-content-between">
          <span>
            <span class="sidebar-icon">
              <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20">
                <path d="M13 7a3 3 0 11-6 0 3 3 0 016 0zM2 17a6 6 0 1112 0H2z" />
              </svg>
            </span>
            <span class="sidebar-text">Students</span>
          </span>
        </a>
      </li>

      <!-- Levels -->
      <li class="nav-item">
        <a href="{{ route('dashboard.levels') }}" class="nav-link">
          <span class="sidebar-icon">
            <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 24 24">
              <path d="M12 2L2 7l10 5 10-5-10-5zm0 7.82L2 7v2l10 5 10-5V7l-10 2.82zM2 15v2l10 5 10-5v-2l-10 5-10-5z" />
            </svg>
          </span>
          <span class="sidebar-text">Levels</span>
        </a>
      </li>

      <!-- Dues Payment -->
      <li class="nav-item">
        <a href="{{ route('dues_payments.index') }}" class="nav-link">
          <span class="sidebar-icon">
            <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 24 24">
              <path d="M2 7a2 2 0 012-2h16a2 2 0 012 2v3H2V7zm0 5h20v5a2 2 0 01-2 2H4a2 2 0 01-2-2v-5z" />
            </svg>
          </span>
          <span class="sidebar-text">Dues Payment</span>
        </a>
      </li>

      <!-- Academic Year -->
      <li class="nav-item">
        <a href="{{route('dashboard.academic_year')}}" class="nav-link d-flex justify-content-between">
          <span>
            <span class="sidebar-icon">
              <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 24 24">
                <path
                  d="M7 2v2H5a2 2 0 00-2 2v2h18V6a2 2 0 00-2-2h-2V2h-2v2H9V2H7zm13 8H4v10a2 2 0 002 2h12a2 2 0 002-2V10z" />
              </svg>
            </span>
            <span class="sidebar-text">Academic Year</span>
          </span>
        </a>
      </li>

      <!-- Souvenirs -->
      <li class="nav-item">
        <a href="{{route('souvenirs.index')}}" class="nav-link d-flex justify-content-between">
          <span>
            <span class="sidebar-icon">
              <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 24 24">
                <path
                  d="M20 12v8a2 2 0 01-2 2h-4v-8h6zM10 22H6a2 2 0 01-2-2v-8h6v10zM22 8h-6.31A3.993 3.993 0 0012 2a3.993 3.993 0 00-3.69 6H2v2h20V8zm-10-4a2 2 0 110 4 2 2 0 010-4z" />
              </svg>
            </span>
            <span class="sidebar-text">Souvenirs</span>
          </span>
        </a>
      </li>

      <!-- Reports -->
      <li class="nav-item">
        <span class="nav-link collapsed d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
          data-bs-target="#submenu-app">
          <span>
            <span class="sidebar-icon">
              <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 24 24">
                <path d="M3 3h18v18H3V3zm4 14h2v-6H7v6zm4 0h2V7h-2v10zm4 0h2v-4h-2v4z" />
              </svg>
            </span>
            <span class="sidebar-text">Reports</span>
          </span>
          <span class="link-arrow">
            <svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd"
                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                clip-rule="evenodd"></path>
            </svg>
          </span>
        </span>
        <div class="multi-level collapse" role="list" id="submenu-app" aria-expanded="false">
          <ul class="flex-column nav">

            <li class="nav-item">
              <a class="nav-link" href="{{ route('dashboard.report.dues') }}">
                <span class="sidebar-text">Dues</span>
              </a>
            </li>
          </ul>
        </div>
      </li>

      <!-- Admin -->
      <li class="nav-item">
        <span class="nav-link collapsed d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
          data-bs-target="#submenu-pages">
          <span>
            <span class="sidebar-icon">
              <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2l8 4v6c0 5.25-3.25 10-8 12-4.75-2-8-6.75-8-12V6l8-4z" />
              </svg>
            </span>
            <span class="sidebar-text">Admin</span>
          </span>
          <span class="link-arrow">
            <svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd"
                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                clip-rule="evenodd"></path>
            </svg>
          </span>
        </span>
        <div class="multi-level collapse" role="list" id="submenu-pages" aria-expanded="false">
          <ul class="flex-column nav">

            <li class="nav-item">
              <a class="nav-link" href="{{ route('users.index') }}">
                <span class="sidebar-text">User Accounts</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('dashboard.levels') }}">
                <span class="sidebar-text">Manage Levels</span>
              </a>
            </li>


            <li class="nav-item">
              <a class="nav-link" href="{{ route('dues.index') }}">
                <span class="sidebar-text">Setup Dues</span>
              </a>
            </li>


          </ul>
        </div>
      </li>

      <!-- Help -->
      <li role="separator" class="dropdown-divider mt-4 mb-3 border-gray-700"></li>
      <li class="nav-item">
        <a href="{{route('dashboard.help')}}" class="nav-link d-flex align-items-center">
          <span class="sidebar-icon">
            <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 24 24">
              <path
                d="M12 2a10 10 0 100 20 10 10 0 000-20zm.01 15a1.25 1.25 0 110-2.5 1.25 1.25 0 010 2.5zm1.62-6.21l-.9.92c-.37.38-.73.87-.73 1.79h-1.5c0-1.25.58-2.07 1.16-2.65l1.02-1.04a1.5 1.5 0 10-2.56-1.06H8.63a3 3 0 115.01 2.04z" />
            </svg>
          </span>
          <span class="sidebar-text">Help</span>
        </a>
      </li>
    </ul>
  </div>
</nav>