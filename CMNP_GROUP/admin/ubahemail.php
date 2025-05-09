<h2>CHANGE DIFFICULTY LEVEL</h2>
<?php 
$ambil = $koneksi->query("SELECT * FROM SBO_CMNP_KK.EMAIL_SAP WHERE ID_EMAIL='$_GET[id]'");
$pecah = $ambil->fetch(PDO::FETCH_ASSOC);

// echo "<pre>";
// print_r($pecah);
// echo "</pre>";

?>
<form method="post">
	<div class="form-group">
		<label>Nama Kategori</label>
		<input type="text" name="email" value=" <?php echo $pecah['NM_EMAIL'];?>">
	</div>
	<button class="btn btn-primary" name="ubah">CHANGE DIFFICULTY LEVEL</button>
</form>

<?php 
if (isset($_POST['ubah']))
{
	$koneksi->query("UPDATE SBO_CMNP_KK.EMAIL_SAP SET NM_EMAIL='$_POST[email]' WHERE ID_EMAIL='$_GET[id]'");
	echo "<script>alert('kategori sudah diubah');</script>";
	echo "<script>location='index.php?halaman=kategori';</script>";


}



?>
	

