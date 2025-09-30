@extends('auth.layout')

@section('content')
<section class="d-flex align-items-center justify-content-center" style="min-height:100vh; width:100%; margin:0; padding:0;
         background: linear-gradient(rgba(3, 125, 182, 0.87), rgba(2, 154, 255, 0.89)),
                     url('{{ asset('desoc/img/bg.jpg') }}') center center / cover no-repeat fixed;">

  <div class="col-12 d-flex align-items-center justify-content-center">
    <div class="bg-white shadow border-0 rounded p-4 p-lg-5 w-100 fmxw-500" style="max-width: 500px;">
      <div class="text-center mb-4">
        <div class="avatar avatar-lg mx-auto mb-3">
          <img class="rounded-circle" alt="User avatar"
            src="{{ Auth::user()->avatar ? asset('storage/'.Auth::user()->avatar) : asset('temp/assets/img/team/profile-picture-3.jpg') }}">
        </div>
        <h1 class="h3">{{ Auth::user()->name ?? 'User' }}</h1>
        <p class="text-gray">Better to be safe than sorry.</p>
      </div>

      @if($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif

      <form action="{{ route('unlock') }}" method="POST" class="mt-4">
        @csrf
        <div class="form-group mb-4">
          <label for="password">Your Password</label>
          <div class="input-group">
            <span class="input-group-text">
              <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                  d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                  clip-rule="evenodd"></path>
              </svg>
            </span>
            <input type="password" name="password" class="form-control" required>
          </div>
        </div>
        <div class="d-grid">
          <button type="submit" class="btn btn-gray-800">Unlock</button>
        </div>
      </form>
    </div>
  </div>
</section>
@endsection