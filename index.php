<?php

include "config/koneksi.php";
include "library/oop.php";

$go = new oop();
$tabel = 'buku';
$field = array(
    'judul' => @$_POST['judul'],
    'kd_buku' => @$_POST['kd_buku'],
    'pengarang' => @$_POST['pengarang'],
);
$redirect = '?menu=buku';
@$where = "id_buku = $_GET[id_buku]";

if (isset($_POST['simpan'])) {
    $go->simpan($con, $tabel, $field, $redirect);
}

if (isset($_GET['hapus'])) {
    $go->hapus($con, $tabel, $where, $redirect);
}

if (isset($_GET['edit'])) {
  $edit = $go->edit($con, $tabel, $where);
}

if (isset($_POST['ubah'])) {
  $go->ubah($con, $tabel, $field, $where, $redirect);
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <title>Perpustakaan</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
          <a class="navbar-brand" href="#">Katalog Perpustakaan</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">                    
            </ul>
            </form>
          </div>
        </div>
      </nav>

      <form method='post'>

<table align="center">
    <h3 align="center">DAFTAR DATA BUKU</h3>
    <div class="mb-3">
        <label class="form-label">Judul</label>
        <input type="text" name="judul" class="form-control" value="<?php echo @$edit['judul'] ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Kode Penerbit</label>
        <input type="text" name="kd_buku" class="form-control" value="<?php echo @$edit['kd_buku'] ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Pengarang</label>
        <input type="text" name="pengarang" class="form-control" value="<?php echo @$edit['pengarang'] ?>">
    </div>

    <?php if (@$_GET['id_buku'] == "") { ?>
        <input class="btn btn-primary" type="submit" name="simpan" value="SIMPAN">
    <?php } else { ?>
        <input class="btn btn-success" type="submit" name="ubah" value="UPDATE">
    <?php } ?>

</table>
</form>

<br>

<table id="example" class="display" style="width:100%">
<thead>
    <tr>
        <th>ID Buku</th>
        <th>Judul buku</th>
        <th>Kode Buku</th>
        <th>pengarang</th>
        <th>Aksi</th>
        <th></th>

    </tr>
</thead>
<tbody>

    <?php
    $a = $go->tampil($con, $tabel);
    $no = 0;

    if ($a == "") {
        echo "<tr><td colspan='5' align='center'>No Record</td></tr>";
    } else {

        foreach ($a as $r) {
            $no++;
    ?>
            <tr>
                <td><?php echo $no ?></td>
                <td><?php echo $r['judul'] ?></td>
                <td><?php echo $r['kd_buku'] ?></td>
                <td><?php echo $r['pengarang'] ?></td>
                <td><a class="btn btn-warning" href="?menu=buku&edit&id_buku=<?php echo $r['id_buku'] ?>">Edit</a></td>
                <td><a class="btn btn-danger" href="?menu=buku&hapus&id_buku=<?php echo $r['id_buku'] ?>" onclick="return confirm('Hapus buku berjudul <?php echo $r['judul'] ?> ?')">Hapus</a></td>
            </tr>
    <?php }
    } ?>

</tbody>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
    </script>

</table>

<!-- Created by Raffi Prasetya Ramadhani-->