<h3>Difficulty level</h3>	
<hr>

<table class="table table-bordered" style="width:100%">
	<thead>
		<tr>
			<th>No</th>
			<th>Difficulty level</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1;?>

		<?php $ambil= $koneksi->query("SELECT * FROM SBO_CMNP_KK.KATEGORI");?>
		<?php while($pecah=$ambil->fetch(PDO::FETCH_ASSOC)){?>
		<tr>
			<td><?php echo $nomor ?></td>
			<td><?php echo $pecah["NAMA_KATEGORI"] ?></td>
			<td>
				<a href="index.php?halaman=hapuskategori&id=<?php echo $pecah['ID_KATEGORI'];?>" class="btn btn-warning btn-sm">Hapus</a>
				<a href="index.php?halaman=ubahkategori&id=<?php echo $pecah['ID_KATEGORI'];?>" class="btn btn-danger btn-sm">Ubah</a>
			</td>

		</tr>
		<?php $nomor++;?>
		<?php }?>

	</tbody>

</table>
<a href="index.php?halaman=tambahkategori" class="btn btn-primary"> ADD DIFFICULTY LEVEL</a>

<br><br>
<br><br>

<h3>Status Level</h3>	
<hr>

<table class="table table-bordered" style="width:100%">
	<thead>
		<tr>
			<th>No</th>
			<th>Status Level</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1;?>

		<?php $ambil= $koneksi->query("SELECT * FROM SBO_CMNP_KK.STATUS_LEVEL");?>
		<?php while($pecah=$ambil->fetch(PDO::FETCH_ASSOC)){?>
		<tr>
			<td><?php echo $nomor ?></td>
			<td><?php echo $pecah["NM_STATUS"] ?></td>
			<td>
				<a href="index.php?halaman=hapusstatus&id=<?php echo $pecah['ID_STATUS'];?>" class="btn btn-warning btn-sm">Hapus</a>
				<a href="index.php?halaman=ubahstatus&id=<?php echo $pecah['ID_STATUS'];?>" class="btn btn-danger btn-sm">Ubah</a>
			</td>

		</tr>
		<?php $nomor++;?>
		<?php }?>

	</tbody>

</table>
<a href="index.php?halaman=tambahstatus" class="btn btn-primary"> ADD Status Level</a>

<br><br>
<br><br>

<h3>EMAIL</h3>	
<hr>

<table class="table table-bordered" style="width:100%">
	<thead>
		<tr>
			<th>No</th>
			<th>EMAIL</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1;?>

		<?php $ambil= $koneksi->query("SELECT * FROM SBO_CMNP_KK.EMAIL_SAP");?>
		<?php while($pecah=$ambil->fetch(PDO::FETCH_ASSOC)){?>
		<tr>
			<td><?php echo $nomor ?></td>
			<td><?php echo $pecah["NM_EMAIL"] ?></td>
			<td>
				<a href="index.php?halaman=hapusemail&id=<?php echo $pecah['ID_EMAIL'];?>" class="btn btn-warning btn-sm">Hapus</a>
				<a href="index.php?halaman=ubahemail&id=<?php echo $pecah['ID_EMAIL'];?>" class="btn btn-danger btn-sm">Ubah</a>
			</td>

		</tr>
		<?php $nomor++;?>
		<?php }?>

	</tbody>

</table>
<a href="index.php?halaman=tambahemail" class="btn btn-primary"> ADD Email</a>
<br><br>
<br><br>

<h3>COMPANY</h3>	
<hr>

<table class="table table-bordered" style="width:100%">
	<thead>
		<tr>
			<th>No</th>
			<th>COMPANY</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1;?>

		<?php $ambil= $koneksi->query("SELECT * FROM SBO_CMNP_KK.COMPANY_SAP");?>
		<?php while($pecah=$ambil->fetch(PDO::FETCH_ASSOC)){?>
		<tr>
			<td><?php echo $nomor ?></td>
			<td><?php echo $pecah["NM_COMPANY"] ?></td>
			<td>
				<a href="index.php?halaman=hapuscompany&id=<?php echo $pecah['ID_COMPANY'];?>" class="btn btn-warning btn-sm">Hapus</a>
				<a href="index.php?halaman=ubahcopany&id=<?php echo $pecah['ID_COMPANY'];?>" class="btn btn-danger btn-sm">Ubah</a>
			</td>

		</tr>
		<?php $nomor++;?>
		<?php }?>

	</tbody>

</table>
<a href="index.php?halaman=tambahcompany" class="btn btn-primary"> ADD Email</a>