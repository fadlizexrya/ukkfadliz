<?php
include "header.php";
include "navbar.php";
?>
<br>
<div class="card" style="background-color: #b0fff4">
	<div class="card-body" style="background-color: black">
		<div class="row">
			<div class="col-sm-4"> 
				<div class="card" style="background-color: #ff00e9"> 
					<div class="card-body" style="background-color: black"> 
						<b style="color: #ff00e9">Data Barang</b>
						<?php
						include '../koneksi.php';
						$data_produk = mysqli_query($koneksi,"SELECT * FROM produk");
						$jumlah_produk = mysqli_num_rows($data_produk);
						?>
						<h3 style="color: white"><?php echo $jumlah_produk; ?></h3>
						<a href="data_barang.php" class="btn btn-outline-primary btn-sm">Detail</a>
					</div>
				</div>
			</div>
			<div class="col-sm-4"> 
				<div class="card" style="background-color: #ff7700"> 
					<div class="card-body" style="background-color: black"> 
						<b style="color: #ff7700">Data Pembelian</b>
						<?php
						include '../koneksi.php';
						$data_penjualan = mysqli_query($koneksi,"SELECT * FROM penjualan");
						$jumlah_penjualan = mysqli_num_rows($data_penjualan);
						?>
						<h3 style="color: white"><?php echo $jumlah_penjualan; ?></h3>
						<a href="pembelian.php" class="btn btn-outline-primary btn-sm">Detail</a>
					</div>
				</div>
			</div>
			<div class="col-sm-4"> 
				<div class="card" style="background-color: #00ff98"> 
					<div class="card-body" style="background-color: black"> 
						<b style="color: #00ff98">Data Pengguna</b>
						<?php
						include '../koneksi.php';
						$data_petugas = mysqli_query($koneksi,"SELECT * FROM petugas");
						$jumlah_petugas = mysqli_num_rows($data_petugas);
						?>
						<h3 style="color: white"><?php echo $jumlah_petugas; ?></h3>
						<a href="data_pengguna.php" class="btn btn-outline-primary btn-sm">Detail</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="card mt-2" style="background-color: black">
	<div class="card-body text-center">
			<p style="color: #ffff">Selamat Datang dihalaman administrator, silahkan anda bisa mengakses beberapa fitur</p>
	</div>
</div>
<?php
include "footer.php";
?>
