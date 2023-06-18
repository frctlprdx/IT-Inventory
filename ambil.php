<?php 
session_start();
require 'koneksi.php';
?>

<!DOCTYPE html>
<html lang='en'>
<head>
<meta charset='UTF-8'>
<meta http-equiv='X-UA-Compatible' content='IE=edge'>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
<meta name='viewport' content='width=device-width, initial-scale=1.0'>
<title>Document</title>
</head>
<body>
<form action="" method="post">
    <div class="field has-addons p-2">  
        <div class="control"><input class="input" type="text" placeholder="ID search" name="search"></div>
        <div class="control"><button class="button is-info" type="submit" name="cari">Search</button></div>
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
<table class=" mx-auto  table is-striped  is-fullwidth is-narrow">
    <tr>
        <th class="px-5">ID Barang</th>
        <th class="px-5">Nama</th>
        <th class="px-5">Diambil</th>
        <th class="px-5">Total</th>
        <th class="px-5">Aksi</th>
    </tr>
    <?php if(!isset($_POST['cari'])){ ?>
<?php while ($total = mysqli_fetch_assoc($diambil)) { ?>
    <tr>
        <td class="px-5"><?php echo $total["id"]  ?></td>
        <td class="px-5"><?php echo $total["nama"]  ?></td>
        <td class="px-5"><?php echo $total["diambil"]  ?></td>
        <td class="px-5"><?php echo $total["total"]  ?></td>
        <td>
          <form method="post" action="editdelete.php">
          <input type="hidden" name="deletebarang" value="<?php echo $total["id"] ?>">
          <button class="button is-danger is-outlined is-responsive mr-2" name="deleteambil">Delete</button>
          </form>
        </td>
    </tr>
<?php }} ?>
<?php if(isset($_POST['cari'])){ 
            $search = $_POST['search'];
        while (($total = mysqli_fetch_assoc($diambil))) {
            if ($search != $total["id"]) {
                continue;}?>
        <tr>
          <td class="px-5"><?php echo $total["id"]  ?></td>
          <td class="px-5"><?php echo $total["nama"]  ?></td>
          <td class="px-5"><?php echo $total["diambil"]  ?></td>
          <td class="px-5"><?php echo $total["total"]  ?></td>
          <td>
            <form method="post" action="editdelete.php">
            <input type="hidden" name="deletebarang" value="<?php echo $total["id"] ?>">
            <button class="button is-danger is-outlined is-responsive mr-2" name="deleteambil">Delete</button>
            </form>
          </td>
        </tr><?php }}?>
</table>
</body>
</html>