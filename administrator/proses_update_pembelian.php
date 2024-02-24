<?php 
// koneksi database
include '../koneksi.php';
 
// menangkap data yang di kirim dari form
$PelangganID = $_POST['PelangganID'];
$NamaPelanggan = $_POST['NamaPelanggan'];
$Alamat = $_POST['Alamat'];
$NoTelepon = $_POST['NoTelepon'];

// update data ke database
mysqli_query($koneksi,"update pelanggan set NamaPelanggan='$NamaPelanggan', Alamat='$Alamat', NoTelepon='$NoTelepon' where PelangganID='$PelangganID'");
 
// mengalihkan halaman kembali ke data_barang.php
header("location:pembelian.php?pesan=update");
 
?>