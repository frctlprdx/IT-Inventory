<?php 
session_start();
include "koneksi.php";

if (isset($_POST["submit"])) {
    $id = $_POST["id"];
    $nama = $_POST["nama"] ;
    $harga = $_POST["harga"] ;
    $jumlah = $_POST["num"] ;
    $ket = $_POST["ket"] ;
    $foto = $_POST["file"] ;
    $jenis = $_POST["jenis"];

    if ($id && $nama && $harga && $jumlah) {
        $query = "INSERT INTO `barang`(`id`, `nama`, `harga`, `jumlah`, `keterangan`, `foto`, `jenis`) 
        VALUES ('$id','$nama','$harga','$jumlah','$ket','$foto', '$jenis')";
        $input = mysqli_query($conn, $query);
        if ($input) {
            $_SESSION["sukses"] = "Berhasil input";
            header("location:index.php");
        }
        else {
            $_SESSION["error"] = "Gagal input";
            header("location:index.php");
        }
    } else {
        $_SESSION["error"] = "Gagal input";
        header("location:index.php");
    }
}

?>