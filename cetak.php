<?php
require_once __DIR__ . '/vendor/autoload.php';
require 'functions.php';

// Ambil data siswa dari tabel siswa
$siswa = query("SELECT * FROM siswa");

// Ambil tanggal saat ini
$tanggalSekarang = date('d-m-Y');

// Inisialisasi mPDF
$mpdf = new \Mpdf\Mpdf();

// Mulai membuat HTML untuk PDF
$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekapan Presensi Siswa</title>
</head>
<body>
    <h1>Rekapan Presensi Siswa</h1>
    <h3>Tanggal: ' . $tanggalSekarang . '</h3>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No.</th>
            <th>NIS</th>
            <th>Nama</th>
            <th>Jurusan</th>
            <th>Presensi</th>
        </tr>';

// Loop data siswa
$i = 1;
foreach ($siswa as $row) {
    // Tambahkan data waktu (pastikan kolom `tanggal` ada di tabel)
    $html .= '<tr>
        <td>' . $i++ . '</td>
        <td>' . $row["nis"] . '</td>
        <td>' . $row["nama"] . '</td>
        <td>' . $row["jurusan"] . '</td>
        <td>' . $row["presensi"] . '</td>
    </tr>';
}

$html .= '</table>
</body>
</html>';

// Tulis HTML ke PDF
$mpdf->WriteHTML($html);

// Outputkan PDF ke browser
$mpdf->Output('rekapan_presensi_siswa.pdf', \Mpdf\Output\Destination::INLINE);
?>
