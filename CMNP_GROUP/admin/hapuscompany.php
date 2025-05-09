<?php  
$koneksi->query("DELETE FROM SBO_CMNP_KK.COMPANY_SAP WHERE ID_COMPANY='$_GET[id]'");

echo "<script>alert('Compay terhapus');</script>";
echo "<script>location='index.php?halaman=kategori';</script>";

?>