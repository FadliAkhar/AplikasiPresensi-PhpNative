<?php
$conn = mysqli_connect("localhost", "root", "18339.Fadli", "presensi");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Fungsi untuk query database
function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// Fungsi tambah data siswa
function tambah($data) {
    global $conn;

    $nis = htmlspecialchars($data["nis"] ?? '');
    $nama = htmlspecialchars($data["nama"] ?? '');
    $jurusan = htmlspecialchars($data["jurusan"] ?? '');

    if (!$nis || !$nama || !$jurusan) {
        return -1; // Menandakan input tidak valid
    }

    $query = "INSERT INTO siswa (nis, nama, jurusan) VALUES ('$nis', '$nama', '$jurusan')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

// Fungsi ubah data siswa
function ubah($data) {
    global $conn;

    $id = $data["id"];
    $nis = htmlspecialchars($data["nis"] ?? '');
    $nama = htmlspecialchars($data["nama"] ?? '');
    $jurusan = htmlspecialchars($data["jurusan"] ?? '');

    if (!$id || !$nis || !$nama || !$jurusan) {
        return -1; // Menandakan input tidak valid
    }

    $query = "UPDATE siswa SET nis='$nis', nama='$nama', jurusan='$jurusan' WHERE id=$id";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

// Fungsi hapus data siswa
function hapus($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM siswa WHERE id = $id");
    return mysqli_affected_rows($conn);
}

// Fungsi menyimpan riwayat presensi
function simpanRiwayatPresensi() {
    global $conn;
    $presensi = query("SELECT * FROM siswa");
    foreach ($presensi as $data) {
        $nis = $data['nis'] ?? '';
        $nama = $data['nama'] ?? '';
        $jurusan = $data['jurusan'] ?? '';
        $presensi_status = $data['presensi'] ?? '';
        $tanggal = date('Y-m-d');

        if (!$nis || !$nama || !$jurusan || !$presensi_status) {
            continue; // Lewati jika data tidak valid
        }

        $query = "INSERT INTO riwayat_presensi (nis, nama, jurusan, presensi, tanggal) 
                  VALUES ('$nis', '$nama', '$jurusan', '$presensi_status', '$tanggal')";
        mysqli_query($conn, $query);
    }
    
}

// Fungsi reset presensi
function resetPresensi() {
    global $conn;
    $query = "UPDATE siswa SET presensi = 'alpa'";
    mysqli_query($conn, $query);
}

// Fungsi cari data
function cari($keyword){
    $query = "SELECT * FROM siswa
                WHERE 
                nis LIKE '%$keyword%' OR
                nama LIKE '%$keyword%' OR
                jurusan LIKE '%$keyword%' OR
                presensi LIKE '%$keyword%'
                ";

    return query($query);
}
// Fungsi registrasi
function registrasi($data) {
    global $conn;

    $nama = strtolower($data["nama"] ?? '');
    $password = $data["password"] ?? '';
    $password2 = $data["password2"] ?? '';

    if (!$nama || !$password || !$password2) {
        echo "<script>
        alert('Semua field harus diisi!');
        </script>";
        return false;
    }

    // Cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
        alert('Konfirmasi password tidak sesuai!');
        </script>";
        return false;
    }

    // Enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT nama FROM users WHERE nama = '$nama'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
        alert('Nama sudah terdaftar!');
        </script>";
        return false;
    }

    // Tambahkan user baru ke database
    mysqli_query($conn, "INSERT INTO users VALUES(NULL, '$nama', '$password')");
    return mysqli_affected_rows($conn);
}
?>