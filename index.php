<?php
session_start();
$isLoggedIn = isset($_SESSION['username']);
$roleStatus = isset($_SESSION['role']) ? $_SESSION['role'] : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            flex-direction: column;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background-color: #333;
            color: #fff;
            position: fixed;
            width: 80%;
            top: 0;
        }


        .buttons {
            text-align: center;
        }

         button {
            padding: 10px;
            font-size: 16px;
        }
    </style>

</head>

<body>
    <div class="navbar">
        <h1>E-kokmurce</h1>
        <div class="buttons">
            <?php if (!$isLoggedIn) : ?>
                <!-- Tampilkan tombol login dan register jika belum login -->
                <button onclick="window.location.href='login.php'">Login</button>
                <button onclick="window.location.href='register.php'">Register</button>
            <?php else : ?>
                <!-- Tampilkan tombol logout jika sudah login -->
                <button onclick="window.location.href='logout.php'">Logout</button>
            <?php endif; ?>
        </div>
    </div>

    <h1>Selamat Datang di E-kokmurce</h1>
    <?php
    // Menampilkan status peran
    if ($isLoggedIn) {
        echo "<h3 class='role-status'>Anda $roleStatus</h3>";
    }
    ?>
</body>

</html>