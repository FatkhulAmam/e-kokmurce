<?php
include 'user.php';
session_start();
 
if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_verify = $_POST['password_verify'];
    $role = $_POST['role'];
    $nomor_hp = $_POST['nomor_hp'];
    $email = $_POST['email'];
    
    try {
        if ($password == $password_verify) {
            // Proses pendaftaran user dengan data tambahan nomor hp dan email
            $result = tambahUser($username, $password, $role, $nomor_hp, $email);
    
            if ($result === true) {
            if ($role == 'penjual') {
                header("Location: index.php");
            }
    
            if ($role == 'pembeli') {
                header("Location: index.php");
            }
            
            $_SESSION['role'] = getRoleByUsername($username);
            exit();
        }
        } else {
            $passwordError = "Password dan verifikasi password tidak sama.";
        }
    } catch (\Throwable $th) {
        var_dump('ERRNO:', $th);
        die;
    }
    // Periksa apakah password dan verifikasi password sama
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            flex-direction: column;
        }

        form {
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input {
            margin-bottom: 10px;
        }

        .radio-group {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .radio-group label {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <h2>Register</h2>

    <?php
    if (isset($passwordError)) {
        echo "<p style='color: red;'>$passwordError</p>";
    }
    ?>

    <form action="register.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <label for="password_verify">Verifikasi Password:</label>
        <input type="password" id="password_verify" name="password_verify" required><br>

        <label for="nomor_hp">Nomor HP:</label>
        <input type="text" id="nomor_hp" name="nomor_hp" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label>Role:</label>
        <div class="radio-group">
            <label for="penjual">
                <input type="radio" id="penjual" name="role" value="penjual" required>
                Penjual
            </label>

            <label for="pembeli">
                <input type="radio" id="pembeli" name="role" value="pembeli" required>
                Pembeli
            </label>
        </div>

        <button type="submit">Register</button>
    </form>
</body>
</html>
