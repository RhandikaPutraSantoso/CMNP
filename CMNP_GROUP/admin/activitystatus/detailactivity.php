<?php  
$id_produk = isset($_GET['id']) ? intval($_GET['id']) : 0;

$ambil=$koneksi->query("SELECT 
    ACTIVITY.*, 
    STATUS_LEVEL.NM_STATUS, 
    COMPANY_SAP.NM_COMPANY 
FROM SBO_CMNP_KK.ACTIVITY  LEFT JOIN SBO_CMNP_KK.STATUS_LEVEL ON ACTIVITY.ID_STATUS=STATUS_LEVEL.ID_STATUS LEFT JOIN SBO_CMNP_KK.COMPANY_SAP ON ACTIVITY.ID_COMPANY = COMPANY_SAP.ID_COMPANY 
WHERE ACTIVITY.ID_ACTIVITY='$id_produk'");

$detailproduk=$ambil->fetch(PDO::FETCH_ASSOC);

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
        <th>: <?php echo htmlspecialchars($detailproduk["TGL_STATUS"]); ?></th>
    </tr>
    <tr>
        <th>Status</th>
        <th>: <?php echo htmlspecialchars($detailproduk["NM_STATUS"]); ?></th>
    </tr>
</table>
<br>
<div class="row">
    <div class="col-md-12">
        <a href="index.php?halaman=activitystatus" class="btn btn-primary">Kembali</a>
    </div>
