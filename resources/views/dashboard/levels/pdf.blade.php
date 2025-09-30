<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Levels Report</title>
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
      margin-bottom: 10px;
    }

    table th,
    table td {
      border: 1px solid #777;
      padding: 8px;
      text-align: left;
    }

    table th {
      background: #f5f5f5;
    }

    .footer {
      margin-top: 30px;
      font-size: 11px;
      text-align: center;
      color: #777;
    }
  </style>
</head>

<body>
  <h2>Academic Levels Report</h2>

  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>Level</th>
        <th>Description</th>
        <th>Created At</th>
      </tr>
    </thead>
    <tbody>
      @forelse($levels as $level)
      <tr>
        <td>{{ $level->id }}</td>
        <td>Level {{ $level->number }}</td>
        <td>{{ $level->description ?? '—' }}</td>
        <td>{{ $level->created_at->format('d M Y') }}</td>
      </tr>
      @empty
      <tr>
        <td colspan="4" style="text-align: center;">No levels available</td>
      </tr>
      @endforelse
    </tbody>
  </table>

  <div class="footer">
    Generated on {{ now()->format('d M Y H:i') }}
  </div>
</body>

</html>