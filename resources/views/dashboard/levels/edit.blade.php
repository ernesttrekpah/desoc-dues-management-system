@extends('dashboard.layout.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
  <h2 class="h4">Edit Level</h2>
</div>

<div class="card card-body border-0 shadow mb-4">
  <form action="{{ route('dashboard.levels.update', $level->id) }}" method="POST">
    @csrf
    @method('PUT')

    <!-- Level Number -->
    <div class="mb-3">
      <label for="number" class="form-label">Level Number</label>
      <input type="number" name="number" id="number" class="form-control @error('number') is-invalid @enderror"
        value="{{ old('number', $level->number) }}" placeholder="e.g. 100" required>
      @error('number')
      <span class="invalid-feedback">{{ $message }}</span>
      @enderror
    </div>

    <!-- Description -->
    <div class="mb-3">
      <label for="description" class="form-label">Description (optional)</label>
      <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
        rows="3">{{ old('description', $level->description) }}</textarea>
      @error('description')
      <span class="invalid-feedback">{{ $message }}</span>
      @enderror
    </div>

    <!-- Submit -->
    <div class="mt-3">
      <button type="submit" class="btn btn-gray-800">Update Level</button>
      <a href="{{ route('dashboard.levels') }}" class="btn btn-outline-secondary ms-2">Cancel</a>
    </div>
  </form>
</div>
@endsection