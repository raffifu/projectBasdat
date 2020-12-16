<?php
include("config.php");

if(isset($_POST['submit'])){
  $namaBarang = $_POST['nama'];
  $kode_jenis = $_POST['jenis'];
  $kode_lokasi = $_POST['lokasi'];
  $jumlahBarang = $_POST['jumlah'];

  $query = "INSERT INTO tb_barang";
}
?>