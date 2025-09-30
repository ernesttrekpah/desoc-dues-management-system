@extends('dashboard.layout.app')
@section('content')

<div class="d-flex justify-content-between align-items-center py-4">
  <h2 class="h4">My Profile</h2>
  <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-primary">Edit Profile</a>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card card-body shadow border-0">
  <div class="d-flex align-items-center mb-3">
    @if($user->avatar)
    <img src="{{ asset('storage/'.$user->avatar) }}" class="rounded-circle me-3" width="80" height="80" alt="avatar">
    @else
    <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center"
      style="width:80px;height:80px;">
      <span class="text-white fw-bold">{{ strtoupper(substr($user->name,0,1)) }}</span>
    </div>
    @endif
    <div>
      <h4>{{ $user->name }}</h4>
      <p class="mb-0">{{ $user->email ?? 'No Email' }}</p>
      <small class="text-muted">Role: {{ ucfirst($user->role) }}</small>
    </div>
  </div>

  <p><strong>Index Number:</strong> {{ $user->index_number }}</p>
  <p><strong>Bio:</strong> {{ $user->bio ?? 'No bio provided.' }}</p>
  <p><strong>Status:</strong> {{ $user->active ? 'Active' : 'Inactive' }}</p>
  <p><strong>Locked:</strong> {{ $user->is_locked ? 'Yes' : 'No' }}</p>

  <hr>
  <h5>Change Password</h5>
  <form action="{{ route('profile.changePassword') }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3">
      <label class="form-label">Current Password</label>
      <input type="password" name="current_password" class="form-control" required>
      @error('current_password') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
    <div class="mb-3">
      <label class="form-label">New Password</label>
      <input type="password" name="new_password" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Confirm Password</label>
      <input type="password" name="new_password_confirmation" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-warning">Update Password</button>
  </form>
</div>
@endsection