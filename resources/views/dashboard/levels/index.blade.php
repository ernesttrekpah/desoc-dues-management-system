@extends('dashboard.layout.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
  <div>
    <h2 class="h4">All Levels</h2>
    <p class="mb-0">Manage your academic levels here.</p>
  </div>
  <div>
    <a href="{{ route('dashboard.levels.create') }}" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center">
      <svg class="icon icon-xs me-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
        stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
      </svg>
      New Level
    </a>
    <a href="{{ route('dashboard.levels.export.pdf') }}" class="btn btn-sm btn-outline-secondary ms-2">
      Export PDF
    </a>
  </div>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card card-body border-0 shadow table-wrapper table-responsive">
  <table class="table table-hover">
    <thead>
      <tr>
        <th class="border-gray-200">#</th>
        <th class="border-gray-200">Level</th>
        <th class="border-gray-200">Description</th>
        <th class="border-gray-200">Created At</th>
        <th class="border-gray-200">Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($levels as $level)
      <tr>
        <td>{{ $level->id }}</td>
        <td><span class="fw-bold">Level {{ $level->number }}</span></td>
        <td>{{ $level->description ?? '—' }}</td>
        <td>{{ $level->created_at->format('d M Y') }}</td>
        <td>
          <div class="btn-group">
            <a href="{{ route('dashboard.levels.edit', $level->id) }}" class="btn btn-sm btn-outline-primary">
              Edit
            </a>
            <form action="{{ route('dashboard.levels.destroy', $level->id) }}" method="POST"
              onsubmit="return confirm('Delete this level?');">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-sm btn-outline-danger">
                Delete
              </button>
            </form>
          </div>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="5" class="text-center text-muted">No levels found.</td>
      </tr>
      @endforelse
    </tbody>
  </table>

  <div class="card-footer px-3 border-0 d-flex align-items-center justify-content-between">
    {{ $levels->links() }}
    <div class="fw-normal small">
      Showing <b>{{ $levels->count() }}</b> out of <b>{{ $levels->total() }}</b> entries
    </div>
  </div>
</div>
@endsection