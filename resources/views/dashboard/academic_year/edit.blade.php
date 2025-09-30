@extends('dashboard.layout.app')

@section('content')
<div class="d-flex justify-content-between align-items-center py-4">
  <h2 class="h4">Edit Academic Year</h2>
  <a href="{{ route('dashboard.academic_year') }}" class="btn btn-sm btn-secondary">← Back</a>
</div>

<div class="card card-body border-0 shadow">
  <form action="{{ route('academic_year.update', $academicYear) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label for="name" class="form-label">Academic Year (e.g. 2024/2025)</label>
      <input type="text" name="name" id="name" value="{{ old('name', $academicYear->name) }}"
        class="form-control @error('name') is-invalid @enderror" required>
      @error('name')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="description" class="form-label">Description (optional)</label>
      <textarea name="description" id="description" rows="3"
        class="form-control @error('description') is-invalid @enderror">{{ old('description', $academicYear->description) }}</textarea>
      @error('description')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <button type="submit" class="btn btn-gray-800">Update</button>
  </form>
</div>
@endsection