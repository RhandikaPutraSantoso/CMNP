<?php include 'koneksi.php'; 
session_start(); 
?>
<?php include 'menu.php'; ?><br><br><br>

<html>
<head>
	<title>Jasa</title>
	<link rel="shortcut icon" href="tema/LogoDtech.jpg">
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<style>
	body{
		background: center / contain no-repeat ,
            #eee 35% url("tema/backgroundtemboks.jpg");
	}
	</style>
	<br>
	<br>
<body>

<table border="2" style="width: 75%; border-collapse: collapse; background-color: #d7e5ca; margin-left: auto; margin-right: auto; height: 50px;">
	<tbody>
		<tr border="2" style="width: 100%; border-collapse: collapse; background-color: #3081D0; margin-left: auto; margin-right: auto; height: 50px;">
			<td style="width: 49%; text-align: center; height: 26px;"><strong>JENIS LAYANAN</strong></td>
				<td style="width: 49%; text-align: center; height: 26px;"><strong>HARGA</strong></td></tr>
		<tr style="height: 48px;"><td style="width: 49%; height: 35px; text-align: center;"><span style="color: #000000;">Cuci AC 0.5 - 1 PK</span></td>
			<td style="width: 48%; height: 35px;text-align: center;"><span style="color: #000000;">Rp. 75.000,-</span></td></tr>
		<tr style="height: 48px;"><td style="width: 49%; height: 35px; text-align: center;"><span style="color: #000000;">Cuci AC 1.5 - 2 PK</span></td>
			<td style="width: 48%; height: 35px;text-align: center;"><span style="color: #000000;">Rp. 85.000,-</span></td></tr>
		<tr style="height: 48px;"><td style="width: 49%; height: 35px;text-align: center;"><span style="color: #000000;">Cuci AC Inverter 0,5 - 2 PK</span></td>
			<td style="width: 48%; height: 35px;text-align: center;"><span style="color: #000000;">Rp. 100.000,-</span></td></tr>
		<tr style="height: 48px;"><td style="width: 49%; height: 35px;text-align: center;"><span style="color: #000000;">Tambah Freon AC 0,5 - 1 PK</span></td>
			<td style="width: 48%; height: 35px;text-align: center;"><span style="color: #000000;">Rp. 200.000,-</span></td></tr>
		<tr style="height: 48px;"><td style="width: 49%; height: 35px;text-align: center;"><span style="color: #000000;">Tambah Freon AC 1,5 - 2 PK</span></td>
			<td style="width: 48%; height: 35px;text-align: center;"><span style="color: #000000;">Rp. 250.000,-</span></td></tr>
		<tr style="height: 48px;"><td style="width: 49%; height: 35px;text-align: center;"><span style="color: #000000;">Isi Freon AC 0,5 - 1 PK</span></td>
			<td style="width: 48%; height: 35px;text-align: center;"><span style="color: #000000;">Rp. 350.000,-</span></td></tr>
		<tr style="height: 48px;"><td style="width: 49%; height: 35px;text-align: center;"><span style="color: #000000;">Isi Freon AC 1,5 - 2 PK</span></td>
			<td style="width: 48%; height: 35px;text-align: center;"><span style="color: #000000;">Rp. 450.000,-</span></td></tr>
		<tr style="height: 48px;"><td style="width: 49%; height: 35px;text-align: center;"><span style="color: #000000;">Bongkar AC</span></td>
			<td style="width: 48%; height: 35px;text-align: center;"><span style="color: #000000;">Rp. 200.000,-</span></td></tr>
		<tr style="height: 48px;"><td style="width: 49%; height: 35px;text-align: center;"><span style="color: #000000;">Jasa Pasang AC 0,5 - 1 PK</span></td>
			<td style="width: 48%; height: 35px;text-align: center;"><span style="color: #000000;">Rp. 300.000,-</span></td></tr>
		<tr style="height: 48px;"><td style="width: 49%; height: 35px;text-align: center;"><span style="color: #000000;">Jasa Pasang AC 1,5 - 2 PK</span></td>
			<td style="width: 48%; height: 35px;text-align: center;"><span style="color: #000000;">Rp. 400.000,-</span></td></tr>
		<tr style="height: 48px;"><td style="width: 49%; height: 35px;text-align: center;"><span style="color: #000000;">Bongkar Pasang AC 0,5 - 1 PK</span></td>
			<td style="width: 48%; height: 35px;text-align: center;"><span style="color: #000000;">Rp. 450.000,-</span></td></tr>
		<tr style="height: 48px;"><td style="width: 49%; height: 35px;text-align: center;"><span style="color: #000000;">Bongkar Pasang AC 1,5 - 2 PK</span></td>
			<td style="width: 48%; height: 35px;text-align: center;"><span style="color: #000000;">Rp. 550.000,-</span></td></tr>
		<tr style="height: 48px;"><td style="width: 49%; height: 35px;text-align: center;"><span style="color: #000000;">Bobok Tembok</span></td>
			<td style="width: 48%; height: 35px;text-align: center;"><span style="color: #000000;">Rp. 150.000,-</span></td></tr>
		<tr style="height: 48px;"><td style="width: 49%; height: 35px;text-align: center;"><span style="color: #000000;">Ganti Capasitor</span></td>
			<td style="width: 48%; height: 35px;text-align: center;"><span style="color: #000000;">Rp. 350.000,- s/d Rp. 475.000,-</span></td></tr>
		<tr style="height: 48px;"><td style="width: 49%; height: 35px;text-align: center;"><span style="color: #000000;">Pengelasan</span></td>
			<td style="width: 48%; height: 35px;text-align: center;"><span style="color: #000000;">Rp. 175.000,-</span></td></tr>
		<tr style="height: 48px;"><td style="width: 49%; height: 35px;text-align: center;"><span style="color: #000000;">Flushing Evaporator</span></td>
			<td style="width: 48%; height: 35px;text-align: center;"><span style="color: #000000;">Rp. 275.000,-</span></td></tr>
		<tr style="height: 48px;"><td style="width: 49%; height: 35px;text-align: center;"><span style="color: #000000;">Vacuum AC</span></td>
			<td style="width: 48%; height: 35px;text-align: center;"><span style="color: #000000;">Rp. 250.000,-</span></td></tr>
		<tr style="height: 48px;"><td style="width: 49%; height: 35px;text-align: center;"><span style="color: #000000;">Vacuum &amp; Flushing AC</span></td>
			<td style="width: 48%; height: 35px;text-align: center;"><span style="color: #000000;">Rp. 475.000,-</span></td></tr>
		<tr style="height: 48px;"><td style="width: 49%; height: 35px;text-align: center;"><span style="color: #000000;">Pengecekan</span></td>
			<td style="width: 48%; height: 35px;text-align: center;"><span style="color: #000000;">Rp. 75.000,-</span></td></tr>
		<tr style="height: 48px;"><td style="width: 49%; height: 35px;text-align: center;"><span style="color: #000000;">Isi Oli AC</span></td>
			<td style="width: 48%; height: 35px;text-align: center;"><span style="color: #000000;">Rp. 375.000,- s/d Rp. 575.000,-</span></td></tr>
		<tr style="height: 48px;"><td style="width: 49%; height: 35px;text-align: center;"><span style="color: #000000;">Overhoul/Cuci besar 0,5-1pk</span></td>
			<td style="width: 48%; height: 35px;text-align: center;"><span style="color: #000000;">Rp. 375.000,-</span></td></tr>
		<tr style="height: 48px;"><td style="width: 49%; height: 35px;text-align: center;"><span style="color: #000000;">Overhoul/Cuci besar 1,5-2pk</span></td>
			<td style="width: 48%; height: 35px;text-align: center;"><span style="color: #000000;">Rp. 475.000,-</span></td></tr>
	</tbody>
</table>
<br>
<table style="width: 75%; border-collapse: collapse; background-color: #3081D0; margin-left: auto; margin-right: auto; height: auto;"><tbody>
	<tr style="height: 48px;"><td style="height: 48px; border: none !important; color: #ffffff;">
	<strong>*Catatan;</strong>
	<br><em>Untuk Jenis Bangunan Gedung, Pabrik, Apartemen, Kantor, Akan Dikenakan Biaya Tambahan Sebesar Rp 25.000,-</em>
	<br><em>Apabila Terjadi Pembatalan pekerjaan Setelah Teknisi Sampai di Lokasi Anda, Maka Anda Akan di Kenakan Biaya Kunjungan sebesar Rp 50.000,-</em>
	<br><em>Silahkan Chat WhatsApp Dibawah ini!!</em>
</td>
</tr>
</tbody>
</table>	
<br>
<div class="wa-button"style="width: 75%; margin-left: auto; margin-right: auto; height: auto;">
	<a onclick="return gtag_report_conversion('https://wa.me/6285964186645?text=Hallo....%20Dtech.com,%20saya%20mau%20service%20ac%20bagaimana%20caranya%20ya...?');" href="https://wa.me/6285964186645?text=Hallo....%20Dtech.com,%20saya%20mau%20service%20ac%20bagaimana%20caranya%20ya...?"> 
	<img src="tema/LogoWhatsApp.png" width="250px" alt="Chat Whatsapp">
	</a>
</div>

<?php include 'footer.php'; ?>
</body>
</html>