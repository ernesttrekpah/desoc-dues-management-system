<!DOCTYPE html>
<html>

<head>
  <title>Users Report</title>
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
  </style>
</head>

<body>
  <h2>Users Report</h2>
  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Index Number</th>
        <th>Email</th>
        <th>Role</th>
        <th>Status</th>
        <th>Locked</th>
      </tr>
    </thead>
    <tbody>
      @foreach($users as $user)
      <tr>
        <td>{{ $user->id }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->index_number }}</td>
        <td>{{ $user->email ?? '—' }}</td>
        <td>{{ ucfirst($user->role) }}</td>
        <td>{{ $user->active ? 'Active' : 'Inactive' }}</td>
        <td>{{ $user->is_locked ? 'Locked' : 'Unlocked' }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</body>

</html>