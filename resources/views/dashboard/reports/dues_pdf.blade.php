<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Dues Report</title>
  <style>
    body {
      font-family: DejaVu Sans, sans-serif;
      font-size: 12px;
      color: #333;
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }

    table,
    th,
    td {
      border: 1px solid #ddd;
    }

    th,
    td {
      padding: 8px;
      text-align: left;
    }

    th {
      background: #f8f9fa;
    }

    .summary {
      margin-top: 20px;
    }

    .summary table {
      width: 60%;
      margin: 0 auto;
    }

    .summary th,
    .summary td {
      padding: 6px 10px;
    }

    .summary th {
      text-align: left;
    }

    .highlight {
      background: #f1f1f1;
      font-weight: bold;
    }
  </style>
</head>

<body>

  <h2>Dues Report</h2>

  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>Student</th>
        <th>Index Number</th>
        <th>Level</th>
        <th>Academic Year</th>
        <th>Date Paid</th>
        <th>Amount Paid (₵)</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      @forelse($payments as $payment)
      <tr>
        <td>{{ $payment->id }}</td>
        <td>{{ $payment->student->name }}</td>
        <td>{{ $payment->student->index_number }}</td>
        <td>Level {{ $payment->student->level->number }} - {{ $payment->student->level->name }}</td>
        <td>{{ $payment->academicYear->name }}</td>
        <td>{{ \Carbon\Carbon::parse($payment->date_paid)->format('d M, Y') }}</td>
        <td>{{ number_format($payment->amount_paid, 2) }}</td>
        <td>{{ ucfirst($payment->status) }}</td>
      </tr>
      @empty
      <tr>
        <td colspan="8" style="text-align:center;">No payments found.</td>
      </tr>
      @endforelse
    </tbody>
  </table>

  <!-- Summary Totals -->
  <div class="summary">
    <h3 style="text-align:center; margin-bottom:10px;">Summary Totals</h3>
    <table>
      <tr>
        <th>Confirmed Payments</th>
        <td>₵{{ number_format($totals['confirmed'], 2) }}</td>
      </tr>
      <tr>
        <th>Pending Payments</th>
        <td>₵{{ number_format($totals['pending'], 2) }}</td>
      </tr>
      <tr>
        <th>Cancelled Payments</th>
        <td>₵{{ number_format($totals['cancelled'], 2) }}</td>
      </tr>
      <tr class="highlight">
        <th>Overall Total</th>
        <td>₵{{ number_format($totals['overall'], 2) }}</td>
      </tr>
    </table>
  </div>

</body>

</html>