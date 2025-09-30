@extends('dashboard.layout.app')
@section('content')

<div class="d-flex justify-content-between align-items-center py-4">
  <h2 class="h4">All Students</h2>
  <a href="{{ route('students.create') }}" class="btn btn-sm btn-primary">
    + Add Student
  </a>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card card-body border-0 shadow table-wrapper table-responsive">
  <table class="table table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th>Index Number</th>
        <th>Name</th>
        <th>Email</th>
        <th>Level</th>
        <th>Academic Year</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($students as $student)
      <tr>
        <td>{{ $student->id }}</td>
        <td>{{ $student->index_number }}</td>
        <td>{{ $student->name }}</td>
        <td>{{ $student->email ?? '—' }}</td>
        <td>{{ $student->level->number }} - {{ $student->level->name }}</td>
        <td>{{ $student->academicYear->name }}</td>
        <td>
          @if($student->status === 'active')
          <span class="badge bg-success">Active</span>
          @elseif($student->status === 'inactive')
          <span class="badge bg-secondary">Inactive</span>
          @elseif($student->status === 'graduated')
          <span class="badge bg-info text-dark">Graduated</span>
          @endif
        </td>
        <td>
          <div class="btn-group">
            <a href="{{ route('students.edit', $student) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('students.destroy', $student) }}" method="POST"
              onsubmit="return confirm('Are you sure?')" class="d-inline">
              @csrf @method('DELETE')
              <button type="submit" class="btn btn-sm btn-danger">Delete</button>
            </form>
          </div>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="8" class="text-center">No students found.</td>
      </tr>
      @endforelse
    </tbody>
  </table>

  <div class="mt-3">
    {{ $students->links() }}
  </div>
</div>

<div class="mt-3">
  <a href="{{ route('students.exportPdf') }}" class="btn btn-outline-danger">
    Export PDF
  </a>
</div>

@endsection