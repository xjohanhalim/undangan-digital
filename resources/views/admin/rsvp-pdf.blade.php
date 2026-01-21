<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data RSVP</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 6px; }
        th { background: #eee; }
    </style>
</head>
<body>

<h3>Data RSVP Undangan</h3>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Kehadiran</th>
            <th>Ucapan</th>
            <th>Waktu</th>
        </tr>
    </thead>
    <tbody>
        @foreach($rsvps as $rsvp)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $rsvp->name }}</td>
            <td>{{ $rsvp->attendance }}</td>
            <td>{{ $rsvp->message }}</td>
            <td>{{ $rsvp->created_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
