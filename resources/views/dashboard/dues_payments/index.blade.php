@extends('dashboard.layout.app')
@section('content')

<div class="d-flex justify-content-between align-items-center py-4">
  <h2 class="h4">Dues Payments</h2>
  <div>
    <a href="{{ route('dues_payments.create') }}" class="btn btn-sm btn-primary">+ Add Payment</a>
    <a href="{{ route('dues_payments.exportPdf', request()->query()) }}" class="btn btn-sm btn-outline-danger">
      Export PDF
    </a>
  </div>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<!-- Filters -->
<div class="card mb-3 border-0 shadow-sm">
  <div class="card-body">
    <form method="GET" action="{{ route('dues_payments.index') }}" class="row g-3">

      <!-- Search -->
      <div class="col-md-3">
        <input type="text" name="search" class="form-control" placeholder="Search by name or index"
          value="{{ request('search') }}">
      </div>

      <!-- Level -->
      <div class="col-md-3">
        <select name="level_id" class="form-select">
          <option value="">All Levels</option>
          @foreach($levels as $level)
          <option value="{{ $level->id }}" {{ request('level_id')==$level->id ? 'selected' : '' }}>
            Level {{ $level->number }} - {{ $level->name }}
          </option>
          @endforeach
        </select>
      </div>

      <!-- Academic Year -->
      <div class="col-md-3">
        <select name="academic_year_id" class="form-select">
          <option value="">All Academic Years</option>
          @foreach($academicYears as $year)
          <option value="{{ $year->id }}" {{ request('academic_year_id')==$year->id ? 'selected' : '' }}>
            {{ $year->name }}
          </option>
          @endforeach
        </select>
      </div>

      <!-- Status -->
      <div class="col-md-2">
        <select name="status" class="form-select">
          <option value="">All Status</option>
          <option value="pending" {{ request('status')=='pending' ? 'selected' : '' }}>Pending</option>
          <option value="confirmed" {{ request('status')=='confirmed' ? 'selected' : '' }}>Confirmed</option>
          <option value="cancelled" {{ request('status')=='cancelled' ? 'selected' : '' }}>Cancelled</option>
        </select>
      </div>

      <!-- Actions -->
      <div class="col-md-1 d-grid">
        <button type="submit" class="btn btn-gray-800">Filter</button>
      </div>
    </form>
  </div>
</div>

<!-- Table -->
<div class="card card-body border-0 shadow table-wrapper table-responsive">
  <table class="table table-hover align-middle">
    <thead>
      <tr>
        <th>#</th>
        <th>Index Number</th>
        <th>Name</th>
        <th>Level</th>
        <th>Academic Year</th>
        <th>Date Paid</th>
        <th>Amount Paid</th>
        <th>Receipt Number</th>
        <th>Souvenirs</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($payments as $payment)
      <tr>
        <td>{{ $payment->id }}</td>
        <td>{{ $payment->student->index_number }}</td>
        <td>{{ $payment->student->name }}</td>
        <td>Level {{ $payment->student->level->number }} - {{ $payment->student->level->name }}</td>
        <td>{{ $payment->academicYear->name }}</td>
        <td>{{ \Carbon\Carbon::parse($payment->date_paid)->format('d M, Y') }}</td>
        <td>₵{{ number_format($payment->amount_paid, 2) }}</td>
        <td>{{ $payment->receipt_number }}</td>
        <td>
          @if($payment->souvenirs->count())
          <ul class="mb-0">
            @foreach($payment->souvenirs as $s)
            <li>{{ $s->name }}</li>
            @endforeach
          </ul>
          @else
          —
          @endif
        </td>
        <td>
          @if($payment->status === 'pending')
          <span class="badge bg-warning">Pending</span>
          @elseif($payment->status === 'confirmed')
          <span class="badge bg-success">Confirmed</span>
          @else
          <span class="badge bg-danger">Cancelled</span>
          @endif
        </td>
        <td>
          <div class="btn-group">
            <a href="{{ route('dues_payments.edit', $payment) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('dues_payments.destroy', $payment) }}" method="POST"
              onsubmit="return confirm('Are you sure?')" class="d-inline">
              @csrf @method('DELETE')
              <button type="submit" class="btn btn-sm btn-danger">Delete</button>
            </form>
          </div>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="10" class="text-center">No dues payments found.</td>
      </tr>
      @endforelse
    </tbody>
  </table>

  <div class="mt-3">
    {{ $payments->appends(request()->query())->links() }}
  </div>
</div>

@endsection