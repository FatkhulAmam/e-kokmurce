<?php
include 'koneksi.php';

// Fungsi untuk menambah user
function tambahUser($username, $password, $role, $nomor_hp, $email)
{
    global $conn;

    // Hash password menggunakan bcrypt
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Masukkan data ke dalam tabel users
    $query = "INSERT INTO user (username, password, role, nomor_hp, email) VALUES ('$username', '$hashedPassword', '$role', '$nomor_hp', '$email')";
    $result = mysqli_query($conn, $query);
    if ($result) {
        $_SESSION['username'] = $username;
        return true;
    }
    return false;
}

// Fungsi untuk melakukan login
function loginUser($username, $password)
{
    global $conn;
    $query = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $row['username'];
            return true;
        }
    }
    return false;
}

function getRoleByUsername($username)
{
    global $conn;

    // Gantilah kueri ini dengan yang sesuai
    $query = "SELECT role FROM user WHERE username = '$username'";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['role'];
    } else {
        return ''; // Kembalikan nilai default jika tidak ditemukan
    }
}
