<h2>REQUESTS FOR SAP</h2>

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
                <th>Tanggal Terkirim</th>
                <th>Komentar</th>
                <th>Tanggal Komentar</th>
                <th>Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $nomor = 1;
            $ambil = $koneksi->query("
                SELECT 
                    ACTIVITY.*, 
                    KATEGORI.NAMA_KATEGORI, 
                    COMPANY_SAP.NM_COMPANY 
                FROM SBO_CMNP_KK.ACTIVITY 
                LEFT JOIN SBO_CMNP_KK.KATEGORI ON ACTIVITY.ID_KATEGORI = KATEGORI.ID_KATEGORI
                LEFT JOIN SBO_CMNP_KK.COMPANY_SAP ON ACTIVITY.ID_COMPANY = COMPANY_SAP.ID_COMPANY
            ");

            while($pecah = $ambil->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <tr>
                <td><?php echo $nomor++; ?></td>
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
                <td><?php echo htmlspecialchars($pecah['TGL_ACTIVITY']); ?></td>
                <td><?php echo nl2br($pecah['KOMENTAR']); ?></td>
                <td><?php echo htmlspecialchars($pecah['TGL_KOMENTAR']); ?></td>
                <td><?php echo htmlspecialchars($pecah['NAMA_KATEGORI']); ?></td>
                <td>
                    <div class="btn-group-vertical" role="group">
                        <a href="index.php?halaman=ubahproduk&id=<?php echo $pecah['ID_ACTIVITY']; ?>" class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-edit"></i> Ubah</a>
                        <a href="index.php?halaman=detailproduk&id=<?php echo $pecah['ID_ACTIVITY']; ?>" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-eye-open"></i> Detail</a>
                        <a href="index.php?halaman=hapusproduk&id=<?php echo $pecah['ID_ACTIVITY']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus?')"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
                        <?php
                        $id_activity = $pecah['ID_ACTIVITY'];
                        $ambil_foto = $koneksi->query("SELECT NM_ACTIVITY_FOTO FROM SBO_CMNP_KK.ACTIVITY_FOTO WHERE ID_ACTIVITY = '$id_activity' LIMIT 1");
                        $foto = $ambil_foto->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <a href="https://mail.google.com/mail/?view=cm&fs=1&to=rhndkputr@gmail.com&su=<?php echo urlencode($pecah['SUBJECT']); ?>&body=<?php echo urlencode (strip_tags($pecah['DESKRIPSI']) . "\n\nFoto: https://sap.cmnp.co.id/foto_produk/" . ($foto ? $foto['NM_ACTIVITY_FOTO'] : 'Tidak tersedia')); ?>" 
                        target="_blank" 
                        class="btn btn-success btn-sm">
                        <i class="glyphicon glyphicon-envelope"></i> Kirim Email
                        </a>

                    </div>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<a href="index.php?halaman=tambahproduk" class="btn btn-primary mt-3">ADD ACTIVITY</a>
