@extends('dashboard.layout.app')
@section('content')

<div class="d-flex justify-content-between align-items-center py-4">
  <h2 class="h4">Add New Student</h2>
  <a href="{{ route('students.index') }}" class="btn btn-sm btn-secondary">← Back</a>
</div>

<div class="card card-body shadow border-0">
  <form action="{{ route('students.store') }}" method="POST">
    @csrf

    <div class="mb-3">
      <label class="form-label">Index Number</label>
      <input type="text" name="index_number" class="form-control" value="{{ old('index_number') }}" required>
      @error('index_number') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
      <label class="form-label">Full Name</label>
      <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
      @error('name') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
      <label class="form-label">Email (optional)</label>
      <input type="email" name="email" class="form-control" value="{{ old('email') }}">
      @error('email') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
      <label class="form-label">Phone (optional)</label>
      <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
      @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
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
      <label class="form-label">Address</label>
      <textarea name="address" class="form-control">{{ old('address') }}</textarea>
      @error('address') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
      <label class="form-label">Status</label>
      <select name="status" class="form-select" required>
        <option value="active" {{ old('status')=='active' ? 'selected' : '' }}>Active</option>
        <option value="inactive" {{ old('status')=='inactive' ? 'selected' : '' }}>Inactive</option>
        <option value="graduated" {{ old('status')=='graduated' ? 'selected' : '' }}>Graduated</option>
      </select>
      @error('status') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <button type="submit" class="btn btn-gray-800">Save</button>
  </form>
</div>

@endsection