<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SIMAGANG | {{ $title }}</title>
    <link rel="icon" href="{{ asset('template/images/logo_prov3.png') }}" type="image/x-icon">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        h2 {
            text-align: center;
        }

        .note {
            margin-top: 20px;
            font-size: 14px;
            color: #333;
        }
    </style>
</head>

<body>
    <h2>Daftar Pengguna Aktif Peserta Magang</h2>
    <hr>
    <p>Dibuat oleh: {{ Auth::user()->nama }}</p>
    <p>Pada Tanggal: {{ \Carbon\Carbon::now()->format('d-m-Y H:i:s') }}</p>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Peran</th>
                <th>Tanggal Verifikasi</th>
                <th>Disetujui Oleh</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($verifiedUsers as $index => $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->nama }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->is_admin == 0 ? 'Peserta Magang' : 'Admin' }}</td>
                    <td>{{ $user->created_at->format('d-m-Y') }}</td>
                    <td>{{ $user->approvedBy ? $user->approvedBy->nama : '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        window.print();
    </script>
</body>

</html>
