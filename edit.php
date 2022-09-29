<?php
require "init.php";
$fungsi = new Database();

$id = $_GET["id"];
$queryolddata = $fungsi->query("SELECT * FROM produk WHERE id = $id")[0];
$querykategori = $fungsi->query("SELECT * FROM kategori");



if( isset($_POST) & !empty($_POST)) {
    $id = $_POST['id'];
    $nama_produk = $fungsi->Verify($_POST['nama_produk']);
	$kode_barang = $fungsi->Verify($_POST['kode_barang']);
	$harga = $fungsi->Verify($_POST['harga']);
	$kategori_id = $fungsi->Verify($_POST['kategori_id']);
    $gambarLama = $fungsi->Verify($_POST['gambarLama']);

    if($_FILES["gambar"]["error"] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = $fungsi->Upload();
    }
   

    $dataedit = $fungsi->Edit($id, $nama_produk, $kode_barang, $harga, $kategori_id, $gambar);
    if ($dataedit) {
        echo"<script>
                alert('Barang Berhasil diubah');
                document.location.href = 'index.php';
                </script>";
    } else {
        echo"<script>
                alert('Barang Gagal Diubah')
                document.location.href = 'index.php';
                </script>";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Produk Penjualan</title>
    <style>
        label {
                display: block;  
        }
    </style>
</head>
<body>
    <h1>Ubah Produk Penjualan</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $queryolddata["id"];?>">
        <input type="hidden" name="gambarLama" value="<?= $queryolddata["gambar"];?>">
        <ul>
            <li>
                <label for="kode_barang">Kode Barang : </label>
                <input type="text" name="kode_barang" id="kode_barang" required value="<?= $queryolddata["kode_barang"];?>">
            </li>
            <li>
                <label for="nama_produk">Nama Produk : </label>
                <input type="text" name="nama_produk" id="nama_produk" value="<?= $queryolddata["nama_produk"];?>">
            </li>
            <li>
                <label for="harga">Harga : </label>
                <input type="number" name="harga" id="harga" value="<?= $queryolddata["harga"];?>">
            </li>
            <li>
                <label for="kategori_id">Kategori : </label>              
                    <select name="kategori_id" id="kategori_id">
                        <?php foreach($querykategori as $data) : ?>
                            <option value="<?= $data["id"];?>"><?= $data["nama"]?></option>
                        <?php endforeach; ?>
                    </select>
            </li>
            <li>
                <label for="gambar">Gambar : </label>
                <img src="img/<?= $queryolddata["gambar"];?>" width="200">
                <input type="file" name="gambar" id="gambar">
            </li>
            <li>
                <button type="submit" name="submit" >Submit</button>
            </li>
        </ul>
    </form>
</body>
</html>