<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Signin | {{config('app.name')}}</title>
  <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
  <meta name="title" content="{{ config('app.name') }}">

  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('desoc/img/logo.png') }}">
  <link rel="manifest" href="{{ asset('temp/assets/img/favicon/site.webmanifest') }}">
  <link rel="mask-icon" href="{{ asset('temp/assets/img/favicon/safari-pinned-tab.svg') }}" color="#ffffff">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="theme-color" content="#ffffff">

  <!-- Sweet Alert -->
  <link type="text/css" href="{{ asset('temp/vendor/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
  <!-- Notyf -->
  <link type="text/css" href="https://themewagon.github.io/volt-Bootstrap/vendor/notyf/notyf.min.css" rel="stylesheet">
  <!-- Volt CSS -->
  <link type="text/css" href="{{ asset('temp/css/volt.css') }}" rel="stylesheet">
</head>

<body style="margin:0; padding:0; height:100%;">

  <main style="height:100%;">
    <section class="d-flex align-items-center justify-content-center" style="min-height:100vh; width:100%; margin:0; padding:0;
             background: linear-gradient(rgba(3, 125, 182, 0.87), rgba(2, 154, 255, 0.89)),
                         url('{{ asset('desoc/img/bg.jpg') }}') center center / cover no-repeat fixed;">
      <div class="container">
        @yield('content')
      </div>
    </section>
  </main>

  <script src="{{ asset('temp/vendor/@popperjs/core/dist/umd/popper.min.js') }}"></script>
  <script src="{{ asset('temp/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('temp/vendor/onscreen/dist/on-screen.umd.min.js') }}"></script>
  <script src="https://themewagon.github.io/volt-Bootstrap/vendor/nouislider/distribute/nouislider.min.js"></script>
  <script src="{{ asset('temp/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js') }}"></script>
  <script src="{{ asset('temp/vendor/chartist/dist/chartist.min.js') }}"></script>
  <script src="{{ asset('temp/vendor/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js') }}"></script>
  <script src="{{ asset('temp/vendor/vanillajs-datepicker/dist/js/datepicker.min.js') }}"></script>
  <script src="{{ asset('temp/vendor/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>
  <script src="{{ asset('temp/vendor/vanillajs-datepicker/dist/js/datepicker.min.js') }}"></script>
  <script src="{{ asset('temp/vendor/notyf/notyf.min.js') }}"></script>
  <script src="{{ asset('temp/vendor/simplebar/dist/simplebar.min.js') }}"></script>
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <script src="{{ asset('temp/assets/js/volt.js') }}"></script>
</body>

</html>