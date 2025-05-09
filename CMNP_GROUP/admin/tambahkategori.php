<h2>ADD DIFFICULTY LEVEL</h2>

<form method="post">
	<div class="form-group">
		<label>DIFFICULTY LEVEL</label>
		<input type="text" name="kategori">
	</div>
	<button class="btn btn-primary" name="tambah">ADD DIFFICULTY LEVEL</button>
</form>
<?php 
if (isset($_POST['tambah'])) {
    $kategori = $_POST["kategori"];

    // Ambil ID terakhir
    $stmt = $koneksi->query("SELECT MAX(ID_KATEGORI) AS ID FROM SBO_CMNP_KK.KATEGORI");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $nextId = $row['ID'] + 1;

    // Insert manual dengan ID
    $query = "INSERT INTO SBO_CMNP_KK.KATEGORI (ID_KATEGORI, NAMA_KATEGORI) VALUES (?, ?)";
    $stmt = $koneksi->prepare($query);
    $stmt->execute([$nextId, $kategori]);

    echo "<script>alert('DIFFICULTY LEVEL HAS BEEN INCREASED');</script>";
    echo "<script>location='index.php?halaman=kategori';</script>";
}


?>
	