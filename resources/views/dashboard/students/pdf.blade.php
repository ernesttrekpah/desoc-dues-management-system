<!DOCTYPE html>
<html>

<head>
  <title>Students Report</title>
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
  <h2>Students Report</h2>
  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>Index Number</th>
        <th>Name</th>
        <th>Email</th>
        <th>Level</th>
        <th>Academic Year</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      @foreach($students as $student)
      <tr>
        <td>{{ $student->id }}</td>
        <td>{{ $student->index_number }}</td>
        <td>{{ $student->name }}</td>
        <td>{{ $student->email ?? '—' }}</td>
        <td>{{ $student->level->number }} - {{ $student->level->name }}</td>
        <td>{{ $student->academicYear->name }}</td>
        <td>{{ ucfirst($student->status) }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</body>

</html>