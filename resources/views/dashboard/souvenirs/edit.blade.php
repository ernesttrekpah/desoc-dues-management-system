@extends('dashboard.layout.app')
@section('content')

<div class="d-flex justify-content-between align-items-center py-4">
  <h2 class="h4">Edit Souvenir</h2>
  <a href="{{ route('souvenirs.index') }}" class="btn btn-sm btn-secondary">← Back</a>
</div>

<div class="card card-body shadow border-0">
  <form action="{{ route('souvenirs.update', $souvenir) }}" method="POST">
    @csrf @method('PUT')

    <div class="mb-3">
      <label class="form-label">Souvenir Name</label>
      <input type="text" name="name" class="form-control" value="{{ $souvenir->name }}" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Level</label>
      <select name="level_id" class="form-select" required>
        @foreach($levels as $level)
        <option value="{{ $level->id }}" {{ $souvenir->level_id == $level->id ? 'selected' : '' }}>
          Level {{ $level->number }} - {{ $level->name }}
        </option>
        @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Academic Year</label>
      <select name="academic_year_id" class="form-select" required>
        @foreach($academicYears as $year)
        <option value="{{ $year->id }}" {{ $souvenir->academic_year_id == $year->id ? 'selected' : '' }}>
          {{ $year->name }}
        </option>
        @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Description</label>
      <textarea name="description" class="form-control">{{ $souvenir->description }}</textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Status</label>
      <select name="status" class="form-select" required>
        <option value="available" {{ $souvenir->status == 'available' ? 'selected' : '' }}>Available</option>
        <option value="unavailable" {{ $souvenir->status == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
      </select>
    </div>

    <button type="submit" class="btn btn-gray-800">Update</button>
  </form>
</div>

@endsection