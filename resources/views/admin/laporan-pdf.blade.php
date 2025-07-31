<html>
<head>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #888; padding: 6px; text-align: left; }
        th { background: #f0f0f0; }
    </style>
</head>
<body>
    <h2>Laporan Penjualan</h2>
    <p>Periode: {{ $start->format('d-m-Y') }} s/d {{ $end->format('d-m-Y') }}</p>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Total Pelanggan</th>
                <th>Total Pesanan</th>
                <th>Total Penjualan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laporan as $row)
            <tr>
                <td>{{ $row['tanggal'] }}</td>
                <td>{{ $row['total_pelanggan'] }}</td>
                <td>{{ $row['total_pesanan'] }}</td>
                <td>Rp {{ number_format($row['total_penjualan'], 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html> 