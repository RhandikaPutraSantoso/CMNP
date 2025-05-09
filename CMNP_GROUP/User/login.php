<?php
session_start();
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>CMNP User Login</title>
  <link rel="shortcut icon" href="../assets/foto_logo_perusahaan/favicon.ico" type="image/x-icon">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="assets/css/bootstrap.css" rel="stylesheet" />
  <link href="assets/css/font-awesome.css" rel="stylesheet" />
  <link href="assets/css/login.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>
  <div class="login-container">
    <div class="login-box">
      <div class="login-header">
        <img src="assets/foto_logo_perusahaan/cmnp2.png" alt="CMNP Logo" />
        <h2>User Login</h2>
        <p>Please enter your credentials</p>
      </div>

      <form method="post">
        <div class="form-group">
          <label><i class="fa fa-envelope"></i> Email</label>
          <input type="email" name="email" class="form-control" placeholder="Email Perusahaan" required />
        </div>

        <div class="form-group">
          <label><i class="fa fa-building"></i> Company</label>
          <input type="text" name="company" class="form-control" placeholder="Nama Perusahaan" required />
        </div>

        <div class="form-group">
          <label><i class="fa fa-user"></i> Username</label>
          <input type="text" name="username" class="form-control" placeholder="Username" required />
        </div>

        <div class="form-group">
          <label><i class="fa fa-lock"></i> Password</label>
          <input type="password" name="password" class="form-control" placeholder="Password" required />
        </div>

        <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
      </form>

      <?php
      if (isset($_POST['login'])) {
          $email = $_POST['email'];
          $company = $_POST['company'];
          $username = $_POST['username'];
          $password = $_POST['password'];

          $stmt = $koneksi->query("SELECT * FROM SBO_CMNP_KK.USER_SAP 
                                    WHERE EMAIL='$email' AND COMPANY='$company' 
                                    AND USERNAME='$username' AND PASSWORD='$password'");
          
          if ($stmt->rowCount() == 1) {
              $user = $stmt->fetch(PDO::FETCH_ASSOC);
              $_SESSION['employee'] = $user;
              $_SESSION['NM_USER'] = $user['USERNAME'];

              echo "<div class='alert alert-success mt-3 text-center'>Login Berhasil</div>";
              echo "<meta http-equiv='refresh' content='1;url=loading.php'>";
          } else {
              echo "<div class='alert alert-danger mt-3 text-center'>Login Gagal. Periksa kembali data Anda.</div>";
          }
      }
      ?>
    </div>
  </div>

  <script src="assets/js/jquery-1.10.2.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
