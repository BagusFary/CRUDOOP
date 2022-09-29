<?php
include 'init.php';

$functions = new Database();


// if(isset($_POST["submit"]) ) {


//     if($function->Tambah($_POST) > 0 ) {
//         echo "
//             <script>
//             alert('Barang Berhasil Ditambahkan');
//             document.location.href = 'index.php';
//             </script>
//         ";
//     } else {
//         echo "
//             <script>
//             alert('Barang Gagal Ditambahkan');
//             document.location.href = 'index.php';
//             </script>
//             ";
//     }
// }

if(isset($_POST) & !empty($_POST)){
	$nama_produk = $functions->Verify($_POST['nama_produk']);
	$kode_barang = $functions->Verify($_POST['kode_barang']);
	$harga = $functions->Verify($_POST['harga']);
	$kategori_id = $functions->Verify($_POST['kategori_id']);
	$gambar = $functions->Upload($_POST);
    if (!$gambar) {
        return false;
    }

    $data = $functions->Create($nama_produk, $kode_barang, $harga, $kategori_id, $gambar);
    if($data){
        echo "<script>
        alert ('Tambah Data Sukses');
            document.location.href = 'index.php'
            </script>";
    }else{
        echo "failed to insert data";
    }
}

$querykategori = $functions->query("SELECT * FROM kategori");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang Penjualan</title>
    <style>
        label {
            display: block;
        }
    </style>
</head>
<body>
    <h1>Tambah Barang Penjualan</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="nama_produk">Nama Barang : </label>
                <input type="text" id="nama_produk" name="nama_produk" required autofocus>
            </li>
            <li>
                <label for="kode_barang">Kode Barang : </label>
                <input type="text" id="kode_barang" name="kode_barang" required>
            </li>
            <li>
                <label for="harga">Harga : </label>
                <input type="number" id="harga" name="harga" required>
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
                <input type="file" for="gambar" name="gambar">
            </li>
            <br>
            <li>
                <button type="submit" name="submit">Tambah Barang</button>
            </li>
        </ul>
    </form>
    
</body>
</html>