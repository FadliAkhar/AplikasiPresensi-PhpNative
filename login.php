<?php
session_start();
require 'functions.php'; // Pastikan file ini memiliki koneksi ke database ($conn)

// cek cookie 
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // ambil nama berdasarkan id
    $result = mysqli_query($conn, "SELECT nama FROM users WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    // cek cookie dan nama
    if ($key === hash('sha256', $row['nama'])) {
        $_SESSION['login'] = true;
    }
}

if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST["login"])) {
    $nama = $_POST["nama"];
    $password = $_POST["password"];

    // Query nama
    $result = mysqli_query($conn, "SELECT * FROM users WHERE nama = '$nama'");

    // Cek nama
    if (mysqli_num_rows($result) === 1) {

        // Ambil data user
        $row = mysqli_fetch_assoc($result);

        // Cek password
        if (password_verify($password, $row["password"])) {

            // set session
            $_SESSION["login"] = true;

            // cek remember me
            if (isset($_POST['remember'])) {

                // buat cookie
                setcookie('id', $row['id'], time() + 60);
                setcookie('key', hash('sha256', $row['nama']), time() + 60);
            }

            // Redirect ke halaman berikutnya
            header("Location: index.php");
            exit;
        }
    }
    $error = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
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
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* Container Styling */
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        /* Header Styling */
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #4a90e2;
            text-align: center;
        }

        /* Form Elements */
        label {
            font-size: 14px;
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            margin-bottom: 15px;
        }

        /* Checkbox Styling */
        input[type="checkbox"] {
            margin-right: 5px;
        }

        label[for="remember"] {
            font-size: 14px;
        }

        /* Button Styling */
        button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4a90e2;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #357ab7;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            form {
                padding: 15px;
            }

            h1 {
                font-size: 20px;
            }

            input[type="text"], input[type="password"], button[type="submit"] {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <form action="" method="post">
        <h1>Halaman Login</h1>
        <?php if (isset($error)) : ?>
            <p style="color: red; font-style: italic;">nama / Password salah</p>
        <?php endif; ?>
        <label for="nama">Nama:</label>
        <input type="text" name="nama" id="nama" required>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>

        <input type="checkbox" name="remember" id="remember">
        <label for="remember">Remember me</label>

        <button type="submit" name="login">Login</button>
        <hr>
        <p class="text-center">Belum punya akun? <a href="registrasi.php">Registrasi</a> Sekarang Juga!!!</p>
    </form>
</body>
</html>
