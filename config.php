<?php

$server = "localhost";
$user = "root";
$password = "inipassword";
$nama_database = "inventaris";

$db = mysqli_connect($server, $user, $password, $nama_database);

if( !$db ){
    die("Gagal terhubung dengan database: " . mysqli_connect_error());
}

?>