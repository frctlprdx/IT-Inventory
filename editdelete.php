<?php 
session_start();
include "koneksi.php";

if (isset($_POST['delete'])) {
    $del = $_POST['delete'];
    $sql = "DELETE FROM `barang` WHERE id = $del";
    $delete = mysqli_query($conn, $sql);
    
    if ($delete) {
        $_SESSION["delete"] = "Berhasil hapus data";
        header("location:index.php");
    } else {
        $error = "Data tidak bisa dihapus";
    }
}

if (isset($_POST['editdata'])) {
    $id = $_POST['editdata'];
    $editnama = $_POST['editnama'];
    $editharga = $_POST['editharga'];
    $editjumlah = $_POST['editjumlah'];
    $editket =$_POST['editket'];
    $editfoto = $_POST['editfile'];
    $editjenis = $_POST['editjenis'];
   if ($editnama) {
    $edit = "UPDATE `barang` SET `id`='$id',`nama`='$editnama',`harga`='$editharga',`jumlah`='$editjumlah',`keterangan`='$editket',`foto`='$editfoto', 
    `jenis`='$editjenis' WHERE id='$id'";
    $edited = mysqli_query($conn, $edit);
    if ($edited) {
        $_SESSION["sukses"] = "Berhasil Edit";
        header("location:index.php");
    }
    else {
        $_SESSION["error"] = "Gagal edit";
        header("location:index.php");
    }
} else {
    $_SESSION["error"] = "Gagal edit";
    header("location:index.php");
}
}

if (isset($_POST['pengambilan'])){
    $ambilid = $_POST['idambil'];
    $barangambil = $_POST['barangambil'];
    $stokbarang = $_POST['stokbarang'];
    $hargaambil = $_POST['hargaambil'];
    $ambil = $_POST['ambil'];
    $stokakhir = ($stokbarang - $ambil);
    $totalharga = $ambil*$hargaambil;
    if ($totalharga && $stokbarang > $ambil){
        $dataambil = "INSERT INTO `diambil`(`id`, `nama`, `diambil`, `total`) VALUES ('$ambilid','$barangambil','$ambil','$totalharga')";
        $pengambilan = mysqli_query($conn, $dataambil);
        echo "sampai sini";
        $editambil = "UPDATE `barang` SET `jumlah`='$stokakhir' WHERE id = '$ambilid'";
        $editstoknya = mysqli_query($conn, $editambil);
        $_SESSION["sukses"] = "Berhasil Ambil Barang";
        header("Location:index.php");
    } else {
        $_SESSION["error"] = "Barang tidak cukup"; 
        header("Location:index.php");
    }
}


if (isset($_POST['deleteambil'])) {
    $delam = $_POST['deletebarang'];
    $delambil = "DELETE FROM `diambil` WHERE id = $delam";
    $delete = mysqli_query($conn, $delambil);
    if ($delete) {
        $_SESSION["delete"] = "Berhasil hapus data";
        header("location:ambil.php");
    } else {
        $error = "Data tidak bisa dihapus";
    }
}



    // $row = mysqli_fetch_assoc($diambil);
    // if($ambilid = $row["id"]){
    //     $jumlahawal = $row["diambil"];
    //     $editambilnya = $jumlahawal + $ambil;
    //     $hargalanjut = $hargaambil * $editambilnya;
    //     $selesaiambil = "UPDATE `diambil` SET `diambil`='$editambilnya',`total`='$hargalanjut' WHERE id = '$ambilid'";
    //     $akhirnya = mysqli_query($conn, $selesaiambil);
    //     if ($akhirnya){
    //         $stokakhir1 = ($stokbarang - $ambil);
    //         $stokakhirnya = "UPDATE `barang` SET `jumlah`='$stokakhir1' WHERE id = '$ambilid'";
    //         $_SESSION["sukses"] = "Berhasil Ambil Barang";
    //         header("Location:index.php");
    //     }
    // }
?>

