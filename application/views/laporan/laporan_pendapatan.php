<!DOCTYPE html>
<html>

<head>
    <title>Laporan Pendapatan Bulanan</title>
    <style>
        /* Atur gaya tampilan tabel */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
            padding: 5px;
        }

        th {
            background-color: #CCCCCC;
        }

        /* Atur gaya tampilan total */
        .total {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h2>Laporan Pendapatan Bulanan</h2>
    <p>Bulan: <?php echo $bulan; ?></p>

    <table>
        <tr>
            <th>No</th>
            <th>Kode Karcis</th>
            <th>Tanggal Keluar</th>
            <th>Durasi Parkir</th>
            <th>Harga</th>
        </tr>
        <?php
        $totalHarga = 0;
        $totalKarcis = count($laporan);
        $no = 1;
        foreach ($laporan as $row) {
            $totalHarga += $row->harga;
        ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $row->kode_karcis; ?></td>
                <td><?php echo $row->waktu_keluar; ?></td>
                <td><?php echo $row->durasi_parkir; ?> jam</td>
                <td><?php echo $row->harga; ?></td>
            </tr>
        <?php } ?>
        <tr class="total">
            <td colspan="4">Total Karcis Keluar</td>
            <td><?php echo $totalKarcis; ?></td>
        </tr>
        <tr class="total">
            <td colspan="4">Total Pendapatan</td>
            <td>Rp. <?php echo $totalHarga; ?></td>
        </tr>
    </table>
</body>

</html>