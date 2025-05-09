<style type="text/css">
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
		padding: 1px;
		transition: 0.5s ease;
		border: 1px solid #ddd;
		border-radius: 5px;
		margin-top: 12px;
		margin-bottom: 12px;
	}
	.col-md-3:hover .thumbnail img{
		-webkit-transform:scale(1.36);
		transform: scale(1.36);
	}

	h1{
		font-family: courier ;
		text-align: center;
		font-size: 38px;
		color: #333;
		margin-bottom: 20px;
		margin-top: 80px;
	}
	.caption {
		background-color: #252B48 ;
		padding: 10px;
		text-align: center;
	}
	
	.caption h5 {
		font-size: 16px;
		margin-bottom: 5px;
		color: #ffffff;
		
	}
</style>

<h3 style="color:white;background:#252B48;width:max-content;height:38px;padding:5px;">Sample Produk : </h3>

		<div class="row">
	 		<?php  $ambil=$koneksi->query("SELECT *FROM produk"); ?>
			<?php  WHILE($perproduk =$ambil->fetch_assoc()){?>
			<div class="col-md-3" style="margin:0px;">
				<div class="thumbnail" >
					
					<div class="caption" >
						<img src="foto_produk/<?php echo $perproduk['foto_produk'] ?>" width="100" alt="">
						<h5><?php echo $perproduk['nama_produk'] ?></h5>
						<h5>Rp <?php echo number_format($perproduk['harga_produk']) ?></h5>
						<a href="beli.php?id=<?php echo $perproduk['id_produk']; ?>" class="btn btn-primary btn-sm" ><i class="fa fa-shopping-cart fa-sm"></i> Beli</a>
						<a href="detail.php?id=<?php echo $perproduk['id_produk']; ?>" class="btn btn-default btn-sm"i><i class="fas fa-info-circle fa-sm"></i>Detail</a>

					</div>
				</div>
			</div>
			<?php } ?>

			




		</div>