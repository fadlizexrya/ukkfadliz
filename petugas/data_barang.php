<?php
include "header.php";
include "navbar.php";
?>
<br>
<div class="card" style="background-color: #ff00e9;">
	<div class="card-body" style="background-color: black">
        <button type="button" class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#tambah-data">
            Tambah Data
        </button>
	</div>
    <div class="card-body text-" style="background-color: black">
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
        <table class="table"> 
            <thead>
                <tr>
                    <th style="background-color: black"><a style="color: #ff00e9">No</a></th>
                    <th style="background-color: black"><a style="color: #ff00e9">Nama Barang</a></th>
                    <th style="background-color: black"><a style="color: #ff00e9">Harga</a></th>
                    <th style="background-color: black"><a style="color: #ff00e9">Stok</a></th>
                    <th style="background-color: black"><a style="color: #ff00e9">Aksi</a></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    include '../koneksi.php';
                    $no = 1;
                    $data = mysqli_query($koneksi,"select * from produk");
                    while($d = mysqli_fetch_array($data)){
                ?>
                <tr>
                    <td style="background-color: black"><a style="color: #ff00e9"><?php echo $no++; ?></a></td>
                    <td style="background-color: black"><a style="color: #ff00e9"><?php echo $d['NamaProduk']; ?></a></td>
                    <td style="background-color: black"><a style="color: #ff00e9">Rp. <?php echo $d['Harga']; ?></a></td>
                    <td style="background-color: black"><a style="color: #ff00e9"><?php echo $d['Stok']; ?></a></td>
                    <td style="background-color: black"><a style="color: #ff00e9">
                        <button type="button" class="btn btn-outline-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit-data<?php echo $d['ProdukID']; ?>">
                            Edit
                        </button>
                        <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus-data<?php echo $d['ProdukID']; ?>">
                            Hapus
                        </button>
                    </td>
                </tr>

                <!-- Modal Edit Data-->
                <div class="modal fade" id="edit-data<?php echo $d['ProdukID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color: black">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: #ffff">Edit Barang</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="proses_update_barang.php" method="post">
                                    <div class="modal-body" style="background-color: black">
                                        <div class="col-10">
                                            <label style="color: #ffff">Nama Barang</label>
                                            <input type="hidden" name="ProdukID" value="<?php echo $d['ProdukID']; ?>">
                                            <input type="text" name="NamaProduk" class="form-control" value="<?php echo $d['NamaProduk']; ?>">
                                        </div>
                                        <div class="col-10">
                                            <label style="color: #ffff">Harga</label>
                                            <input type="number" name="Harga" class="form-control"value="<?php echo $d['Harga']; ?>">
                                        </div>
                                        <div class="col-10">
                                            <label style="color: #ffff">Stok</label>
                                            <input type="number" name="Stok" class="form-control"value="<?php echo $d['Stok']; ?>">
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
                <div class="modal fade" id="hapus-data<?php echo $d['ProdukID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color: black">
                                <h1 class="modal-title fs-5" style="color: #ffff" id="exampleModalLabel">Hapus Data</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="post" action="proses_hapus_barang.php">
                                <div class="modal-body" style="background-color: black">
                                <input type="hidden" name="ProdukID" value="<?php echo $d['ProdukID']; ?>">
                                    <a style="color: #ffff">Apakah Anda Yakin Ingin Menghapus Data</a> <b style="color: #ffff"> <?php echo $d['NamaProduk']; ?></b>
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
        <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: #ffff">Tambah Barang</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="proses_simpan_barang.php" method="post">
        <div class="modal-body" style="background-color: black">
                <div class="col-10">
                    <label style="color: #ffff">Nama Barang</label>
                    <input type="text" name="NamaProduk" class="form-control">
                </div>
                <div class="col-10">
                    <label style="color: #ffff">Harga</label>
                    <input type="number" name="Harga" class="form-control">
                </div>
                <div class="col-10">
                    <label style="color: #ffff">Stok</label>
                    <input type="number" name="Stok" class="form-control">
                </div>
        </div>
        <div class="modal-footer" style="background-color: black">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Keluar</button>
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