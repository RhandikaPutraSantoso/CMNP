
<?php  
$koneksi->query("DELETE FROM SBO_CMNP_KK.STATUS_LEVEL WHERE ID_STATUS='$_GET[id]'");

echo "<script>alert('status terhapus');</script>";
echo "<script>location='index.php?halaman=kategori';</script>";

?>