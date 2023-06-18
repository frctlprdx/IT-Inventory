<?php 
session_start();
require 'koneksi.php';
?>

<!DOCTYPE html>
<html lang='en'>
<head>
<meta charset='UTF-8'>
<meta http-equiv='X-UA-Compatible' content='IE=edge'>
<meta name='viewport' content='width=device-width, initial-scale=1.0'>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
<script src="modal-js-example.js"></script>
<title>Document</title>
</head>
<body>
    <form action="" method="post">
    <div class="field has-addons p-2">  
        <div class="control"><input class="input" type="text" placeholder="ID search" name="search"></div>
        <div class="control"><button class="button is-info" type="submit" name="cari">Search</button></div>
    </div>
    </form>
<form action="select.php" method="post">
<div class="field is-horizontal p-2"> 
  <div class="field-body">
  <div class="field">
      <p class="control is-expanded">
        <input class="input" type="text" placeholder="ID" name="id">
      </p>
    </div>
    <div class="field">
      <p class="control is-expanded">
        <input class="input" type="text" placeholder="Nama" name="nama">
      </p>
    </div>
    <div class="field">
      <p class="control is-expanded">
        <input class="input" type="text" placeholder="Harga" name="harga">
      </p>
    </div>
    <div class="field">
      <p class="control is-expanded">
        <input class="input" type="Number" placeholder="stok" name="num">
      </p>
    </div>
    <div class="field">
      <p class="control is-expanded">
        <input class="input" type="text" placeholder="jenis" name="jenis">
      </p>
    </div>
  </div>
</div>
<div class="field is-horizontal p-2"> 
  <div class="field-body">
    <div class="field">
      <p class="control is-expanded">
      <textarea class="textarea" placeholder="Keterangan" name="ket"></textarea>
      </p>
    </div>
    <div class="field">
    <div class="file">
  <label class="file-label">
    <input class="file-input" type="file" name="file">
    <span class="file-cta">
      <span class="file-label">
        Choose a file…
      </span>
    </span>
  </label>
</div>
<div class="control my-2"><input class="button is-info"  type="submit" name="submit" value="submit"></div>
</div>
  </div>
</div>
</form>

<?php if ($_SESSION["error"]) {?>
    <article class="message is-danger">
    <div class="message-body">
      <?php echo $_SESSION["error"]?>
    </div>
  </article>
  <?php session_unset(); } else if ($_SESSION["sukses"]) { ?>
    <article class="message is-success">
    <div class="message-body">
      <?php echo $_SESSION["sukses"]; ?>
    </div>
  </article>
<?php session_unset();}?>
<?php if ($_SESSION["delete"]) {?>
    <article class="message is-danger">
    <div class="message-body">
      <?php echo $_SESSION["delete"]; 
      session_unset();
      }?>
    </div>
  </article>
    <table class="table is-striped is-fullwidth is-narrow ">
        <tr>
            <th>ID barang</th>
            <th>Nama</th>
            <th>Jenis</th>
            <th>Harga</th>
            <th>Keterangan</th>
            <th>Stok</th>
            <th>Foto</th>
            <th class="mp-auto">Action</th>   
        </tr>
        <?php if(!isset($_POST['cari'])){ ?>
            <?php while ($result = mysqli_fetch_assoc($benda)) { ?>
              <tr>
                  <td><?php echo $result["id"]; ?></td>
                  <td><?php echo $result["nama"]; ?></td>
                  <td><?php echo $result["jenis"]; ?></td>
                  <td><?php echo $result["harga"]; ?></td>
                  <td><?php echo $result["keterangan"]; ?></td>
                  <td><?php echo $result["jumlah"]; ?></td>
                  <td><img width="42" height="42" src="gambar/<?php echo $result["foto"];?>"></td>
                  <td class="is-flex">
                    <form method="post" action="editdelete.php">
                    <input type="hidden" name="delete" value="<?php echo $result["id"] ?>">
                    <button class="button is-danger is-outlined is-responsive mr-2" type="submit">Delete</button>
                    </form>
                    <button class="js-modal-trigger button is-warning is-outlined is-responsive" data-target="modal-js-example">
                        Edit
                    </button>
                      <div id="modal-js-example" class="modal">
                          <div class="modal-background"></div>
                          <div class="modal-content">
                            <div class="box">
                                  <form action="editdelete.php" method="post">
                                  <input class="input mt-5" type="text" name="editdata" placeholder="ID barang">
                                  <input class="input mt-5" type="text" name="editnama" placeholder="Nama barang" >
                                  <input class="input mt-5" type="text" name="editharga"  placeholder="harga barang">
                                  <input class="input mt-5" type="number" name="editjumlah"  placeholder="jumlah barang">
                                  <input class="input mt-5" type="text" name="editket" placeholder="keterangan barang" >
                                  <input class="input mt-5" type="text" name="editjenis" placeholder="Jenis barang" >
                                  <div class="file mt-5">
                                    <label class="file-label">
                                      <input class="file-input" type="file" name="editfile">
                                      <span class="file-cta">
                                        <span class="file-label">
                                          Choose a file…
                                        </span>
                                      </span>
                                    </label>
                                  </div>
                                  <button class="button is-warning is-outlined is-responsive mt-5" type="submit">Edit</button>
                                  </form>
                            </div>
                          </div>
                        <button class="modal-close is-large" aria-label="close"></button>
                      </div>
                      <form action="editdelete.php" method="post">
                        <input type="hidden" name="idambil" value="<?php echo $result["id"] ?>">
                        <input type="hidden" name="barangambil" value="<?php echo $result["nama"] ?>">
                        <input type="hidden" name="stokbarang" value="<?php echo $result["jumlah"] ?>">
                        <input type="hidden" name="hargaambil" value="<?php echo $result["harga"] ?>"> 
                        <input class="ml-2 input" style="width:60px; height:40px;" type="number" name="ambil">
                        <button class="button is-info is-outlined is-responsive" name="pengambilan">Ambil</button>
                      </form>
                    </td>
              </tr>
                <?php }?>
       <?php } ?>
       <?php if(isset($_POST['cari'])){ 
            $search = $_POST['search'];
        while (($result = mysqli_fetch_assoc($benda))) {
            if ($search != $result["id"]) {
                continue;}?>
             <tr>
                  <td><?php echo $result["id"]; ?></td>
                  <td><?php echo $result["nama"]; ?></td>
                  <td><?php echo $result["jenis"]; ?></td>
                  <td><?php echo $result["harga"]; ?></td>
                  <td><?php echo $result["keterangan"]; ?></td>
                  <td><?php echo $result["jumlah"]; ?></td>
                  <td><img width="42" height="42" src="gambar/<?php echo $result["foto"];?>"></td>
                  <td class="is-flex">
                    <form method="post" action="editdelete.php">
                    <input type="hidden" name="delete" value="<?php echo $result["id"] ?>">
                    <button class="button is-danger is-outlined is-responsive mr-2" type="submit">Delete</button>
                    </form>
                    <button class="js-modal-trigger button is-warning is-outlined is-responsive" data-target="modal-js-example">
                        Edit
                    </button>
                      <div id="modal-js-example" class="modal">
                          <div class="modal-background"></div>
                          <div class="modal-content">
                            <div class="box">
                                  <form action="editdelete.php" method="post">
                                  <input class="input mt-5" type="text" name="editdata" placeholder="ID barang">
                                  <input class="input mt-5" type="text" name="editnama" placeholder="Nama barang" >
                                  <input class="input mt-5" type="text" name="editharga"  placeholder="harga barang">
                                  <input class="input mt-5" type="number" name="editjumlah"  placeholder="jumlah barang">
                                  <input class="input mt-5" type="text" name="editket" placeholder="keterangan barang" >
                                  <input class="input mt-5" type="text" name="editjenis" placeholder="Jenis barang" >
                                  <div class="file mt-5">
                                    <label class="file-label">
                                      <input class="file-input" type="file" name="editfile">
                                      <span class="file-cta">
                                        <span class="file-label">
                                          Choose a file…
                                        </span>
                                      </span>
                                    </label>
                                  </div>
                                  <button class="button is-warning is-outlined is-responsive mt-5" type="submit">Edit</button>
                                  </form>
                            </div>
                          </div>
                        <button class="modal-close is-large" aria-label="close"></button>
                      </div>
                  </td>
              </tr><?php }}?>
    </table> 
    <a class="button is-ghost" href="ambil.php">Barang Keluar</a>
</body> 
</html>
