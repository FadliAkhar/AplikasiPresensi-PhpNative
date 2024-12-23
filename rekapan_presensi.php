<?php
require 'functions.php';

// Ambil data presensi berdasarkan tanggal (bisa menggunakan tanggal hari ini)
$tanggal = date('Y-m-d');
$rekapanPresensi = query("SELECT * FROM riwayat_presensi WHERE tanggal = '$tanggal'");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rekapan Presensi</title>
</head>
<body>
    <h1>Rekapan Presensi Siswa - <?= $tanggal ?></h1>
    <style>
        /* Reset default styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body Styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            color: #333;
            line-height: 1.6;
            margin: 20px;
        }

        /* Header Section */
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #4a90e2;
        }

        /* Navbar Links */
        a {
            text-decoration: none;
            color: #4a90e2;
            font-weight: bold;
            padding: 10px;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4a90e2;
            color: #fff;
        }

        td {
            background-color: #f9f9f9;
        }

        /* Hover Effect for Table Rows */
        tr:hover td {
            background-color: #f1f1f1;
        }

        /* Form Styling */
        form {
            margin: 20px 0;
        }

        input[type="text"] {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            width: 250px;
        }

        button[type="submit"] {
            padding: 8px 16px;
            background-color: #4a90e2;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button[type="submit"]:hover {
            background-color: #357ab7;
        }

        /* Action Links Styling */
        .aksi a {
            color: #4a90e2;
            font-weight: bold;
            padding: 5px;
            text-decoration: none;
            border-radius: 4px;
        }

        .aksi a:hover {
            background-color: #f1f1f1;
        }

        /* Status Absen Style */
        .status-absen {
            font-weight: bold;
        }

        .status-absen.hadir {
            color: green;
        }

        .status-absen.izin {
            color: orange;
        }

        .status-absen.alpa {
            color: red;
        }

        /* Responsiveness */
        @media (max-width: 768px) {
            table, input[type="text"], button[type="submit"] {
                width: 100%;
                font-size: 14px;
            }

            th, td {
                padding: 8px;
            }

            a {
                font-size: 14px;
                margin-bottom: 10px;
            }
        }
    </style>

    <table border="1" cellpadding="10">
        <tr>
            <th>No</th>
            <th>NIS</th>
            <th>Nama</th>
            <th>Jurusan</th>
            <th>Presensi</th>
        </tr>

        <button style="padding: 10px 20px; background-color: #4a90e2; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px;" onclick="window.open('cetak.php', '_blank')">Ekspor PDF</button>

        <?php $i = 1; ?>
        <?php foreach ($rekapanPresensi as $row): ?>
        <tr>
            <td><?= $i++; ?></td>
            <td><?= $row["nis"]; ?></td>
            <td><?= $row["nama"]; ?></td>
            <td><?= $row["jurusan"]; ?></td>
            <td><?= ucfirst($row["presensi"]); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <div style="margin-top: 20px;">
    <button style="padding: 10px 20px; background-color: #4a90e2; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px;" onclick="window.location.href='index.php'">Kembali</button>
</div>
</body>
</html>
