@extends('dashboard.layout.app')

@section('content')
<div class="d-flex justify-content-between align-items-center py-4">
  <h2 class="h4">Academic Years</h2>
  <div>
    <a href="{{ route('academic_year.create') }}" class="btn btn-sm btn-gray-800">
      + New Academic Year
    </a>
    <a href="{{ route('academic_year.exportPdf') }}" class="btn btn-sm btn-outline-danger">
      Export PDF
    </a>
  </div>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card card-body shadow border-0 table-wrapper table-responsive">
  <table class="table table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th>Academic Year</th>
        <th>Description</th>
        <th>Created At</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($academicYears as $year)
      <tr>
        <td>{{ $year->id }}</td>
        <td>{{ $year->name }}</td>
        <td>{{ $year->description ?? '—' }}</td>
        <td>{{ $year->created_at->format('d M Y') }}</td>
        <td>
          <a href="{{ route('academic_year.edit', $year) }}" class="btn btn-sm btn-primary">Edit</a>
          <form action="{{ route('academic_year.destroy', $year) }}" method="POST" style="display:inline-block">
            @csrf @method('DELETE')
            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this academic year?')">Delete</button>
          </form>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="5" class="text-center">No academic years yet.</td>
      </tr>
      @endforelse
    </tbody>
  </table>
  {{ $academicYears->links() }}
</div>
@endsection