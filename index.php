<?php
session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}



// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "18339.Fadli", "presensi");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

/// Ambil data siswa berdasarkan tanggal presensi hari ini
$siswa = mysqli_query($conn, "SELECT * FROM siswa WHERE tanggal_presensi = CURDATE() OR tanggal_presensi IS NULL");

if (!$siswa) {
    die("Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Presensi Siswa</title>
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
    <script>
        function konfirmasiPresensi(status, nis) {
            if (confirm('Apakah Anda yakin ingin mengabsen siswa dengan NIS ' + nis + ' sebagai ' + status + '?')) {
                // Jika konfirmasi diterima, redirect ke proses_presensi.php
                window.location.href = "proses_presensi.php?status=" + status + "&id=" + nis;
            } else {
                return false; // Jangan lakukan apa-apa jika konfirmasi ditolak
            }
        }
    </script>
</head>
<body>
    <h1>Presensi Siswa</h1>
    <a href="logout.php">Logout</a> |
    <a href="tambah.php">Tambah Data</a> |
    <a href="rekapan_presensi.php">Rekapan Presensi</a> 

    <form action="" method="post" class="cari">
            <input type="text" name="keyword" size="25" autofocus placeholder="Cariii....."
            autocomplete="off" id = "keyword">
            <button type="submit" name="cari" id="tombol-cari">Cari</button>
    </form>
<div id="container">
    <table border="1" cellpadding="10">
        <tr>
            <th>No</th>
            <th>NIS</th>
            <th>Nama</th>
            <th>Jurusan</th>
            <th>Presensi</th>
            <th>Status Absen</th>
            <th>Aksi</th>
        </tr>
        <?php $i = 1; ?>
        <?php while ($row = mysqli_fetch_assoc($siswa)): ?>
        <tr>
            <td><?= $i++; ?></td>
            <td><?= $row["nis"]; ?></td>
            <td><?= $row["nama"]; ?></td>
            <td><?= $row["jurusan"]; ?></td>
            <td>
                <!-- Tombol Hadir, Izin, Alpa -->
                <button style="background-color: green; color: white; padding: 8px 12px; border: none; border-radius: 4px; cursor: pointer;" 
                        onclick="konfirmasiPresensi('hadir', <?= $row['id']; ?>)">Hadir</button>
                <button style="background-color: orange; color: white; padding: 8px 12px; border: none; border-radius: 4px; cursor: pointer;" 
                        onclick="konfirmasiPresensi('izin', <?= $row['id']; ?>)">Izin</button>
                <button style="background-color: red; color: white; padding: 8px 12px; border: none; border-radius: 4px; cursor: pointer;" 
                onclick="konfirmasiPresensi('alpa', <?= $row['id']; ?>)">Alpa</button>
            </td>

            <td class="status-absen <?= !empty($row["presensi"]) && $row["tanggal_presensi"] == date('Y-m-d') ? strtolower($row["presensi"]) : 'belum'; ?>">
                <?php if (!empty($row["presensi"]) && $row["tanggal_presensi"] == date('Y-m-d')): ?>
                    <?= ucfirst($row["presensi"]); ?>
                <?php else: ?>
                    Belum absen
                <?php endif; ?>
            </td>

            <td class="aksi">
            <a href="ubah.php?id=<?= $row['id']; ?>" 
            style="background-color: #4a90e2; color: white; padding: 8px 12px; text-decoration: none; border-radius: 4px; display: inline-block; cursor: pointer;">Ubah</a> 
            <a href="hapus.php?id=<?= $row['id']; ?>" 
            onclick="return confirm('Yakin?');" 
            style="background-color: #e74c3c; color: white; padding: 8px 12px; text-decoration: none; border-radius: 4px; display: inline-block; cursor: pointer;">Hapus</a>
        </td>

        </tr>
        <?php endwhile; ?>
    </table>
</div>
    <script src="js/script.js"></script>
</body>
</html>
