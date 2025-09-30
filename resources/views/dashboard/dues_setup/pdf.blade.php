<!DOCTYPE html>
<html>

<head>
  <title>Dues Report</title>
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
      padding: 8px;
      text-align: left;
    }

    th {
      background: #f2f2f2;
    }
  </style>
</head>

<body>
  <h2>Dues Report</h2>
  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>Academic Year</th>
        <th>Level</th>
        <th>Amount (₵)</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      @foreach($dues as $due)
      <tr>
        <td>{{ $due->id }}</td>
        <td>{{ $due->academicYear->name }}</td>
        <td>Level {{ $due->level->number }} - {{ $due->level->name }}</td>
        <td>₵{{ number_format($due->amount, 2) }}</td>
        <td>{{ ucfirst($due->status) }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</body>

</html>