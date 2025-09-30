@extends('dashboard.layout.app')
@section('content')

<div class="d-flex justify-content-between align-items-center py-4">
  <h2 class="h4">Edit Due</h2>
  <a href="{{ route('dues.index') }}" class="btn btn-sm btn-secondary">← Back</a>
</div>

<div class="card card-body shadow border-0">
  <form action="{{ route('dues.update', $due) }}" method="POST">
    @csrf @method('PUT')

    <div class="mb-3">
      <label class="form-label">Academic Year</label>
      <select name="academic_year_id" class="form-select" required>
        @foreach($academicYears as $year)
        <option value="{{ $year->id }}" {{ $due->academic_year_id == $year->id ? 'selected' : '' }}>
          {{ $year->name }}
        </option>
        @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Level</label>
      <select name="level_id" class="form-select" required>
        @foreach($levels as $level)
        <option value="{{ $level->id }}" {{ $due->level_id == $level->id ? 'selected' : '' }}>
          Level {{ $level->number }} - {{ $level->name }}
        </option>
        @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Amount (₵)</label>
      <input type="number" name="amount" step="0.01" class="form-control" value="{{ $due->amount }}" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Status</label>
      <select name="status" class="form-select" required>
        <option value="active" {{ $due->status == 'active' ? 'selected' : '' }}>Active</option>
        <option value="inactive" {{ $due->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
      </select>
    </div>

    <button type="submit" class="btn btn-gray-800">Update</button>
  </form>
</div>

@endsection