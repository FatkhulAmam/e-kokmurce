<?php
// Sertakan file user.php atau file lain yang berisi fungsi-fungsi yang diperlukan
include 'user.php';
session_start();

if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Inisialisasi variabel untuk pesan kesalahan
$usernameError = $passwordError = $loginError = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validasi input (contoh sederhana)
    if (empty($username)) {
        $usernameError = "Username tidak boleh kosong.";
    }

    if (empty($password)) {
        $passwordError = "Password tidak boleh kosong.";
    }

    try {
        // Jika tidak ada kesalahan validasi, coba lakukan login
        if (empty($usernameError) && empty($passwordError)) {
            // Fungsi login dapat didefinisikan di file user.php
            $result = loginUser($username, $password);

            if ($result === true) {
                if (isset($_SESSION['username'])) {
                    $_SESSION['role'] = getRoleByUsername($username);
                    header("Location: index.php");
                    exit();
                }
            } else {
                $loginError = "Login gagal. Silakan periksa username dan password.";
            }
        }
    } catch (\Throwable $th) {
        var_dump('ERRORNYA::', $th);
        die;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

        button {
            margin-top: 10px;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>
    <h2>Login</h2>

    <?php
    if (!empty($loginError)) {
        echo "<p class='error'>$loginError</p>";
    }
    ?>

    <form action="login.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <p class="error"><?php echo $usernameError; ?></p>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <p class="error"><?php echo $passwordError; ?></p>

        <button type="submit">Login</button>
    </form>
</body>

</html>