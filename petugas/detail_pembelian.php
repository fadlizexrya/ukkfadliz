<?php
include "header.php";
include "navbar.php";
?>
<br>
<div class="card" style="background-color: #b0fff4">
	<div class="card-body" style="background-color: black"> 
        <?php 
        include '../koneksi.php';
        $PelangganID = $_GET['PelangganID'];
        $no = 1;
        $data = mysqli_query($koneksi,"SELECT * FROM pelanggan INNER JOIN penjualan ON pelanggan.PelangganID=penjualan.PelangganID");
        while($d = mysqli_fetch_array($data)){
        ?> 
            <?php if ($d['PelangganID'] == $PelangganID) { ?>
                <table>
                    <tr>
                        <td style="color: #ffff">ID Pelanggan</td>
                        <td style="color: #ffff">: <?php echo $d['PelangganID']; ?></td>
                    </tr>
                    <tr>
                        <td style="color: #ffff">Nama Pelanggan</td>
                        <td style="color: #ffff">: <?php echo $d['NamaPelanggan']; ?></td>
                    </tr>
                    <tr>
                        <td style="color: #ffff">No Telepon</td>
                        <td style="color: #ffff">: <?php echo $d['NoTelepon']; ?></td>
                    </tr>
                    <tr>
                        <td style="color: #ffff">Alamat</td>
                        <td style="color: #ffff">: <?php echo $d['Alamat']; ?></td>
                    </tr>
                    <tr>
                        <td style="color: #ffff">Total Harga</td>
                        <td style="color: #ffff">: Rp. <?php echo $d['TotalHarga']; ?></td>
                    </tr>
                </table>
                <form method="post" action="tambah_detail_penjualan.php">
                    <input type="text" name="PenjualanID" value="<?php echo $d['PenjualanID']; ?>" hidden>
                    <input type="text" name="PelangganID" value="<?php echo $d['PelangganID']; ?>" hidden>
                    <button type="submit" class="btn btn-outline-info btn-sm mt-2">
                        Tambah Barang
                    </button>
                </form>
                <table class="table">
                    <thead>
                        <tr>
                            <th style="background-color: black"><a style="color: #ffff">No</a></th>
                            <th style="background-color: black"><a style="color: #ffff">Nama Produk</a></th>
                            <th style="background-color: black"><a style="color: #ffff">Jumlah Beli</a></th>
                            <th style="background-color: black"><a style="color: #ffff">Total Harga</a></th>
                            <th style="background-color: black"><a style="color: #ffff">Aksi</a></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            include '../koneksi.php';
                            $nos = 1;
                            $detailpenjualan = mysqli_query($koneksi,"SELECT * FROM detailpenjualan");
                            while($d_detailpenjualan = mysqli_fetch_array($detailpenjualan)){
                            ?>
                            <?php  
                            if($d_detailpenjualan['PenjualanID'] == $d['PenjualanID']) { ?>
                                <tr>
                                    <td style="background-color: black"><a style="color: #ffff"><?php echo $nos++; ?></a></td>
                                    <td style="background-color: black">
                                        <form action="simpan_barang_beli.php" method="post">
                                            <div class="form-group" style="background-color: black">
                                                <input type="text" name="PelangganID" value="<?php echo $d['PelangganID']; ?>" hidden>
                                                <input type="text" name="DetailID" value="<?php echo $d_detailpenjualan['DetailID']; ?>" hidden>
                                                <select name="ProdukID" class="form-control" onchange="this.form.submit()">
                                                    <option>Pilih Produk</option>
                                                    <?php 
                                                    include '../koneksi.php';
                                                    $no = 1;
                                                    $produk = mysqli_query($koneksi,"SELECT * FROM produk");
                                                    while($d_produk = mysqli_fetch_array($produk)) {
                                                    ?>
                                                    <option value="<?php echo $d_produk['ProdukID']; ?>" <?php if($d_produk['ProdukID']==$d_detailpenjualan['ProdukID']) { echo "selected";} ?>><?php echo $d_produk['NamaProduk']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </form>
                                    </td>
                                    <td style="background-color: black">
                                    <form method="post" action="hitung_subtotal.php">
                                        <?php 
                                            include '../koneksi.php';
                                            $produk = mysqli_query($koneksi,"SELECT * FROM produk");
                                            while($d_produk = mysqli_fetch_array($produk)) {
                                        ?>
                                        <?php 
                                        if ($d_produk['ProdukID']==$d_detailpenjualan['ProdukID']) { ?>
                                        <input type="text" name="Harga" value="<?php echo $d_produk['Harga']; ?>" hidden>
                                        <input type="text" name="ProdukID" value="<?php echo $d_produk['ProdukID']; ?>" hidden>
                                        <input type="text" name="Stok" value="<?php echo $d_produk['Stok']; ?>" hidden>
                                        <?php 
                                            } 
                                        } 
                                        ?>
                                        <div class="form-group" style="background-color: black">
                                            <input type="number" name="JumlahProduk" value="<?php echo $d_detailpenjualan['JumlahProduk']; ?>" class="form-control">
                                        </div>
                                    </td>
                                    <td style="background-color: black"><a style="color: #ffff"><?php echo $d_detailpenjualan['Subtotal']; ?></a></td>
                                    <td style="background-color: black">
                                        <input type="text" name="DetailID" value="<?php echo $d_detailpenjualan['DetailID']; ?>" hidden>   
                                        <input type="text" name="PelangganID" value="<?php echo $d['PelangganID']; ?>" hidden>
                                        <button type="submit" class="btn btn-outline-success btn-sm">Proses</button></form>
                                        <form method="post" action="hapus_detail_pembelian.php">
                                            <input type="text" name="PelangganID" value="<?php echo $d['PelangganID']; ?>" hidden>
                                            <input type="text" name="DetailID" value="<?php echo $d_detailpenjualan['DetailID']; ?>" hidden>
                                            <button type="submit" class="btn btn-outline-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>    
                                </tr>
                            <?php } else {
                            ?>
                        <?php 
                        }   
                    } 
                    ?>
                    </tbody>
                </table> 
                <form method="post" action="simpan_total_harga.php">
                    <?php 
                    include '../koneksi.php';
                    $detailpenjualan = mysqli_query($koneksi, "SELECT SUM(Subtotal) AS TotalHarga FROM detailpenjualan  WHERE PenjualanID='$d[PenjualanID]'"); 
                    $row = mysqli_fetch_assoc($detailpenjualan); 
                    $sum = $row['TotalHarga'];
                    ?>
                    <div class="row">
                        <div class="col-sm-10">
                            <div class="form-group">
                                <input type="text" class="form-control"  name="TotalHarga" value="<?php echo $sum; ?>" readonly>
                                <input type="text" name="PelangganID" value="<?php echo $d['PelangganID']; ?>" hidden>
                                <input type="text" name="PenjualanID" value="<?php echo $d['PenjualanID']; ?>" hidden>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <button class="btn btn-outline-success btn-sm form-control" type="submit">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>  
            <?php } else { ?>
        <?php 
        } 
    } 
    ?>
    </div> 
</div>
<br>
<?php
include "footer.php";
?>