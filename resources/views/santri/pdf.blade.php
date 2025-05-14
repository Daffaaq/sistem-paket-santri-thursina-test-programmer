<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Santri</title>
</head>
<body>
    <h2>Detail Santri</h2>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>NIS</th>
            <td>{{ $santri->nis }}</td>
        </tr>
        <tr>
            <th>Nama Santri</th>
            <td>{{ $santri->nama_santri }}</td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td>{{ $santri->alamat }}</td>
        </tr>
        <tr>
            <th>Asrama</th>
            <td>{{ $asrama->nama_asrama }}</td>
        </tr>
        <tr>
            <th>Total Paket Diterima</th>
            <td>{{ $santri->total_paket_diterima }}</td>
        </tr>
    </table>
</body>
</html>
