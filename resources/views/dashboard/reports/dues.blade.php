@extends('dashboard.layout.app')

@section('content')

<div class="d-flex justify-content-between align-items-center py-4">
  <h2 class="h4">Dues Report</h2>
</div>

<div class="card mb-3 border-0 shadow-sm">
  <div class="card-body">
    <form method="GET" action="{{ route('dashboard.report.dues') }}" class="row g-3">
      <div class="col-md-4">
        <select name="academic_year_id" class="form-select" required>
          <option value="">Select Academic Year</option>
          @foreach($academicYears as $year)
          <option value="{{ $year->id }}" {{ request('academic_year_id')==$year->id ? 'selected' : '' }}>
            {{ $year->name }}
          </option>
          @endforeach
        </select>
      </div>
      <div class="col-md-4">
        <select name="level_id" class="form-select" required>
          <option value="">Select Level</option>
          @foreach($levels as $level)
          <option value="{{ $level->id }}" {{ request('level_id')==$level->id ? 'selected' : '' }}>
            Level {{ $level->number }} - {{ $level->name }}
          </option>
          @endforeach
        </select>
      </div>
      <div class="col-md-2">
        <button type="submit" class="btn btn-gray-800 w-100">Generate</button>
      </div>
      <div class="col-md-2">
        @if($payments->count())
        <a href="{{ route('dashboard.report.dues.pdf', request()->query()) }}" class="btn btn-outline-danger w-100">
          Export PDF
        </a>
        @endif
      </div>
    </form>
  </div>
</div>

@if($payments->count())
<div class="card card-body border-0 shadow table-wrapper table-responsive">
  <table class="table table-hover align-middle">
    <thead>
      <tr>
        <th>#</th>
        <th>Student</th>
        <th>Index Number</th>
        <th>Level</th>
        <th>Academic Year</th>
        <th>Date Paid</th>
        <th>Amount Paid</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      @foreach($payments as $payment)
      <tr>
        <td>{{ $payment->id }}</td>
        <td>{{ $payment->student->name }}</td>
        <td>{{ $payment->student->index_number }}</td>
        <td>Level {{ $payment->student->level->number }} - {{ $payment->student->level->name }}</td>
        <td>{{ $payment->academicYear->name }}</td>
        <td>{{ \Carbon\Carbon::parse($payment->date_paid)->format('d M, Y') }}</td>
        <td>₵{{ number_format($payment->amount_paid, 2) }}</td>
        <td>
          @if($payment->status === 'pending')
          <span class="badge bg-warning">Pending</span>
          @elseif($payment->status === 'confirmed')
          <span class="badge bg-success">Confirmed</span>
          @else
          <span class="badge bg-danger">Cancelled</span>
          @endif
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div class="card mt-4 shadow border-0">
  <div class="card-body">
    <h5 class="mb-3">Summary Totals</h5>
    <ul class="list-group">
      <li class="list-group-item d-flex justify-content-between">
        <span>Confirmed Payments</span>
        <strong>₵{{ number_format($totals['confirmed'], 2) }}</strong>
      </li>
      <li class="list-group-item d-flex justify-content-between">
        <span>Pending Payments</span>
        <strong>₵{{ number_format($totals['pending'], 2) }}</strong>
      </li>
      <li class="list-group-item d-flex justify-content-between">
        <span>Cancelled Payments</span>
        <strong>₵{{ number_format($totals['cancelled'], 2) }}</strong>
      </li>
      <li class="list-group-item d-flex justify-content-between bg-light">
        <span><strong>Overall Total</strong></span>
        <strong>₵{{ number_format($totals['overall'], 2) }}</strong>
      </li>
    </ul>
  </div>
</div>
@endif

@endsection