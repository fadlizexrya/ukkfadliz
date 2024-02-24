<?php
include "header.php";
include "navbar.php";
?>
<br>
<div class="card" style="background-color: #00ff98">
	<div class="card-body" style="background-color: black">
		<button type="button" class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#tambah-data">
			Tambah Data
		</button>
	</div>
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
			<?php } ?>
			<?php 
		}
		?>
		<table class="table">
			<thead>
				<tr>
					<th style="background-color: black"><a style="color: #00ff98">No</a></th>
					<th style="background-color: black"><a style="color: #00ff98">Nama Petugas</a></th>
					<th style="background-color: black"><a style="color: #00ff98">Username</a></th>
					<th style="background-color: black"><a style="color: #00ff98">Akses Petugas</a></th>
					<th style="background-color: black"><a style="color: #00ff98">Aksi</a></th>
				</tr>
			</thead>
			<tbody>
				<?php 
				include '../koneksi.php';
				$no = 1;
				$data = mysqli_query($koneksi,"select * from petugas");
				while($d = mysqli_fetch_array($data)){
					?>
					<tr>
						<td style="background-color: black"><a style="color: #00ff98"><?php echo $no++; ?></a></td>
						<td style="background-color: black"><a style="color: #00ff98"><?php echo $d['nama_petugas']; ?></a></td>
						<td style="background-color: black"><a style="color: #00ff98"><?php echo $d['username']; ?></a></td>
						<td style="background-color: black"><a style="color: #00ff98">
							<?php 
							if ($d['level'] == '1') { ?>
								Administrator
							<?php } else { ?>
								Petugas
							<?php } ?>
						</td>
						<td style="background-color: black">

							<button type="button" class="btn btn-outline-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit-data<?php echo $d['id_petugas']; ?>">
								Edit
							</button>
							<?php 
							if ($d['level'] == $_SESSION['level']) { ?>
							<?php } else { ?>
								<button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus-data<?php echo $d['id_petugas']; ?>">
									Hapus
								</button>
							<?php } ?>
						</td>
					</tr>

					<!-- Modal Edit Data-->
					<div class="modal fade" id="edit-data<?php echo $d['id_petugas']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header" style="background-color: black">
									<h1 class="modal-title fs-5" style="color: #ffff" id="exampleModalLabel">Edit Data</h1>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<form action="proses_update_petugas.php" method="post">
									<div class="modal-body" style="background-color: black">
										<div class="col-10">
											<label style="color: #ffff">Nama Petugas</label>
											<input type="hidden" name="id_petugas" value="<?php echo $d['id_petugas']; ?>">
											<input type="text" name="nama_petugas" class="form-control" value="<?php echo $d['nama_petugas']; ?>">
										</div>
										<div class="col-10">
											<label style="color: #ffff">Username</label>
											<input type="text" name="username" class="form-control" value="<?php echo $d['username']; ?>">
										</div>
										<div class="col-10">
											<label style="color: #ffff">Password</label>
											<input type="text" name="password" class="form-control">
											<small class="text-danger text-sm">*Kosongkan Jika Password Tidak Dirubah!!</small>
										</div>
										<div class="col-10">
											<label style="color: #ffff">Akses Petugas</label>
											<select name="level" class="form-control">
												<option>xxxxxPilih Aksesxxxxx</option>
												<option value="1" <?php if ($d['level'] == '1') { echo "selected";} ?>>Administrator</option>
												<option value="2" <?php if ($d['level'] == '2') { echo "selected";} ?>>Petugas</option>
											</select>
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
					<div class="modal fade" id="hapus-data<?php echo $d['id_petugas']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header" style="background-color: black">
									<h1 class="modal-title fs-5" style="color: #ffff" id="exampleModalLabel">Hapus Data</h1>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<form method="post" action="proses_hapus_petugas.php">
									<div class="modal-body" style="background-color: black">
										<input type="hidden" name="id_petugas" value="<?php echo $d['id_petugas']; ?>">
										<a style="color: #ffff">Apakah Anda Yakin Ingin Menghapus Data</a> <b style="color: #ffff"><?php echo $d['nama_petugas']; ?></b>
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
				<h1 class="modal-title fs-5" style="color: #ffff" id="exampleModalLabel">Tambah Pengguna</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form action="proses_simpan_petugas.php" method="post">
				<div class="modal-body" style="background-color: black">				
					<div class="col-10">
						<label style="color: #ffff">Nama Petugas</label>
						<input type="text" name="nama_petugas" class="form-control">
					</div>
					<div class="col-10">
						<label style="color: #ffff">Username</label>
						<input type="text" name="username" class="form-control">
					</div>
					<div class="col-10">
						<label style="color: #ffff">Password</label>
						<input type="text" name="password" class="form-control">
					</div>
					<div class="col-10">
						<label style="color: #ffff">Akses Petugas</label>
						<select name="level" class="form-control">
							<option>xxxxxAkses Petugasxxxxx</option>
							<option value="1">Administrator</option>
							<option value="2">Petugas</option>
						</select>
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