@include('dashboard.partials.header')

@include('dashboard.partials.sidebar')
<main class="content">
  @include('dashboard.partials.headernav')

  @yield('content')



  <footer class="bg-white rounded shadow p-5 mb-4 mt-4">
    <div class="row">
      <div class="col-12 col-md-4 col-xl-6 mb-4 mb-md-0">
        <p class="mb-0 text-center text-lg-start">© 2025-<span class="current-year"></span> <a
            class="text-primary fw-normal" href="#" target="_blank">Desoc Dues System</a>
          Developed by
          <a href="#" target="_blank"> 220027987</a>
        </p>
      </div>

    </div>
  </footer>
</main>


@include('dashboard.partials.footer')