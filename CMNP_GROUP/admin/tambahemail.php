<h2>ADD EMAIL</h2>

<form method="post">
	<div class="form-group">
		<label>EMAIL</label>
		<input type="text" name="email">
	</div>
	<button class="btn btn-primary" name="tambah">ADD EMAIL</button>
</form>
<?php 
if (isset($_POST['tambah'])) {
    $kategori = $_POST["email"];

    // Ambil ID terakhir
    $stmt = $koneksi->query("SELECT MAX(ID_EMAIL) AS ID FROM SBO_CMNP_KK.EMAIL_SAP");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $nextId = $row['ID'] + 1;

    // Insert manual dengan ID
    $query = "INSERT INTO SBO_CMNP_KK.EMAIL_SAP (ID_EMAIL, NM_EMAIL) VALUES (?, ?)";
    $stmt = $koneksi->prepare($query);
    $stmt->execute([$nextId, $kategori]);

    echo "<script>alert('DIFFICULTY LEVEL HAS BEEN INCREASED');</script>";
    echo "<script>location='index.php?halaman=kategori';</script>";
}


?>
	