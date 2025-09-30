@extends('dashboard.layout.app')
@section('content')

<div class="d-flex justify-content-between align-items-center py-4">
  <h2 class="h4">Edit Profile</h2>
  <a href="{{ route('profile.show') }}" class="btn btn-sm btn-secondary">← Back</a>
</div>

<div class="card card-body shadow border-0">
  <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')

    <div class="mb-3">
      <label class="form-label">Name</label>
      <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
      @error('name') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
      @error('email') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
      <label class="form-label">Bio</label>
      <textarea name="bio" class="form-control">{{ old('bio', $user->bio) }}</textarea>
      @error('bio') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
      <label class="form-label">Avatar</label><br>
      @if($user->avatar)
      <img src="{{ asset('storage/'.$user->avatar) }}" class="rounded mb-2" width="60" height="60" alt="avatar">
      @endif
      <input type="file" name="avatar" class="form-control">
      @error('avatar') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <button type="submit" class="btn btn-gray-800">Save Changes</button>
  </form>
</div>
@endsection