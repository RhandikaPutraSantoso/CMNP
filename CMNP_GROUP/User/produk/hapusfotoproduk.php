<?php  

$id_foto=$_GET["idfoto"];
$id_produk=$_GET["idproduk"];

//ambil foto di folder
$ambilfoto=$koneksi->query("SELECT *FROM SBO_CMNP_KK.ACTIVITY_FOTO WHERE ID_ACTIVITY_FOTO='$id_foto'");
$detailfoto=$ambilfoto->fetch(PDO::FETCH_ASSOC);

$namafilefoto=$detailfoto["NM_ACTIVITY_FOTO"];

//hapus foto dr folder

unlink("../foto_produk/".$namafilefoto);

//hapus data di mysql
$koneksi->query("DELETE FROM SBO_CMNP_KK.ACTIVITY_FOTO WHERE ID_ACTIVITY_FOTO='$id_foto'");

echo "<script>alert('foto produk terhapus');</script>";
echo "<script>location='index.php?halaman=detailproduk&id=$id_produk';</script>";
?>