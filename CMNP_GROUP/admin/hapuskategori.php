
<?php  
$koneksi->query("DELETE FROM SBO_CMNP_KK.KATEGORI WHERE ID_KATEGORI='$_GET[id]'");

echo "<script>alert('Kategori terhapus');</script>";
echo "<script>location='index.php?halaman=kategori';</script>";

?>