<?php 
require 'functions.php';

if (isset($_POST["register"])) {
    if (registrasi($_POST) > 0) {
        echo "<script>
        alert('User baru telah ditambahkan!');
        </script>";
        header("Location: login.php"); // Redirect ke halaman login
        exit;
    } else {
        echo mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Registrasi</title>
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
        <h1>Halaman Registrasi</h1>
        <label for="nama">Username:</label>
        <input type="text" name="nama" id="nama" required>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>

        <label for="password2">Konfirmasi Password:</label>
        <input type="password" name="password2" id="password2" required>

        <button type="submit" name="register">Register</button>

    </form>
</body>
</html>
