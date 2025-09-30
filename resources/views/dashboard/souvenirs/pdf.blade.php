<!DOCTYPE html>
<html>

<head>
  <title>Souvenirs Report</title>
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
  <h2>Souvenirs Report</h2>
  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Level</th>
        <th>Academic Year</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      @foreach($souvenirs as $souvenir)
      <tr>
        <td>{{ $souvenir->id }}</td>
        <td>{{ $souvenir->name }}</td>
        <td>{{ $souvenir->level->number }} - {{ $souvenir->level->name }}</td>
        <td>{{ $souvenir->academicYear->name }}</td>
        <td>{{ ucfirst($souvenir->status) }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</body>

</html>