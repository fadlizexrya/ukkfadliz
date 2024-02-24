<?php
include "header.php";
include "navbar.php";
?>
<br>
<div class="card" style="background-color: #ff7700">
	<div class="card-body" style="background-color: black">
		<?php 
			if(isset($_GET['pesan'])){
				if($_GET['pesan']=="simpan"){?>
					<div class="alert alert-success" style="background-color: black" role="alert">
						<a style="color: #25fa84">Data Tersimpan!</a>
					</div>  
				<?php } ?>
				<?php if($_GET['pesan']=="update"){?>
					<div class="alert alert-primary" style="background-color: black" role="alert">
						<a style="color: #25cdfa">Data DiUpdate!</a>
					</div>  
				<?php } ?>
				<?php if($_GET['pesan']=="hapus"){?>
					<div class="alert alert-danger" style="background-color: black" role="alert">
						<a style="color: #fa2555">Data DiHapus!</a>
					</div>  
				<?php } 
			}
			?>
        <button type="button" class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#tambah-data">
            Tambah Data
        </button>
	</div>
	<div class="card-body" style="background-color: black">
		<table class="table">
			<thead>
				<tr>
					<th style="background-color: black"><a style="color: #ff7700">No</a></th>
					<th style="background-color: black"><a style="color: #ff7700">ID Pelanggan</a></th>
					<th style="background-color: black"><a style="color: #ff7700">Nama Pelanggan</a></th>
					<th style="background-color: black"><a style="color: #ff7700">Alamat</a></th>
					<th style="background-color: black"><a style="color: #ff7700">NoTelepon</a></th>
					<th style="background-color: black"><a style="color: #ff7700">Total Pembayaran</a></th>
					<th style="background-color: black"><a style="color: #ff7700">Aksi</a></th>
				</tr>
			</thead>
			<tbody>
				<?php 
                    include '../koneksi.php';
                    $no = 1;
                    $data = mysqli_query($koneksi,"SELECT * FROM pelanggan INNER JOIN penjualan ON pelanggan.PelangganID=penjualan.PelangganID");
                    while($d = mysqli_fetch_array($data)){
                ?>
					<tr>
						<td style="background-color: black"><a style="color: #ff7700"><?php echo $no++; ?></td>
						<td style="background-color: black"><a style="color: #ff7700"><?php echo $d['PelangganID']; ?></td>
						<td style="background-color: black"><a style="color: #ff7700"><?php echo $d['NamaPelanggan']; ?></td>
						<td style="background-color: black"><a style="color: #ff7700"><?php echo $d['Alamat']; ?></td>
						<td style="background-color: black"><a style="color: #ff7700"><?php echo $d['NoTelepon']; ?></td>
						<td style="background-color: black"><a style="color: #ff7700">Rp. <?php echo $d['TotalHarga']; ?></td>
						<td style="background-color: black"><a style="color: #ff7700">
							<a class="btn btn-outline-primary btn-sm" href="detail_pembelian.php?PelangganID=<?php echo $d['PelangganID']; ?>">Detail</a>
							<button type="button" class="btn btn-outline-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit-data<?php echo $d['PelangganID']; ?>">
            					Edit
        					</button>
							<button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus-data<?php echo $d['PelangganID']; ?>">
            					Hapus
        					</button>
						</td>
					</tr>

					<!-- Modal Edit Data-->
					<div class="modal fade" id="edit-data<?php echo $d['PelangganID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header" style="background-color: black">
									<h1 class="modal-title fs-5" id="exampleModalLabel" style="color: #ffff">Edit Pelanggan</h1>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<form action="proses_update_pembelian.php" method="post">
									<div class="modal-body" style="background-color: black">				
										<div class="col-10">
											<input type="text" name="PelangganID" value="<?php echo $d['PelangganID']; ?>" class="form-control" hidden>
										</div>
										<div class="col-10">
											<label style="color: #ffff">Nama Pelanggan</label>
											<input type="text" name="NamaPelanggan" value="<?php echo $d['NamaPelanggan']; ?>" class="form-control">
										</div>
										<div class="col-10">
											<label style="color: #ffff">Alamat</label>
											<input type="text" name="Alamat" value="<?php echo $d['Alamat']; ?>" class="form-control">
										</div>
										<div class="col-10">
											<label style="color: #ffff">No Telepon</label>
											<input type="text" name="NoTelepon" value="<?php echo $d['NoTelepon']; ?>" class="form-control">
										</div>
									</div>
									<div class="modal-footer" style="background-color: black">
										<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
										<button type="submit" class="btn btn-outline-success">Simpan</button>
									</div>
								</form>
							</div>
						</div>
					</div>

					<!-- Modal Hapus Data-->
					<div class="modal fade" id="hapus-data<?php echo $d['PelangganID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color: black">
                                <h1 class="modal-title fs-5" style="color: #ffff" id="exampleModalLabel">Hapus Data</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="post" action="proses_hapus_pembelian.php">
                                <div class="modal-body" style="background-color: black">
                                <input type="hidden" name="PelangganID" value="<?php echo $d['PelangganID']; ?>">
                                    <a style="color: #ffff">Apakah Anda Yakin Ingin Menghapus Data</a> <b style="color: #ffff"> <?php echo $d['NamaPelanggan']; ?></b>
                                </div>
                                <div class="modal-footer" style="background-color: black">
                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-outline-danger">Hapus</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> 
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<!-- Modal Tambah Data-->
<div class="modal fade" id="tambah-data" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
            <div class="modal-content">
                  <div class="modal-header" style="background-color: black">
                        <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: #ffff">Tambah Pelanggan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="proses_pembelian.php" method="post">
                        <div class="modal-body" style="background-color: black">
                              <div class="col-10">
                                    <label style="color: #ffff">ID Pelanggan</label>
                                    <input type="text" name="PelangganID" class="form-control">
                              </div>
                              <div class="col-10">
                                    <label style="color: #ffff">Nama pelanggan</label>
                                    <input type="text" name="NamaPelanggan" class="form-control">
                              </div>
                              <div class="col-10">
                                    <label style="color: #ffff">Alamat</label>
                                    <input type="text" name="Alamat" class="form-control">
                                    <input type="hidden" name="TanggalPenjualan" values="<?php echo date("Y-m-d") ?>" class="form-control">
                              </div>
                              <div class="col-10">
                                    <label style="color: #ffff">No. Telepon</label>
                                    <input type="number" name="NoTelepon" class="form-control">
                              </div>
                        </div>
                        <div class="modal-footer" style="background-color: black">
                              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                              <button type="submit" class="btn btn-outline-success">Simpan</button>
                        </div>
                  </form>
            </div>
      </div>
</div>
<br>
<?php
include "footer.php";
?>