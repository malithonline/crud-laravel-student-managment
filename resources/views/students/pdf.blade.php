<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <style>
    body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
    table { width: 100%; border-collapse: collapse; }
    th, td { border: 1px solid #000; padding: 6px; text-align: left; }
    th { background: #eee; }
  </style>
</head>
<body>
  <h2>Students</h2>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>First</th>
        <th>Last</th>
        <th>Email</th>
        <th>Contact</th>
        <th>DOB</th>
        <th>Gender</th>
        <th>Type</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      @foreach($students as $s)
      <tr>
        <td>{{ $s->id }}</td>
        <td>{{ $s->first_name }}</td>
        <td>{{ $s->last_name }}</td>
        <td>{{ $s->email }}</td>
        <td>{{ $s->contact_number }}</td>
        <td>{{ $s->date_of_birth?->format('Y-m-d') }}</td>
        <td>{{ $s->gender }}</td>
        <td>{{ $s->type }}</td>
        <td>{{ $s->status ? 'Active' : 'Inactive' }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</body>
</html>
