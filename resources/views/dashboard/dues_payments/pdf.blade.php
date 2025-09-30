<!DOCTYPE html>
<html>

<head>
  <title>Dues Payments Report</title>
  <style>
    body {
      font-family: DejaVu Sans, sans-serif;
      font-size: 12px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th,
    td {
      border: 1px solid #ddd;
      padding: 6px;
      text-align: left;
    }

    th {
      background: #f2f2f2;
    }

    h2 {
      margin-bottom: 10px;
    }
  </style>
</head>

<body>
  <h2>Dues Payments Report</h2>
  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>Index Number</th>
        <th>Student Name</th>
        <th>Level</th>
        <th>Academic Year</th>
        <th>Amount Paid (₵)</th>
        <th>Date Paid</th>
        <th>Souvenirs</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      @foreach($duesPayments as $payment)
      <tr>
        <td>{{ $payment->id }}</td>
        <td>{{ $payment->student->index_number }}</td>
        <td>{{ $payment->student->name }}</td>
        <td>Level {{ $payment->student->level->number }} - {{ $payment->student->level->name }}</td>
        <td>{{ $payment->academicYear->name }}</td>
        <td>{{ number_format($payment->amount_paid, 2) }}</td>
        <td>{{ $payment->date_paid->format('d M, Y') }}</td>
        <td>
          @if($payment->souvenirs->count())
          {{ $payment->souvenirs->pluck('name')->join(', ') }}
          @else
          —
          @endif
        </td>
        <td>{{ ucfirst($payment->status) }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</body>

</html>