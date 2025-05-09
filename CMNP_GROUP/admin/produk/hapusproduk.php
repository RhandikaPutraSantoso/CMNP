<?php

$id_activity = $_GET['id'];

// 1. Ambil informasi produk (termasuk nama file foto utama, jika ada)
$ambil_activity = $koneksi->query("SELECT ID_ACTIVITY_FOTO FROM SBO_CMNP_KK.ACTIVITY WHERE ID_ACTIVITY='$id_activity'");
$pecah_activity = $ambil_activity->fetch(PDO::FETCH_ASSOC);
$foto_utama = $pecah_activity['ID_ACTIVITY_FOTO'] ?? null;

// 2. Hapus file foto utama (jika ada)
if ($foto_utama && file_exists("../foto_produk/" . $foto_utama)) {
    unlink("../foto_produk/" . $foto_utama);
}

// 3. Hapus semua record foto terkait dari tabel ACTIVITY_FOTO
$hapus_foto_tambahan = $koneksi->query("DELETE FROM SBO_CMNP_KK.ACTIVITY_FOTO WHERE ID_ACTIVITY='$id_activity'");

// 4. Hapus data produk utama dari tabel ACTIVITY
$hapus_activity = $koneksi->query("DELETE FROM SBO_CMNP_KK.ACTIVITY WHERE ID_ACTIVITY='$id_activity'");

if ($hapus_activity) {
    echo "<script>alert('Produk dan foto terkait telah terhapus.');</script>";
    echo "<script>location='index.php?halaman=produk';</script>";
} else {
    echo "<script>alert('Gagal menghapus produk.');</script>";
    echo "<script>location='index.php?halaman=produk';</script>";
    // Tambahkan logging error di sini untuk debugging lebih lanjut
}

?>