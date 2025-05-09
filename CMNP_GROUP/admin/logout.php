<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Logout</title>
  <link rel="shortcut icon" href="assets/foto_logo_perusahaan/favicon.ico" type="image/x-icon">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Link ke file CSS -->
  <link rel="stylesheet" href="assets/css/logout.css">
</head>
<body>

  <div class="spinner"></div>
  <h2>Sedang keluar dari sistem...</h2>
  <p class="typing">Mengalihkan ke halaman login...</p>

  <script>
    // Tambahkan efek transisi keluar sebelum redirect
    setTimeout(() => {
      document.body.classList.add('fade-out');
    }, 3500);

    // Arahkan ke login.php setelah transisi
    setTimeout(() => {
      window.location.href = "login.php";
    }, 4000);
  </script>

</body>
</html>
