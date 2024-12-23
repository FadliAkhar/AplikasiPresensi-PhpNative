<?php require 'functions.php';

// Pastikan ID dan status diterima
if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = $_GET['id'];
    $status = $_GET['status'];

    // Validasi status
    if (in_array($status, ['hadir', 'izin', 'alpa'])) {
        // Ambil data siswa berdasarkan ID
        $siswa = query("SELECT * FROM siswa WHERE id = $id")[0];
        $nis = $siswa['nis'];
        $nama = $siswa['nama'];
        $jurusan = $siswa['jurusan'];
        $tanggal = date('Y-m-d');

        // Periksa apakah data presensi sudah ada di tabel riwayat_presensi
        $cekData = query("SELECT * FROM riwayat_presensi WHERE nis = '$nis' AND tanggal = '$tanggal'");

        if (count($cekData) > 0) {
            // Data sudah ada, lakukan update
            $queryRiwayat = "UPDATE riwayat_presensi 
                             SET presensi = '$status' 
                             WHERE nis = '$nis' AND tanggal = '$tanggal'";
        } else {
            // Data belum ada, lakukan insert
            $queryRiwayat = "INSERT INTO riwayat_presensi (nis, nama, jurusan, presensi, tanggal) 
                             VALUES ('$nis', '$nama', '$jurusan', '$status', '$tanggal')";
        }

        // Eksekusi query untuk riwayat presensi
        mysqli_query($conn, $queryRiwayat);

        // Update data presensi di tabel siswa
        $querySiswa = "UPDATE siswa 
                       SET presensi = '$status', tanggal_presensi = CURDATE() 
                       WHERE id = $id";

        if (mysqli_query($conn, $querySiswa)) {
            echo "<script>
                alert('Presensi berhasil diperbarui!');
                window.location.href = 'index.php';
            </script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "<script>
            alert('Status presensi tidak valid!');
            window.location.href = 'index.php';
        </script>";
    }
} else {
    echo "<script>
        alert('Data tidak lengkap!');
        window.location.href = 'index.php';
    </script>";
}
?>