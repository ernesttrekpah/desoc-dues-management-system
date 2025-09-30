@extends('dashboard.layout.app')
@section('content')

<div class="d-flex justify-content-between align-items-center py-4">
  <h2 class="h4">All Dues</h2>
  <a href="{{ route('dues.create') }}" class="btn btn-sm btn-primary">
    + Add Due
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
        <th>Academic Year</th>
        <th>Level</th>
        <th>Amount</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($dues as $due)
      <tr>
        <td>{{ $due->id }}</td>
        <td>{{ $due->academicYear->name }}</td>
        <td>Level {{ $due->level->number }} - {{ $due->level->name }}</td>
        <td>₵{{ number_format($due->amount, 2) }}</td>
        <td>
          @if($due->status === 'active')
          <span class="badge bg-success">Active</span>
          @else
          <span class="badge bg-secondary">Inactive</span>
          @endif
        </td>
        <td>
          <div class="btn-group">
            <a href="{{ route('dues.edit', $due) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('dues.destroy', $due) }}" method="POST" onsubmit="return confirm('Are you sure?')"
              class="d-inline">
              @csrf @method('DELETE')
              <button type="submit" class="btn btn-sm btn-danger">Delete</button>
            </form>
          </div>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="6" class="text-center">No dues found.</td>
      </tr>
      @endforelse
    </tbody>
  </table>

  <div class="mt-3">
    {{ $dues->links() }}
  </div>
</div>

<div class="mt-3">
  <a href="{{ route('dues.exportPdf') }}" class="btn btn-outline-danger">
    Export PDF
  </a>
</div>

@endsection