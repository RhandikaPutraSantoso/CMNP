<?php
session_start();
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>CMNP Admin Login</title>
  <link rel="shortcut icon" href="assets/foto_logo_perusahaan/favicon.ico" type="image/x-icon">
  <link href="assets/css/bootstrap.css" rel="stylesheet" />
  <link href="assets/css/font-awesome.css" rel="stylesheet" />
  <link href="assets/css/custom.css" rel="stylesheet" />
  
  <!-- Memanggil file login.css -->
  <link href="assets/css/login.css" rel="stylesheet" />

  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>

  <div class="login-box">
    <h2>CMNP ADMIN LOGIN</h2>

    <form method="post">
      <div class="form-group input-group">
        <span class="input-group-addon"><i class="fa fa-user"></i></span>
        <input type="text" class="form-control" placeholder="Username" name="user" required />
      </div>

      <div class="form-group input-group">
        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
        <input type="password" class="form-control" placeholder="Password" name="pass" required />
      </div>

      <div class="form-group">
        <label class="checkbox-inline"><input type="checkbox" /> Remember me</label>
      </div>

      <button class="btn btn-primary" name="login">Login</button>
    </form>

    <?php
    if (isset($_POST['login'])) {
        $ambil = $koneksi->query("SELECT * FROM SBO_CMNP_KK.ADMIN_SAP WHERE USERNAME='$_POST[user]' AND PASSWORD='$_POST[pass]'");
        $yangcocok = $ambil->rowCount();

        if ($yangcocok == 1) {
            $_SESSION['admin'] = $ambil->fetch(PDO::FETCH_ASSOC);
            echo "<div class='alert alert-success'>Login Sukses</div>";
            echo "<meta http-equiv='refresh' content='1;url=loading.php'>";
        } else {
            echo "<div class='alert alert-danger'>Login Gagal</div>";
            echo "<meta http-equiv='refresh' content='1;url=login.php'>";
        }
    }
    ?>
  </div>

  <script src="assets/js/jquery-1.10.2.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/jquery.metisMenu.js"></script>
  <script src="assets/js/custom.js"></script>

</body>
</html>
