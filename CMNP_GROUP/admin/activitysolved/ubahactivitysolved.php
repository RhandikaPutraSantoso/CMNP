<?php
// Koneksi ke database
date_default_timezone_set('Asia/Jakarta'); // Atur zona waktu ke Jakarta (WIB)
			// Cek dan hapus foto jika diminta
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

			// Ambil data activity dan foto
				$ambil = $koneksi->query("SELECT * FROM SBO_CMNP_KK.ACTIVITY WHERE ID_ACTIVITY='$_GET[id]'");
				$pecah = $ambil->fetch(PDO::FETCH_ASSOC);
				$ambil_foto = $koneksi->query("SELECT * FROM SBO_CMNP_KK.ACTIVITY_FOTO WHERE ID_ACTIVITY='$_GET[id]'");
				$daftar_foto = $ambil_foto->fetchAll(PDO::FETCH_ASSOC);

				$datastatus = array();
				$ambil = $koneksi->query("SELECT * FROM SBO_CMNP_KK.STATUS_LEVEL");
				while ($tiap = $ambil->fetch(PDO::FETCH_ASSOC)) {
				$datastatus[] = $tiap;
			}
				$datacompany = $koneksi->query("SELECT * FROM SBO_CMNP_KK.COMPANY_SAP")->fetchAll(PDO::FETCH_ASSOC);
			?>

			<h2>CHANGE ACTIVITY SOLVED</h2>
			<form method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label>Nama Company</label>
				<select class="form-control" name="company">
					<option value="">Pilih Company</option>
					<?php foreach ($datacompany as $value): ?>
						<option value="<?= $value["ID_COMPANY"] ?>" <?= $pecah["ID_COMPANY"] == $value["ID_COMPANY"] ? "selected" : "" ?>>
							<?= htmlspecialchars($value["NM_COMPANY"]) ?>
						</option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="form-group">
			<label>Email Company</label>
			<input type="text" class="form-control" name="email" value="<?php echo $pecah['MAIL_COMPANY']; ?>">
			</div>
			<div class="form-group">
			<label>Nama User</label>
			<input type="text" class="form-control" name="username" value="<?php echo $pecah['NM_USER']; ?>">
			</div>
			<div class="form-group">
			<label>Subject</label>
			<input type="text" class="form-control" name="Subject" value="<?php echo $pecah['SUBJECT']; ?>">
			</div>

			<div class="form-group">
			<label>Foto Saat Ini</label><br>
			<?php foreach ($daftar_foto as $foto): ?>
				<div style="display: inline-block; margin-right: 10px; position: relative;">
					<img src="../foto_produk/<?php echo htmlspecialchars($foto['NM_ACTIVITY_FOTO']); ?>" width="100" style="border: 1px solid #ddd; border-radius: 4px;">
					<a href="index.php?halaman=ubahproduk&id=<?php echo $_GET['id']; ?>&hapus_foto=<?php echo $foto['ID_ACTIVITY_FOTO']; ?>" onclick="return confirm('Hapus foto ini?');" style="position: absolute; top: 0; right: 0; background: red; color: white; padding: 2px 5px; font-size: 12px; border-radius: 0 4px 0 4px;">X</a>
				</div>
			<?php endforeach; ?>
			</div>

			<div class="form-group">
			<label>Tambah Foto Baru</label>
			<input type="file" class="form-control" name="foto_baru[]" multiple>
			<small class="form-text text-muted">Anda dapat memilih beberapa foto.</small>
			</div>

			<div class="form-group">
			<label>Deskripsi Solved</label>
			<textarea name="deskripsi" class="form-control" id="deskripsi" rows="10"><?php echo $pecah['DESKRIPSI_SOLVED']; ?></textarea>
			</div>

			<div class="form-group">
			<label>Status</label>
			<select class="form-control" name="ID_STATUS">
				<option value="">Pilih Status</option>
				<?php foreach ($datastatus as $value): ?>
					<option value="<?php echo $value["ID_STATUS"] ?>" <?php if ($pecah["ID_STATUS"] == $value["ID_STATUS"]) echo "selected"; ?>>
						<?php echo $value["NM_STATUS"] ?>
					</option>
				<?php endforeach; ?>
			</select>
			</div>

			<button class="btn btn-primary" name="ubah">Ubah</button>
			</form>

			<script>
			CKEDITOR.replace('deskripsi');
			</script>

			<?php
			if (isset($_POST['ubah'])) {
			$ambil_foto_lama = $koneksi->query("SELECT TOP 1 NM_ACTIVITY_FOTO FROM SBO_CMNP_KK.ACTIVITY_FOTO WHERE ID_ACTIVITY='$_GET[id]'");
			$foto_lama = $ambil_foto_lama->fetch(PDO::FETCH_ASSOC);
			$id_activity_foto = isset($foto_lama['NM_ACTIVITY_FOTO']) ? $foto_lama['NM_ACTIVITY_FOTO'] : '';
			$TGL_SOLVED = date("Y-m-d H:i:s");
			// Cek apakah ada foto baru yang diunggah
			$namafoto = $_FILES['foto']['name'] ?? '';
			$lokasifoto = $_FILES['foto']['tmp_name'] ?? '';
			if (!empty($lokasifoto)) {
			move_uploaded_file($lokasifoto, "../foto_produk/$namafoto");
			$id_activity_foto = $namafoto;
			}

			$koneksi->query("UPDATE SBO_CMNP_KK.ACTIVITY SET
			ID_COMPANY='$_POST[company]',
			MAIL_COMPANY='$_POST[email]',
			NM_USER='$_POST[username]',
			SUBJECT='$_POST[Subject]',
			ID_ACTIVITY_FOTO='$id_activity_foto',
			DESKRIPSI_SOLVED='$_POST[deskripsi]',
			ID_STATUS='$_POST[ID_STATUS]',TGL_SOLVED='$TGL_SOLVED'
			WHERE ID_ACTIVITY='$_GET[id]'");

			if (isset($_FILES['foto_baru']) && !empty($_FILES['foto_baru']['name'][0])) {
			$jumlah_foto = count($_FILES['foto_baru']['name']);
			for ($i = 0; $i < $jumlah_foto; $i++) {
				$namafoto = $_FILES['foto_baru']['name'][$i];
				$lokasifoto = $_FILES['foto_baru']['tmp_name'][$i];
				$target_file = "../foto_produk/" ;

				

				if (move_uploaded_file($lokasifoto, $target_file)) {
					// Ambil ID_ACTIVITY_FOTO terakhir
					$stmt_max_id = $koneksi->query("SELECT MAX(ID_ACTIVITY_FOTO) AS ID FROM SBO_CMNP_KK.ACTIVITY_FOTO");
					$row_max = $stmt_max_id->fetch(PDO::FETCH_ASSOC);
					$next_id_foto = $row_max['ID'] + 1;

					$stmt_insert_foto = $koneksi->prepare("INSERT INTO SBO_CMNP_KK.ACTIVITY_FOTO (ID_ACTIVITY_FOTO, ID_ACTIVITY, NM_ACTIVITY_FOTO) VALUES (?, ?, ?)");
					$stmt_insert_foto->execute([$next_id_foto, $_GET['id']]);
				} else {
					echo "<script>alert('Gagal mengunggah salah satu foto baru.');</script>";
				}
			}
			}

			echo "<script>alert('Data aktivitas telah diubah.');</script>";
			echo "<script>location='index.php?halaman=activitysolved';</script>";
			}
			?>
			<?