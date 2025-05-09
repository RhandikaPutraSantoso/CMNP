<h2>ADD Company</h2>

<form method="post">
	<div class="form-group">
		<label>EMAIL</label>
		<input type="text" name="company">
	</div>
	<button class="btn btn-primary" name="tambah">ADD Company</button>
</form>
<?php 
if (isset($_POST['tambah'])) {
    $kategori = $_POST["company"];

    // Ambil ID terakhir
    $stmt = $koneksi->query("SELECT MAX(ID_COMPANY) AS ID FROM SBO_CMNP_KK.COMPANY_SAP");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $nextId = $row['ID'] + 1;

    // Insert manual dengan ID
    $query = "INSERT INTO SBO_CMNP_KK.COMPANY_SAP (ID_COMPANY, NM_COMPANY) VALUES (?, ?)";
    $stmt = $koneksi->prepare($query);
    $stmt->execute([$nextId, $kategori]);

    echo "<script>alert('COMPANY HAS BEEN INCREASED');</script>";
    echo "<script>location='index.php?halaman=kategori';</script>";
}


?>
	