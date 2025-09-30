@extends('dashboard.layout.app')

@section('content')
<div class="d-flex justify-content-between align-items-center py-4">
  <h2 class="h4">Create Academic Year</h2>
  <a href="{{ route('dashboard.academic_year') }}" class="btn btn-sm btn-secondary">← Back</a>
</div>

<div class="card card-body border-0 shadow">
  <form action="{{ route('academic_year.store') }}" method="POST">
    @csrf
    <div class="mb-3">
      <label for="name" class="form-label">Academic Year (e.g. 2024/2025)</label>
      <input type="text" name="name" id="name" value="{{ old('name') }}"
        class="form-control @error('name') is-invalid @enderror" placeholder="2024/2025" required>
      @error('name')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="description" class="form-label">Description (optional)</label>
      <textarea name="description" id="description" rows="3"
        class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
      @error('description')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <button type="submit" class="btn btn-gray-800">Save</button>
  </form>
</div>
@endsection