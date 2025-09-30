@extends('dashboard.layout.app')
@section('content')

<div class="d-flex justify-content-between align-items-center py-4">
  <h2 class="h4">Users</h2>
  <div>
    <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary">+ Add User</a>
    <a href="{{ route('users.exportPdf') }}" class="btn btn-sm btn-outline-danger">Export PDF</a>
  </div>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card card-body border-0 shadow table-wrapper table-responsive">
  <table class="table table-hover align-middle">
    <thead>
      <tr>
        <th>#</th>
        <th>Avatar</th>
        <th>Name</th>
        <th>Index Number</th>
        <th>Email</th>
        <th>Role</th>
        <th>Status</th>
        <th>Locked</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($users as $user)
      <tr>
        <td>{{ $user->id }}</td>
        <td>
          @if($user->avatar)
          <img src="{{ asset('storage/'.$user->avatar) }}" class="rounded-circle" width="40" height="40" alt="avatar">
          @else
          —
          @endif
        </td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->index_number }}</td>
        <td>{{ $user->email ?? '—' }}</td>
        <td><span class="badge bg-info text-dark">{{ ucfirst($user->role) }}</span></td>
        <td>
          @if($user->active)
          <span class="badge bg-success">Active</span>
          @else
          <span class="badge bg-secondary">Inactive</span>
          @endif
        </td>
        <td>
          @if($user->is_locked)
          <span class="badge bg-danger">Locked</span>
          @else
          <span class="badge bg-success">Unlocked</span>
          @endif
        </td>
        <td>
          <div class="btn-group">
            <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Are you sure?')"
              class="d-inline">
              @csrf @method('DELETE')
              <button type="submit" class="btn btn-sm btn-danger">Delete</button>
            </form>
          </div>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="9" class="text-center">No users found.</td>
      </tr>
      @endforelse
    </tbody>
  </table>

  <div class="mt-3">
    {{ $users->links() }}
  </div>
</div>
@endsection