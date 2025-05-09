<h2>ADD ACTIVITY</h2>

<?php
$datacompany = array();
$ambilcompany = $koneksi->query("SELECT * FROM SBO_CMNP_KK.COMPANY_SAP");

while($tiapcompany = $ambilcompany->fetch(PDO::FETCH_ASSOC))
{
	$datacompany[] = $tiapcompany;
}
?>


<form method="post" enctype="multipart/form-data">

<div class="form-group">
	<label>Nama Company</label>
	<select class="form-control" name="company">
		<option value="">Pilih Company</option>
		<?php foreach ($datacompany as $key => $value): ?>
			<option value="<?php echo $value["ID_COMPANY"] ?>">
				<?php echo $value["NM_COMPANY"] ?>
			</option>
		<?php endforeach ?>
	</select>
</div>
	<div class="form-group">
		<label> Email Company</label>
		<input type="text" class="form-control" name="email">
	</div>
	<div class="form-group">
		<label> Nama User</label>
		<input type="text" class="form-control" name="username">
	</div>
	<div class="form-group">
		<label> Subject</label>
		<input type="text" class="form-control" name="Subject">
	</div>
	<div class="form-group">
		<label>Foto</label>
		<div class="letak-input" style="margin-bottom: 10px;">
			<input type="file" class="form-control" name="foto[]">
		</div>
		<span class="btn btn-primary btn-tambah">
			<i class="fa fa-plus"></i>
		</span>
	</div>
	<div class="form-group">
		<label>Deskripsi</label>
		<textarea class="form-control" name="deskripsi" id="deskripsi" rows="10"></textarea>
	<script>
                CKEDITOR.replace( 'deskripsi' );
        </script>
	</div>
	

	<button class ="btn btn-primary" name="save"><i class="glyphicon glyphicon-saved"></i>Simpan</a></button>

	
	
		
</form>
<?php
if (isset ($_POST['save']))
{
	$namanamafoto = $_FILES['foto']['name'];
	$lokasilokasifoto =$_FILES['foto']['tmp_name'];
	move_uploaded_file($lokasilokasifoto[0], "../foto_produk/".$namanamafoto[0]);
	date_default_timezone_set("Asia/Jakarta");
	$TGL_ACTIVITY=date("Y-m-d H:i:s");
	// Ambil ID terakhir
	$stmt = $koneksi->query("SELECT MAX(ID_ACTIVITY) AS ID FROM SBO_CMNP_KK.ACTIVITY");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $nextId = $row['ID'] + 1;

 // Menggunakan ID_ACTIVITY dan nama perusahaan untuk tiket
 $company_name = '';
 foreach ($datacompany as $company) {
	 if ($company["ID_COMPANY"] == $_POST['company']) {
		 $company_name = $company["NM_COMPANY"];
		 break;
	 }
 }
 $tiket = "TIKET-" . strtoupper($nextId)  . strtoupper(str_replace(" ", "_", $company_name));

	
	
	// Insert manual dengan ID
	$stmt = $koneksi->prepare("INSERT INTO SBO_CMNP_KK.ACTIVITY 
(ID_ACTIVITY, ID_COMPANY, MAIL_COMPANY, NM_USER, SUBJECT, DESKRIPSI, ID_ACTIVITY_FOTO, ID_KATEGORI, TGL_ACTIVITY, TIKET)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?,?)");

$stmt->execute([
    $nextId,
    $_POST['company'], // sekarang ID_COMPANY
    $_POST['email'],
    $_POST['username'],
    $_POST['Subject'],
    $_POST['deskripsi'],
    $namanamafoto[0],
    $_POST['ID_KATEGORI'],
    $TGL_ACTIVITY,
	$tiket
	
]);


	$id_produk_barusan = $nextId;

	foreach ($namanamafoto as $key => $tiap_nama) 
	{
		$tiap_lokasi =$lokasilokasifoto[$key];

		move_uploaded_file($tiap_lokasi, "../foto_produk/".$tiap_nama);
		// Simpan ke database
						$stmt = $koneksi->query("SELECT MAX(ID_ACTIVITY_FOTO) AS ID FROM SBO_CMNP_KK.ACTIVITY_FOTO");
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				$nextFotoId = $row['ID'] + 1;

				$koneksi->prepare("INSERT INTO SBO_CMNP_KK.ACTIVITY_FOTO(ID_ACTIVITY_FOTO, ID_ACTIVITY, NM_ACTIVITY_FOTO)
				VALUES (?, ?, ?)")->execute([
					$nextFotoId,
					$id_produk_barusan,
					$tiap_nama
				]);
				
				echo "<script>alert('Data berhasil disimpan');</script>";
				echo "<script>location='index.php?halaman=produk';</script>";
				exit();

	}

	// echo "<div class='alert alert-info'>Data Tersimpan</div>";
	// echo "<meta http-equiv='refresh' content='l;url=index.php?halaman=produk'>";
	
}
?>

<script>
	$(document).ready(function(){
		$(".btn-tambah").on("click",function(){
			$(".letak-input").append("<input type='file' class='form-control' name='foto[]'>");
			
		})
	})
	
</script>