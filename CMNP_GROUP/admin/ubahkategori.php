<h2>CHANGE DIFFICULTY LEVEL</h2>
<?php 
$ambil = $koneksi->query("SELECT * FROM SBO_CMNP_KK.KATEGORI WHERE ID_KATEGORI='$_GET[id]'");
$pecah = $ambil->fetch(PDO::FETCH_ASSOC);

// echo "<pre>";
// print_r($pecah);
// echo "</pre>";

?>
<form method="post">
	<div class="form-group">
		<label>Nama Kategori</label>
		<input type="text" name="kategori" value=" <?php echo $pecah['NAMA_KATEGORI'];?>">
	</div>
	<button class="btn btn-primary" name="ubah">CHANGE DIFFICULTY LEVEL</button>
</form>

<?php 
if (isset($_POST['ubah']))
{
	$koneksi->query("UPDATE SBO_CMNP_KK.KATEGORI SET NAMA_KATEGORI='$_POST[kategori]' WHERE ID_KATEGORI='$_GET[id]'");
	echo "<script>alert('kategori sudah diubah');</script>";
	echo "<script>location='index.php?halaman=kategori';</script>";


}



?>
	

