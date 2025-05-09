
<h2>ACTIVITY STATUS FOR SAP</h2>

<div class="table-responsive">
    <table class="table table-bordered" id="table">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Tiket</th>
                <th>Company</th>
                <th>Email</th>
                <th>Username</th>
                <th>Subject</th>
                <th>Foto</th>
                <th>Deskripsi</th>
                <th>Tanggal Proses</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php 
            $nomor = 1;
            $ambil = $koneksi->query("SELECT
            ACTIVITY.*,
            STATUS_LEVEL.NM_STATUS,
            COMPANY_SAP.NM_COMPANY 
            FROM SBO_CMNP_KK.ACTIVITY 
            LEFT JOIN SBO_CMNP_KK.STATUS_LEVEL ON ACTIVITY.ID_STATUS = STATUS_LEVEL.ID_STATUS 
            LEFT JOIN SBO_CMNP_KK.COMPANY_SAP ON ACTIVITY.ID_COMPANY = COMPANY_SAP.ID_COMPANY");
            
            while($pecah = $ambil->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <tr>
                <td><?php echo $nomor; ?></td>
                <td><?php echo htmlspecialchars($pecah['TIKET']); ?></td>
                <td><?php echo htmlspecialchars($pecah['NM_COMPANY']); ?></td>
                <td><?php echo htmlspecialchars($pecah['MAIL_COMPANY']); ?></td>
                <td><?php echo htmlspecialchars($pecah['NM_USER']); ?></td>
                <td><?php echo htmlspecialchars($pecah['SUBJECT']); ?></td>
                <td>
                    <?php
                    $id_activity = $pecah['ID_ACTIVITY'];
                    $ambil_foto = $koneksi->query("SELECT NM_ACTIVITY_FOTO FROM SBO_CMNP_KK.ACTIVITY_FOTO WHERE ID_ACTIVITY = '$id_activity' LIMIT 1");
                    $foto = $ambil_foto->fetch(PDO::FETCH_ASSOC);
                    if ($foto) {
                        echo '<img src="../foto_produk/' . htmlspecialchars($foto['NM_ACTIVITY_FOTO']) . '" width="100" class="img-fluid rounded">';
                    } else {
                        echo '<small class="text-muted">No image</small>';
                    }
                    ?>
                </td>
                <td><?php echo nl2br($pecah['DESKRIPSI']); ?></td>
                <td><?php echo  ($pecah['TGL_STATUS']); ?></td>
                <td><?php echo htmlspecialchars($pecah['NM_STATUS']); ?></td>
                <td>
                    <div class="btn-group" role="group">
                        <br><a href="index.php?halaman=ubahactivitystatus&id=<?php echo $pecah['ID_ACTIVITY']; ?>" class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-edit"></i> Ubah</a><br>
                        <br><a href="index.php?halaman=detailactivity&id=<?php echo $pecah['ID_ACTIVITY']; ?>" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-eye-open"></i> Detail</a><br>
                    </div>
                </td>
            </tr>
            <?php 
                $nomor++;
            } 
            ?>
        </tbody>
    </table>
</div>

<a href="index.php?halaman=tambahproduk" class="btn btn-primary mt-3">ADD ACTIVITY</a>
