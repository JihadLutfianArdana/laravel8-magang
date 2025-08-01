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
    <h2>Daftar Registrasi Pengguna</h2>
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
                <th>Dibuat Pada</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($admins as $admin)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $admin->nama }}</td>
                    <td>{{ $admin->email }}</td>
                    <td>{{ $admin->is_admin == 1 ? 'Pimpinan' : '' }}</td>
                    <td>{{ $admin->created_at->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Catatan -->
    <div class="note">
        <strong>Catatan:</strong> Password default untuk setiap akun admin adalah <strong>admin</strong> + nomor baris
        pada tabel ini.
        Contohnya, admin di baris pertama memiliki password <strong>admin1</strong>, admin di baris kedua
        <strong>admin2</strong>, dan seterusnya.
        Pastikan setiap admin segera mengganti password mereka setelah login pertama kali untuk menjaga keamanan akun.
    </div>

    <script>
        window.print();
    </script>
</body>

</html>
