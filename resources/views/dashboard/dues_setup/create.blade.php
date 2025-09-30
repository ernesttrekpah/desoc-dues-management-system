@extends('dashboard.layout.app')
@section('content')

<div class="d-flex justify-content-between align-items-center py-4">
  <h2 class="h4">Add New Due</h2>
  <a href="{{ route('dues.index') }}" class="btn btn-sm btn-secondary">← Back</a>
</div>

<div class="card card-body shadow border-0">
  <form action="{{ route('dues.store') }}" method="POST">
    @csrf

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
      <label class="form-label">Amount (₵)</label>
      <input type="number" name="amount" step="0.01" class="form-control" value="{{ old('amount') }}" required>
      @error('amount') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
      <label class="form-label">Status</label>
      <select name="status" class="form-select" required>
        <option value="active" {{ old('status')=='active' ? 'selected' : '' }}>Active</option>
        <option value="inactive" {{ old('status')=='inactive' ? 'selected' : '' }}>Inactive</option>
      </select>
      @error('status') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <button type="submit" class="btn btn-gray-800">Save</button>
  </form>
</div>

@endsection