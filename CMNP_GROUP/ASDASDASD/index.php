<style type="text/css">
.share{
position: fixed;
height: 45px;
width: 42px;
left: 1px;
bottom: 300px;
z-index: 9999;
}
</style>
<?php 
 session_start(); 
include 'koneksi.php';
?>
<?php
$datakategori=array();
$ambil= $koneksi->query("SELECT * FROM kategori");
while($tiap=$ambil->fetch_assoc())
{
	$datakategori[]=$tiap;
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Dtech</title>
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="shortcut icon" href="tema/LogoDtech.jpg">
</head>
<style type="text/css">
	body{
		background: center / contain no-repeat url("admin/assets/media/examples/firefox-logo.svg"),
            #eee 35% url("tema/backgroundIndex.jpg");
	}
	.col-md-3{
		position: relative;
		margin:0 auto;
		overflow: hidden;
	}
	.tumbnail{
		position: absolute;
		top: 0;
		left: 0;
	}
	.thumbnail img{
		padding: 10px;
		-webkit-transition:0.4 ease;
		transition: 0.4 ease;
	}
	.col-md-3:hover .thumbnail img{
		-webkit-transform:scale(1.36);
		transform: scale(1.36);
	}
	h4{
		text-align: center;
		font-size: 28px;
		color: #0C090A;
		background-color: #357EC7;
		margin-bottom: 70px;
		margin-top: 30px;
	}
</style>
<body>

<section class="konten">
	<?php include 'menu.php'; ?><br><br><br>
	 <?php include 'buttonup.php'; ?>
	<div class="container"><br>
	<h1>WELCOME TO Dtech Official</h1>
    
        
		<?php include 'slider.php'; ?><br>
	
		
		<h1>Kegiatan Dtech</h1>
        <!-- foto TOKO -->
		<table>
		<tr>
		<td><img src="tema/BackgroundToko1.jpg" alt="Deskripsi Gambar" title="Deskripsi Gambar"> </td>
		<td><img src="tema/BackgroundToko2.jpg" alt="Deskripsi Gambar" title="Deskripsi Gambar"> </td>
		<td><img src="tema/BackgroundToko3.jpg" alt="Deskripsi Gambar" title="Deskripsi Gambar"> </td>
	</tr>
		</table>

		<h1>Tentang Dtech</h1>
        <h4>
		Dtech adalah sebuah toko yang mengkhususkan diri dalam penjualan dan pemasangan sistem pendingin udara (AC). Toko ini menawarkan berbagai jenis dan merek AC, mulai dari unit-unit untuk keperluan rumah tangga hingga sistem pendingin udara untuk gedung komersial dan industri. Berdiri sejak 2019 dengan tujuan untuk melayani pelanggan dengan terhormat.<br>-----------------------------------<br>Mulailah belanja dengan melihat kategori yang tersedia.</h4>

		<form action="pencarian.php" method="get" class="navbar-form navbar-right">
			<input type="text" class="form-control" name="keyword" placeholder="Cari Produk">
			<button class="btn btn-primary"><i class="fas fa-search"></i></button>
		</form>
		<form method="get" class="navbar-form navbar-right">
			<select class="form-control" name="kategori" onchange="document.location.href= this.options[this.selectedIndex].value;">
	 			<option value="">Pilih Kategori</option>
	 			<?php foreach ($datakategori as $key => $value): ?>
	 			<option value="kategori.php?id=<?php echo $value["id_kategori"] ?>" value="<?php echo $value["id_kategori"] ?>" ><?php echo $value["nama_kategori"] ?> </option>
	 			<?php endforeach ?>
 			</select>
		</form>
		<?php 

		if (empty($_SESSION['keranjang']) OR !isset($_SESSION["keranjang"])):?>
				
		<?php else: ?>
			<?php include 'modal.php'; ?><br>
		<?php endif ?>
		<?php include 'produk.php'; ?>

	    
	</div>
	<!-- Footer -->
	  <!-- <h1>berikan saran pengembangan</h1>
	  <?php include 'komentar.php'; ?> -->
	<?php include 'footer.php'; ?>
	
</section>

</body>
</html>