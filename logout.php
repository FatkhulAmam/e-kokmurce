<?php
session_start();

// Hapus semua data sesi
session_unset();

// Hancurkan sesi
session_destroy();

// Redirect ke halaman home atau halaman lain yang sesuai
header("Location: index.php");
exit();
?>
