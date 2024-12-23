<?php
require 'functions.php';

// Ambil data berdasarkan ID
$id = $_GET["id"];
$siswa = query("SELECT * FROM siswa WHERE id = $id")[0];

// Cek apakah tombol submit ditekan
if (isset($_POST["submit"])) {
    if (ubah($_POST) > 0) {
        echo "
        <script>
            alert('Data berhasil diubah!');
            document.location.href = 'index.php';
        </script>";
    } else {
        echo "
        <script>
            alert('Data gagal diubah!');
            document.location.href = 'index.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data siswa</title>
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

/* Header Styling */
h1 {
    font-size: 24px;
    margin-bottom: 20px;
    color: #4a90e2;
}

/* Form Styling */
form {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    max-width: 400px;
    margin: 0 auto;
}

/* Form List */
ul {
    list-style: none;
}

/* Form Inputs */
li {
    margin-bottom: 15px;
}

label {
    display: block;
    font-size: 14px;
    font-weight: bold;
    margin-bottom: 5px;
}

input[type="text"] {
    width: 100%;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 16px;
    box-sizing: border-box;
}

/* Button Styling */
button[type="submit"] {
    padding: 8px 16px;
    background-color: #4a90e2;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    width: 100%;
}

button[type="submit"]:hover {
    background-color: #357ab7;
}

/* Responsive Design */
@media (max-width: 768px) {
    form {
        width: 90%;
    }

    input[type="text"], button[type="submit"] {
        font-size: 14px;
    }
}
</style>
</head>
<body>
    <h1>Ubah Data siswa</h1>
    <a href="index.php">Kembali</a>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?= $siswa["id"]; ?>">
        <ul>
            <li>
                <label for="nis">NIS: </label>
                <input type="text" name="nis" id="nis" required value="<?= $siswa["nis"]; ?>">
            </li>
            <li>
                <label for="nama">Nama: </label>
                <input type="text" name="nama" id="nama" required value="<?= $siswa["nama"]; ?>">
            </li>
            <li>
                <label for="jurusan">Jurusan: </label>
                <input type="text" name="jurusan" id="jurusan" required value="<?= $siswa["jurusan"]; ?>">
            </li>
            <li>
                <button type="submit" name="submit">Ubah Data</button>
            </li>
        </ul>
    </form>
</body>
</html>
