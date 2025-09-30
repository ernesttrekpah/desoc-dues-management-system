@extends('dashboard.layout.app')
@section('content')

<div class="d-flex justify-content-between align-items-center py-4">
  <h2 class="h4">Add New Souvenir</h2>
  <a href="{{ route('souvenirs.index') }}" class="btn btn-sm btn-secondary">← Back</a>
</div>

<div class="card card-body shadow border-0">
  <form action="{{ route('souvenirs.store') }}" method="POST">
    @csrf

    <div class="mb-3">
      <label class="form-label">Souvenir Name</label>
      <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
      @error('name') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
      <label class="form-label">Level</label>
      <select name="level_id" class="form-select" required>
        <option value="">Select Level</option>
        @foreach($levels as $level)
        <option value="{{ $level->id }}" {{ old('level_id')==$level->id ? 'selected' : '' }}>
          Level {{ $level->number }} - {{ $level->name }}
        </option>
        @endforeach
      </select>
      @error('level_id') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
      <label class="form-label">Academic Year</label>
      <select name="academic_year_id" class="form-select" required>
        <option value="">Select Academic Year</option>
        @foreach($academicYears as $year)
        <option value="{{ $year->id }}" {{ old('academic_year_id')==$year->id ? 'selected' : '' }}>
          {{ $year->name }}
        </option>
        @endforeach
      </select>
      @error('academic_year_id') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
      <label class="form-label">Description</label>
      <textarea name="description" class="form-control">{{ old('description') }}</textarea>
      @error('description') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
      <label class="form-label">Status</label>
      <select name="status" class="form-select" required>
        <option value="available" {{ old('status')=='available' ? 'selected' : '' }}>Available</option>
        <option value="unavailable" {{ old('status')=='unavailable' ? 'selected' : '' }}>Unavailable</option>
      </select>
      @error('status') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <button type="submit" class="btn btn-gray-800">Save</button>
  </form>
</div>

@endsection