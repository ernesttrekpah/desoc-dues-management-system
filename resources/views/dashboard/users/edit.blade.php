@extends('dashboard.layout.app')
@section('content')

<div class="d-flex justify-content-between align-items-center py-4">
  <h2 class="h4">Edit User</h2>
  <a href="{{ route('users.index') }}" class="btn btn-sm btn-secondary">← Back</a>
</div>

<div class="card card-body shadow border-0">
  <form action="{{ route('users.update', $user) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')

    <div class="mb-3">
      <label class="form-label">Name</label>
      <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Index Number</label>
      <input type="text" name="index_number" class="form-control" value="{{ old('index_number', $user->index_number) }}"
        required>
    </div>

    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
    </div>

    <div class="row">
      <div class="col-md-6 mb-3">
        <label class="form-label">Password (leave blank if unchanged)</label>
        <input type="password" name="password" class="form-control">
      </div>
      <div class="col-md-6 mb-3">
        <label class="form-label">Confirm Password</label>
        <input type="password" name="password_confirmation" class="form-control">
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label">Role</label>
      <select name="role" class="form-select" required>
        <option value="student" {{ $user->role=='student' ? 'selected' : '' }}>Student</option>
        <option value="admin" {{ $user->role=='admin' ? 'selected' : '' }}>Admin</option>
        <option value="superadmin" {{ $user->role=='superadmin' ? 'selected' : '' }}>Super Admin</option>
      </select>
    </div>

    <div class="row">
      <div class="col-md-6 mb-3">
        <label class="form-label">Status</label>
        <select name="active" class="form-select" required>
          <option value="1" {{ $user->active ? 'selected' : '' }}>Active</option>
          <option value="0" {{ !$user->active ? 'selected' : '' }}>Inactive</option>
        </select>
      </div>
      <div class="col-md-6 mb-3">
        <label class="form-label">Locked?</label>
        <select name="is_locked" class="form-select" required>
          <option value="0" {{ !$user->is_locked ? 'selected' : '' }}>No</option>
          <option value="1" {{ $user->is_locked ? 'selected' : '' }}>Yes</option>
        </select>
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label">Bio</label>
      <textarea name="bio" class="form-control">{{ old('bio', $user->bio) }}</textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Avatar</label><br>
      @if($user->avatar)
      <img src="{{ asset('storage/'.$user->avatar) }}" class="rounded mb-2" width="60" height="60" alt="avatar">
      @endif
      <input type="file" name="avatar" class="form-control">
    </div>

    <button type="submit" class="btn btn-gray-800">Update User</button>
  </form>
</div>
@endsection