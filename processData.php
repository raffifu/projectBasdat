<?php
include("config.php");

if(isset($_POST['tambah'])){
  $namaBarang = $_POST['nama'];
  $kodeJenis = $_POST['jenis'];
  $kodeLokasi = $_POST['lokasi'];
  $jumlah = $_POST['jumlah'];

  $query = "INSERT INTO barang (namaBarang,kodeLokasi,kodeJenis,jumlah) VALUES 
            ('$namaBarang',$kodeLokasi,$kodeJenis,$jumlah)";
  $runSql = mysqli_query($db, $query);
  if($runSql){
    echo json_encode(array('status' => True));
  }else{
    echo json_encode(array('status' => False));
  }
}else if (isset($_POST['delete'])) {
  $kodeBarang = $_POST['delete']; 
  $query = "DELETE FROM barang WHERE kodeBarang = '$kodeBarang';";
  $runSql = mysqli_query($db, $query);
  if ($runSql) {
    echo json_encode(array('status' => True));
  } else {
    echo json_encode(array('status' => False));
  }
}else if(isset($_POST['update'])){
  $idBarang = $_POST['update'];
  $namaBarang = $_POST['nama'];
  $kodeJenis = $_POST['jenis'];
  $kodeLokasi = $_POST['lokasi'];
  $jumlah = $_POST['jumlah'];

  $query = "UPDATE barang SET namaBarang='{$namaBarang}',kodeLokasi='{$kodeLokasi}',kodeJenis='{$kodeJenis}',jumlah='{$jumlah}'
            WHERE kodeBarang='{$idBarang}'
            ";
  $runSql = mysqli_query($db, $query);
  if ($runSql) {
    echo json_encode(array('status' => True));
  } else {
    echo json_encode(array('status' => False));
  }
} else {
  echo "Tidak terdapat data";
}
?>