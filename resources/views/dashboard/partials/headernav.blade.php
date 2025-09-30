<nav class="navbar navbar-top navbar-expand navbar-dashboard navbar-dark ps-0 pe-2 pb-0">
  <div class="container-fluid px-0">
    <div class="d-flex justify-content-between w-100" id="navbarSupportedContent">
      <div class="d-flex align-items-center">
        <!-- Search form -->
        <form class="navbar-search form-inline" id="navbar-search-main">
          <div class="input-group input-group-merge search-bar">
            <span class="input-group-text" id="topbar-addon">
              <svg class="icon icon-xs" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                  d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                  clip-rule="evenodd"></path>
              </svg>
            </span>
            <input type="text" class="form-control" id="topbarInputIconLeft" placeholder="Search" aria-label="Search"
              aria-describedby="topbar-addon">
          </div>
        </form>
      </div>

      <!-- Navbar links -->
      <ul class="navbar-nav align-items-center">

        <!-- User Menu -->
        <li class="nav-item dropdown ms-lg-3">
          <a class="nav-link dropdown-toggle pt-1 px-0" href="#" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            <div class="media d-flex align-items-center">
              <img class="avatar rounded-circle" alt="User avatar"
                src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('temp/assets/img/team/profile-picture-3.jpg') }}">
              <div class="media-body ms-2 text-dark align-items-center d-none d-lg-block">
                <span class="mb-0 font-small fw-bold text-gray-900">{{ Auth::user()->name ?? 'User' }}</span>
              </div>
            </div>
          </a>
          <div class="dropdown-menu dashboard-dropdown dropdown-menu-end mt-2 py-1">

            <!-- My Profile -->
            <a class="dropdown-item d-flex align-items-center" href="{{ route('profile.show') }}">
              <svg class="dropdown-icon text-gray-400 me-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                  d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                  clip-rule="evenodd"></path>
              </svg>
              My Profile
            </a>

            <!-- Settings (optional, link later if needed) -->
            {{-- <a class="dropdown-item d-flex align-items-center" href="#">
              <svg class="dropdown-icon text-gray-400 me-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                  d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                  clip-rule="evenodd"></path>
              </svg> Settings
            </a> --}}

            <div role="separator" class="dropdown-divider my-1"></div>

            <!-- Lock Screen -->
            <form action="{{ route('lock.action') }}" method="POST">
              @csrf
              <button type="submit" class="dropdown-item d-flex align-items-center">
                <svg class="dropdown-icon text-warning me-2" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                  viewBox="0 0 20 20">
                  <path fill-rule="evenodd"
                    d="M10 2a4 4 0 00-4 4v2H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-1V6a4 4 0 00-4-4zm-2 6V6a2 2 0 114 0v2H8z"
                    clip-rule="evenodd" />
                </svg>
                Lock Screen
              </button>
            </form>

            <!-- Logout -->
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button type="submit" class="dropdown-item d-flex align-items-center">
                <svg class="dropdown-icon text-danger me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                  </path>
                </svg> Logout
              </button>
            </form>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>