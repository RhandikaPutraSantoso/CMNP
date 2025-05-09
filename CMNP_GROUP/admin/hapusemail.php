
<?php  
$koneksi->query("DELETE FROM SBO_CMNP_KK.EMAIL_SAP WHERE ID_EMAIL='$_GET[id]'");

echo "<script>alert('Kategori terhapus');</script>";
echo "<script>location='index.php?halaman=kategori';</script>";

?>