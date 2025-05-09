<?php
// Memulai sesi
session_start();

// Menghapus semua data sesi yang aktif (logout)
session_destroy();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Logout</title>
  <link rel="shortcut icon" href="assets/foto_logo_perusahaan/favicon.ico" type="image/x-icon">
  <!-- Redirect otomatis ke login.php dalam 3 detik -->
  <meta http-equiv="refresh" content="4;url=login.php">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Link ke file CSS eksternal -->
  <link href="assets/css/logout.css" rel="stylesheet" />
</head>
<body>

  <!-- Spinner loading -->
  <div class="spinner"></div>

  <!-- Pesan logout -->
  <h2>Sedang keluar dari sistem...</h2>

  <!-- Efek animasi ketik -->
  <p class="typing">Mengalihkan ke halaman login...</p>

</body>
</html>
