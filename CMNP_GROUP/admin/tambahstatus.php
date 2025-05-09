<h2>ADD STATUS LEVEL</h2>

<form method="post">
	<div class="form-group">
		<label>STATUS LEVEL</label>
		<input type="text" name="status">
	</div>
	<button class="btn btn-primary" name="tambah">ADD STATUS LEVEL</button>
</form>
<?php 
if (isset($_POST['tambah'])) {
    $status = $_POST["status"];

    // Ambil ID terakhir
    $stmt = $koneksi->query("SELECT MAX(ID_STATUS) AS ID FROM SBO_CMNP_KK.STATUS_LEVEL");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $nextId = $row['ID'] + 1;

    // Insert manual dengan ID
    $query = "INSERT INTO SBO_CMNP_KK.STATUS_LEVEL (ID_STATUS, NM_STATUS) VALUES (?, ?)";
    $stmt = $koneksi->prepare($query);
    $stmt->execute([$nextId, $status]);

    echo "<script>alert('STATUS LEVEL HAS BEEN INCREASED');</script>";
    echo "<script>location='index.php?halaman=kategori';</script>";
}


?>
	