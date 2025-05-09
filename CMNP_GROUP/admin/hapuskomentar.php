<?php  
$koneksi->query("DELETE FROM komentar WHERE id_komentar='$_GET[id]'");

echo "<script>alert('Komentar terhapus');</script>";
echo "<script>location='index.php?halaman=komentar';</script>";

?>
