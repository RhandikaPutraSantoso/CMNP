<?php  
$id_produk = isset($_GET['id']) ? intval($_GET['id']) : 0;

// 3. Ambil detail aktivitas dari tabel ACTIVITY
$query_detail = "
    SELECT 
        ACTIVITY.*, 
        KATEGORI.NAMA_KATEGORI, 
        COMPANY_SAP.NM_COMPANY 
    FROM SBO_CMNP_KK.ACTIVITY 
    LEFT JOIN SBO_CMNP_KK.KATEGORI ON ACTIVITY.ID_KATEGORI = KATEGORI.ID_KATEGORI
    LEFT JOIN SBO_CMNP_KK.COMPANY_SAP ON ACTIVITY.ID_COMPANY = COMPANY_SAP.ID_COMPANY
    WHERE ACTIVITY.ID_ACTIVITY = '$id_produk'
";
$ambil = $koneksi->query($query_detail);
$detailproduk = $ambil->fetch(PDO::FETCH_ASSOC);


$fotoproduk=array();
$ambilfoto=$koneksi->query("SELECT * FROM SBO_CMNP_KK.ACTIVITY_FOTO WHERE ID_ACTIVITY='$id_produk'");
while($tiap=$ambilfoto->fetch(PDO::FETCH_ASSOC)) {
    $fotoproduk[]=$tiap;
}
?>

<table class="table table-bordered">
    <tr>
        <th>Nama Company</th>
        <th>: <?php echo htmlspecialchars($detailproduk["NM_COMPANY"]); ?></th>
    </tr>
    <tr>
        <th>Email Company</th>
        <th>: <?php echo htmlspecialchars($detailproduk["MAIL_COMPANY"]); ?></th>
    </tr>
    <tr>
        <th>Nama User</th>
        <th>: <?php echo htmlspecialchars($detailproduk["NM_USER"]); ?></th>
    </tr>
    <tr>
        <th>Subject</th>
        <th>: <?php echo htmlspecialchars($detailproduk["SUBJECT"]); ?></th> 
    </tr>
    <tr>
        <th>Foto</th>
        <th>: 
            <?php foreach($fotoproduk as $key => $value): ?>
                <div style="margin-bottom:10px;">
                    <img src="../foto_produk/<?php echo htmlspecialchars($value["NM_ACTIVITY_FOTO"]); ?>" alt="" class="img-responsive" width="150">
                </div>
            <?php endforeach; ?>
        </th> 
    </tr>
    <tr>
        <th>Deskripsi</th>
        <th>: <?php echo nl2br(($detailproduk["DESKRIPSI"])); ?></th>
    </tr>
    <tr>
        <th>Tanggal</th>
        <th>: <?php echo htmlspecialchars($detailproduk["TGL_ACTIVITY"]); ?></th>
    </tr>
    <tr>
        <th>Komentar</th>
        <th>: <?php echo htmlspecialchars($detailproduk["KOMENTAR"]); ?></th>
    <tr>
        <th>Tanggal Komentar</th>
        <th>: <?php echo htmlspecialchars($detailproduk["TGL_KOMENTAR"]); ?></th>
    </tr>
        <th>Kategori</th>
        <th>: <?php echo htmlspecialchars($detailproduk["NAMA_KATEGORI"]); ?></th>
    </tr>
</table>

<a href="index.php?halaman=produk" class="btn btn-primary">Kembali</a>
