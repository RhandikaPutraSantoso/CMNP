<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Loading...</title>
  <link rel="shortcut icon" href="assets/foto_logo_perusahaan/favicon.ico" type="image/x-icon">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Memanggil file CSS eksternal -->
  <link href="assets/css/loading.css" rel="stylesheet" />

</head>
<body>
  <div class="logo">
    <img src="assets/foto_logo_perusahaan/cmnp2.png" alt="CMNP Logo" />
  </div>

  <div class="loader">
    <span></span>
    <span></span>
    <span></span>
  </div>

  <div class="message">
    <p>Loading Admin Dashboard...</p>
    <p id="countdown">Redirecting in 3 seconds</p>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      let countdown = 4;
      const messageElement = document.getElementById("countdown");

      const interval = setInterval(function () {
        countdown--;
        if (countdown > 0) {
          messageElement.textContent = `Redirecting in ${countdown} second${countdown > 1 ? 's' : ''}`;
        } else {
          clearInterval(interval);
        }
      }, 1000);

      setTimeout(function () {
        window.location.href = "index.php";
      }, 4000);
    });
  </script>
</body>
</html>
