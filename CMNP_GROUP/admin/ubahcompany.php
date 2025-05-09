<h2>CHANGE COMPANY</h2>
<?php 
$ambil = $koneksi->query("SELECT * FROM SBO_CMNP_KK.COMPANY_SAP WHERE ID_COMPANY='$_GET[id]'");
$pecah = $ambil->fetch(PDO::FETCH_ASSOC);

// echo "<pre>";
// print_r($pecah);
// echo "</pre>";

?>
<form method="post">
	<div class="form-group">
		<label>Nama Company</label>
		<input type="text" name="company" value=" <?php echo $pecah['NM_COMPANY'];?>">
	</div>
	<button class="btn btn-primary" name="ubah">CHANGE DIFFICULTY LEVEL</button>
</form>

<?php 
if (isset($_POST['ubah']))
{
	$koneksi->query("UPDATE SBO_CMNP_KK.COMPANY_SAP SET NM_COMPANY='$_POST[company]' WHERE ID_COMPANY='$_GET[id]'");
	echo "<script>alert('Company sudah diubah');</script>";
	echo "<script>location='index.php?halaman=kategori';</script>";


}



?>
	

