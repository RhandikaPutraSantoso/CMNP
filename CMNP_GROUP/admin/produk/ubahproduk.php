<?php
date_default_timezone_set('Asia/Jakarta');

if (isset($_GET['hapus_foto'])) {
    $id_foto = $_GET['hapus_foto'];
    $ambil = $koneksi->query("SELECT NM_ACTIVITY_FOTO FROM SBO_CMNP_KK.ACTIVITY_FOTO WHERE ID_ACTIVITY_FOTO='$id_foto'");
    $foto = $ambil->fetch(PDO::FETCH_ASSOC);

    if ($foto) {
        $filePath = "../foto_produk/" . $foto['NM_ACTIVITY_FOTO'];
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        $koneksi->query("DELETE FROM SBO_CMNP_KK.ACTIVITY_FOTO WHERE ID_ACTIVITY_FOTO='$id_foto'");
    }

    echo "<script>location='index.php?halaman=ubahproduk&id={$_GET['id']}';</script>";
    exit;
}

// Ambil data activity dan relasi
$id_activity = $_GET['id'];
$ambil = $koneksi->query("SELECT * FROM SBO_CMNP_KK.ACTIVITY WHERE ID_ACTIVITY='$id_activity'");
$pecah = $ambil->fetch(PDO::FETCH_ASSOC);

$ambil_foto = $koneksi->query("SELECT * FROM SBO_CMNP_KK.ACTIVITY_FOTO WHERE ID_ACTIVITY='$id_activity'");
$daftar_foto = $ambil_foto->fetchAll(PDO::FETCH_ASSOC);

$datakategori = $koneksi->query("SELECT * FROM SBO_CMNP_KK.KATEGORI")->fetchAll(PDO::FETCH_ASSOC);
$datacompany = $koneksi->query("SELECT * FROM SBO_CMNP_KK.COMPANY_SAP")->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>CHANGE ACTIVITY</h2>
<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Nama Company (Jangan Sampai Salah)</label>
        <select class="form-control" name="company">
            <option value="">Pilih Company</option>
            <?php foreach ($datacompany as $value): ?>
                <option value="<?= htmlspecialchars($value["ID_COMPANY"]) ?>" <?= $pecah["ID_COMPANY"] == $value["ID_COMPANY"] ? "selected" : "" ?>>
                    <?= htmlspecialchars($value["NM_COMPANY"]) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label>Email Company</label>
        <input type="text" class="form-control" name="email" value="<?= htmlspecialchars($pecah['MAIL_COMPANY']) ?>">
    </div>

    <div class="form-group">
        <label>Nama User</label>
        <input type="text" class="form-control" name="username" value="<?= htmlspecialchars($pecah['NM_USER']) ?>">
    </div>

    <div class="form-group">
        <label>Subject</label>
        <input type="text" class="form-control" name="subject" value="<?= htmlspecialchars($pecah['SUBJECT']) ?>">
    </div>

    <div class="form-group">
        <label>Foto Saat Ini</label><br>
        <?php foreach ($daftar_foto as $foto): ?>
            <div style="display: inline-block; margin-right: 10px; position: relative;">
                <img src="../foto_produk/<?= htmlspecialchars($foto['NM_ACTIVITY_FOTO']) ?>" width="100" style="border: 1px solid #ddd; border-radius: 4px;">
                <a href="index.php?halaman=ubahproduk&id=<?= $id_activity ?>&hapus_foto=<?= $foto['ID_ACTIVITY_FOTO'] ?>" onclick="return confirm('Hapus foto ini?');" style="position: absolute; top: 0; right: 0; background: red; color: white; padding: 2px 5px; font-size: 12px; border-radius: 0 4px 0 4px;">X</a>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="form-group">
        <label>Tambah Foto Baru</label>
        <input type="file" class="form-control" name="foto_baru[]" multiple>
        <small class="form-text text-muted">Anda dapat memilih beberapa foto.</small>
    </div>

    <div class="form-group">
        <label>Deskripsi</label>
        <textarea name="deskripsi" class="form-control" id="deskripsi" rows="10"><?= htmlspecialchars($pecah['DESKRIPSI']) ?></textarea>
    </div>

    <div class="form-group">
        <label>Komentar</label>
        <textarea name="komentar" class="form-control" id="komentar" rows="10"><?= htmlspecialchars($pecah['KOMENTAR']) ?></textarea>
    </div>

    <div class="form-group">
        <label>Nama Kategori</label>
        <select class="form-control" name="ID_KATEGORI">
            <option value="">Pilih Kategori</option>
            <?php foreach ($datakategori as $value): ?>
                <option value="<?= htmlspecialchars($value["ID_KATEGORI"]) ?>" <?= $pecah["ID_KATEGORI"] == $value["ID_KATEGORI"] ? "selected" : "" ?>>
                    <?= htmlspecialchars($value["NAMA_KATEGORI"]) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <button class="btn btn-primary" name="ubah">Ubah</button>
</form>

<script>CKEDITOR.replace('deskripsi');</script>

<?php
if (isset($_POST['ubah'])) {
    $TGL_KOMENTAR = date("Y-m-d H:i:s");
    // Validasi form input
    $stmt = $koneksi->prepare("
        UPDATE SBO_CMNP_KK.ACTIVITY SET
            ID_COMPANY = ?, 
            MAIL_COMPANY = ?, 
            NM_USER = ?, 
            SUBJECT = ?, 
            DESKRIPSI = ?,
            KOMENTAR = ?,
            ID_KATEGORI = ?,
            TGL_KOMENTAR = ?
        WHERE ID_ACTIVITY = ?
    ");

    $stmt->execute([
        $_POST['company'],
        $_POST['email'],
        $_POST['username'],
        $_POST['subject'],
        $_POST['deskripsi'],
        $_POST['komentar'],
        $_POST['ID_KATEGORI'],
        $TGL_KOMENTAR,
        $id_activity
    ]);

    // Upload foto baru jika ada
    if (!empty($_FILES['foto_baru']['name'][0])) {
        foreach ($_FILES['foto_baru']['name'] as $i => $nama) {
            $lokasi = $_FILES['foto_baru']['tmp_name'][$i];
            $namafoto_unik = date("YmdHis") . '_' . basename($nama);
            $target = "../foto_produk/" . $namafoto_unik;

            if (move_uploaded_file($lokasi, $target)) {
                $stmt_max_id = $koneksi->query("SELECT MAX(ID_ACTIVITY_FOTO) AS ID FROM SBO_CMNP_KK.ACTIVITY_FOTO");
                $row_max = $stmt_max_id->fetch(PDO::FETCH_ASSOC);
                $next_id = $row_max['ID'] + 1;

                $stmt_insert = $koneksi->prepare("INSERT INTO SBO_CMNP_KK.ACTIVITY_FOTO (ID_ACTIVITY_FOTO, ID_ACTIVITY, NM_ACTIVITY_FOTO) VALUES (?, ?, ?)");
                $stmt_insert->execute([$next_id, $id_activity, $namafoto_unik]);
            }
        }
    }


    echo "<script>location='index.php?halaman=produk';</script>";
}
?>
