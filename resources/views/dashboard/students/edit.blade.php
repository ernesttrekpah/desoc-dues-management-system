@extends('dashboard.layout.app')
@section('content')

<div class="d-flex justify-content-between align-items-center py-4">
  <h2 class="h4">Edit Student</h2>
  <a href="{{ route('students.index') }}" class="btn btn-sm btn-secondary">← Back</a>
</div>

<div class="card card-body shadow border-0">
  <form action="{{ route('students.update', $student) }}" method="POST">
    @csrf @method('PUT')

    <div class="mb-3">
      <label class="form-label">Index Number</label>
      <input type="text" name="index_number" class="form-control" value="{{ $student->index_number }}" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Full Name</label>
      <input type="text" name="name" class="form-control" value="{{ $student->name }}" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Email (optional)</label>
      <input type="email" name="email" class="form-control" value="{{ $student->email }}">
    </div>

    <div class="mb-3">
      <label class="form-label">Phone (optional)</label>
      <input type="text" name="phone" class="form-control" value="{{ $student->phone }}">
    </div>

    <div class="mb-3">
      <label class="form-label">Level</label>
      <select name="level_id" class="form-select" required>
        @foreach($levels as $level)
        <option value="{{ $level->id }}" {{ $student->level_id == $level->id ? 'selected' : '' }}>
          Level {{ $level->number }} - {{ $level->name }}
        </option>
        @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Academic Year</label>
      <select name="academic_year_id" class="form-select" required>
        @foreach($academicYears as $year)
        <option value="{{ $year->id }}" {{ $student->academic_year_id == $year->id ? 'selected' : '' }}>
          {{ $year->name }}
        </option>
        @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Address</label>
      <textarea name="address" class="form-control">{{ $student->address }}</textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Status</label>
      <select name="status" class="form-select" required>
        <option value="active" {{ $student->status == 'active' ? 'selected' : '' }}>Active</option>
        <option value="inactive" {{ $student->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
        <option value="graduated" {{ $student->status == 'graduated' ? 'selected' : '' }}>Graduated</option>
      </select>
    </div>

    <button type="submit" class="btn btn-gray-800">Update</button>
  </form>
</div>
@endsection