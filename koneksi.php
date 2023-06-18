<?php 
session_start();
$dbserver = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "inventory";
    
$conn =  mysqli_connect($dbserver, $dbusername, $dbpassword, $dbname);

$barang = "SELECT * FROM barang";
$benda = mysqli_query($conn,$barang);

$ambil = "SELECT * FROM diambil";
$diambil = mysqli_query($conn,$ambil);

?>