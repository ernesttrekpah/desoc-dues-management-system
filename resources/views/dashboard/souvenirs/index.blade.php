@extends('dashboard.layout.app')
@section('content')

<div class="d-flex justify-content-between align-items-center py-4">
  <h2 class="h4">All Souvenirs</h2>
  <a href="{{ route('souvenirs.create') }}" class="btn btn-sm btn-primary">+ Add Souvenir</a>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card card-body border-0 shadow table-wrapper table-responsive">
  <table class="table table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Level</th>
        <th>Academic Year</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($souvenirs as $souvenir)
      <tr>
        <td>{{ $souvenir->id }}</td>
        <td>{{ $souvenir->name }}</td>
        <td>{{ $souvenir->level->number }} - {{ $souvenir->level->name }}</td>
        <td>{{ $souvenir->academicYear->name }}</td>
        <td>
          @if($souvenir->status === 'available')
          <span class="badge bg-success">Available</span>
          @else
          <span class="badge bg-danger">Unavailable</span>
          @endif
        </td>
        <td>
          <div class="btn-group">
            <a href="{{ route('souvenirs.edit', $souvenir) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('souvenirs.destroy', $souvenir) }}" method="POST" class="d-inline"
              onsubmit="return confirm('Are you sure?')">
              @csrf @method('DELETE')
              <button type="submit" class="btn btn-sm btn-danger">Delete</button>
            </form>
          </div>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="6" class="text-center">No souvenirs found.</td>
      </tr>
      @endforelse
    </tbody>
  </table>

  <div class="mt-3">
    {{ $souvenirs->links() }}
  </div>
</div>

<div class="mt-3">
  <a href="{{ route('souvenirs.exportPdf') }}" class="btn btn-outline-danger">
    Export PDF
  </a>
</div>

@endsection