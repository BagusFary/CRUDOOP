<?php 
require 'init.php';
$functions = new Database();
$functions->FilterHarga();
?>
<h1>CRUD With OOP</h1>
<br><br>


<form action="" method="get">
	<ul>
		<li>
			<label for="minimal">Harga Minimal : </label>
			<input type="number" name="minimal" id="minimal">
		</li>
		<li>
			<label for="maksimal">Harga Maksimal : </label>
			<input type="number" name="maksimal" id="maksimal">
		</li>
		<li>
			<button type="submit" name="filterharga">Filter</button>
		</li>
	</ul>
</form>

<br><br>
 
<a href="create.php">Create Data</a>
<table border="1" cellspacing="0" cellpadding="10">
	<tr>
		<th>No</th>
		<th>Kode</th>
		<th>Nama</th>
		<th>Gambar</th>
		<th>Kategori</th>
        <th>Harga</th>
        <th>Aksi</th>
	</tr>
	
	<?php $no = 1; ?>
	<?php foreach( $functions->ShowData() as $x ) : ?>
	
	<tr>
		<td><?php echo $no; ?></td>
		<td><?php echo $x['kode_barang']; ?></td>
		<td><?php echo $x['nama_produk']; ?></td>
		<td><img src="img/<?= $x["gambar"];?>" width="100"></td>
        <td><?php echo $x['nama']; ?></td>
		<td><?php echo $x['harga']; ?></td>
        
		<td>
			<a href="edit.php?id=<?php echo $x['id']; ?>&aksi=edit">Edit</a>
			<a onclick="return confirm('Hapus Data Ini?');" href="delete.php?id=<?php echo $x['id']; ?>&aksi=hapus" >Hapus</a>			
		</td>
	</tr>
    <?php $no++; ?>
    <?php endforeach; ?>
	
</table>