@extends('auth.layout')

@section('content')

<!-- Fullscreen Auth Section -->
<section class="position-relative d-flex align-items-center justify-content-center text-center text-white" style="min-height: 100vh;
         background: linear-gradient(rgba(3, 125, 182, 0.87), rgba(2, 154, 255, 0.89)), 
                     url('{{ asset('desoc/img/bg.jpg') }}') center/cover no-repeat;">

  <div class="col-12 d-flex align-items-center justify-content-center">
    <div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 fmxw-500">

      {{-- Logo Area --}}
      <p class="text-center">
        <a href="{{ route('index') }}" class="d-flex align-items-center justify-content-center">
          <img class="img-fluid" style="width:100px;" src="{{ asset('desoc/img/logo.png') }}" alt="Logo">
        </a>
      </p>

      <div class="text-center text-md-center mb-4 mt-md-0">
        <h5 class="mb-0 text-primary">Desoc Dues Management System</h5>
        <br>
        <h1 class="mb-0 h3 text-primary">Sign in to continue</h1>
      </div>

      {{-- Error messages --}}
      @if($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif

      <form action="{{ route('login.submit') }}" method="POST" class="mt-4">
        @csrf

        <!-- Index Number -->
        <div class="form-group mb-4">
          <label for="index_number">Index Number</label>
          <div class="input-group">
            <span class="input-group-text">
              <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
              </svg>
            </span>
            <input type="text" name="index_number" id="username"
              class="form-control @error('index_number') is-invalid @enderror" placeholder="Enter your username"
              value="{{ old('index_number') }}" required autofocus>
          </div>
        </div>

        <!-- Password -->
        <div class="form-group mb-4">
          <label for="password">Password</label>
          <div class="input-group">
            <span class="input-group-text">
              <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                  d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                  clip-rule="evenodd"></path>
              </svg>
            </span>
            <input type="password" name="password" id="password"
              class="form-control @error('password') is-invalid @enderror" placeholder="Enter your password" required>
          </div>
        </div>

        <!-- Remember me -->
        <div class="d-flex justify-content-between align-items-top mb-4">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="remember">
            <label class="form-check-label mb-0 text-primary" for="remember">Remember me</label>
          </div>
        </div>

        <!-- Submit -->
        <div class="d-grid">
          <button type="submit" class="btn btn-gray-800" style="background:#1f2937;">
            Sign in
          </button>
        </div>
      </form>

    </div>
  </div>

</section>

@endsection