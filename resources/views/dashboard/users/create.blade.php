@extends('dashboard.layout.app')
@section('content')

<div class="d-flex justify-content-between align-items-center py-4">
  <h2 class="h4">Add New User</h2>
  <a href="{{ route('users.index') }}" class="btn btn-sm btn-secondary">← Back</a>
</div>

<div class="card card-body shadow border-0">
  <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
      <label class="form-label">Name</label>
      <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
      @error('name') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
      <label class="form-label">Index Number</label>
      <input type="text" name="index_number" class="form-control" value="{{ old('index_number') }}" required>
      @error('index_number') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control" value="{{ old('email') }}">
      @error('email') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="row">
      <div class="col-md-6 mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required>
        @error('password') <small class="text-danger">{{ $message }}</small> @enderror
      </div>
      <div class="col-md-6 mb-3">
        <label class="form-label">Confirm Password</label>
        <input type="password" name="password_confirmation" class="form-control" required>
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label">Role</label>
      <select name="role" class="form-select" required>
        <option value="student" {{ old('role')=='student' ? 'selected' : '' }}>Student</option>
        <option value="admin" {{ old('role')=='admin' ? 'selected' : '' }}>Admin</option>
        <option value="superadmin" {{ old('role')=='superadmin' ? 'selected' : '' }}>Super Admin</option>
      </select>
      @error('role') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="row">
      <div class="col-md-6 mb-3">
        <label class="form-label">Status</label>
        <select name="active" class="form-select" required>
          <option value="1" {{ old('active')=='1' ? 'selected' : '' }}>Active</option>
          <option value="0" {{ old('active')=='0' ? 'selected' : '' }}>Inactive</option>
        </select>
      </div>
      <div class="col-md-6 mb-3">
        <label class="form-label">Locked?</label>
        <select name="is_locked" class="form-select" required>
          <option value="0" {{ old('is_locked')=='0' ? 'selected' : '' }}>No</option>
          <option value="1" {{ old('is_locked')=='1' ? 'selected' : '' }}>Yes</option>
        </select>
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label">Bio</label>
      <textarea name="bio" class="form-control">{{ old('bio') }}</textarea>
      @error('bio') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
      <label class="form-label">Avatar</label>
      <input type="file" name="avatar" class="form-control">
      @error('avatar') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <button type="submit" class="btn btn-gray-800">Save User</button>
  </form>
</div>
@endsection