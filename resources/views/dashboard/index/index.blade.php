@extends('dashboard.layout.app')

@section('content')

<!-- Hero Section -->
<section class="position-relative text-center text-white" style="min-height: 100vh; 
         display: flex; 
         align-items: center; 
         justify-content: center;
         background: linear-gradient(rgba(3, 125, 182, 0.87), rgba(2, 154, 255, 0.89)), 
                     url('{{ asset('desoc/img/bg.jpg') }}') center/cover no-repeat;">

  <div class="container">
    <div class="d-flex flex-column justify-content-center align-items-center">

      <!-- Logo -->
      <div class="mb-4">
        <img src="{{ asset('desoc/img/logo.png') }}" alt="Logo" class="img-fluid" style="width: 120px; height:auto;">
      </div>

      <!-- Title -->
      <h1 class="display-4 fw-bold">DESIGN SOCIETY</h1>
      <p class="lead mb-3">We create to inspire.</p>

      <!-- Description -->
      <p class="fs-5 text-white-50 mb-5" style="max-width: 700px;">
        <strong>DESOC DUES MANAGEMENT SYSTEM (DDMS)</strong>:
        A smart, secure way to manage and monitor your Design Society dues and souvenirs.
        DDMS is built to keep you informed and in control.
      </p>

      <!-- Actions -->
      <div class="d-flex gap-3">
        <a href="{{ route('students.create') }}" class="btn btn-lg btn-warning shadow">
          <i class="bi bi-person-plus-fill me-2"></i> Add Student
        </a>
        <a href="{{ route('dues_payments.create') }}" class="btn btn-lg btn-danger text-white shadow">
          <i class="bi bi-cash-stack me-2"></i> Record Payment
        </a>
      </div>

    </div>
  </div>

</section>

@endsection