<?php
class Database{
    protected $host = "localhost",
	 $uname = "root",
	 $pass = "",
	 $db = "manajemenbarangv2",
	 $koneksi;



	public function __construct(){
		$this->koneksi = mysqli_connect($this->host, $this->uname, $this->pass);
		mysqli_select_db($this->koneksi, $this->db);
	}

	public function query($query){
		$result = mysqli_query($this->koneksi, $query);
		$rows = [];
		while ( $row = mysqli_fetch_assoc($result) ) {
			$rows[] = $row;
		}
		return $rows;
		}

	public function ShowData(){
		$data = mysqli_query($this->koneksi, "SELECT p.id, p.kode_barang, p.nama_produk, p.harga, p.kategori_id, p.gambar, k.nama FROM produk p INNER JOIN kategori k ON p.kategori_id = k.id
		");
		while($d = mysqli_fetch_array($data)){
			$hasil[] = $d;
		}
		return $hasil;
	}

	public function Pagination(){

		$jumlahDataPerhalaman = 5;
		$jumlahData = count($this->query("SELECT * FROM produk"));
		$jumlahHalaman = ( isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;
		$awalData = ( $jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;
	}

	public function Search(){

	}

	public function FilterHarga(){
		if( isset($_GET["filterharga"]) ) {
			$minimal = $_GET["minimal"];
			$maksimal = $_GET["maksimal"];

			$this->query("SELECT * FROM produk p INNER JOIN kategori k ON p.kategori_id = k.id WHERE harga BETWEEN $minimal AND $maksimal");

		} else {
			 $this->ShowData();
	
		}	
		
		return true;
	}

	public function Create($nama_produk, $kode_barang, $harga, $kategori_id, $gambar){
	
		$query = "INSERT INTO produk (kode_barang, nama_produk, harga, kategori_id, gambar)
					VALUES ('$kode_barang', '$nama_produk', '$harga', '$kategori_id', '$gambar')";
					
		$data = mysqli_query($this->koneksi, $query);
		if($data){
			return true;
		} else {
			return false;
		}
			
	}

	public function Edit($id, $nama_produk, $kode_barang, $harga, $kategori_id, $gambar) {

		$query = "UPDATE `produk` SET 
		`kode_barang`='$kode_barang',`nama_produk`='$nama_produk',`harga`='$harga',`kategori_id`='$kategori_id',`gambar`='$gambar' WHERE id = $id";
		
		$data = mysqli_query($this->koneksi, $query);
			return mysqli_affected_rows($this->koneksi);
		if($data){
			return true;
		} else {
			return false;
		}
	
	}

	public function Upload() {
	$namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    if ( $error === 4 ) {
        echo "<script>
                alert('pilih gambar terlebih dahulu');
            </script>";
            return false;
    }

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if(!in_array($ekstensiGambar, $ekstensiGambarValid) ) {
        echo "<script>
                alert('yang anda upload bukan gambar')
                </script>";
                return false;
    }

    if( $ukuranFile > 10000000) {
        echo "<script>
                alert('ukuran gambar terlalu besar')
                </script>";
                return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;


    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;
	}

	

	public function Verify($data){
		$return = mysqli_real_escape_string($this->koneksi, $data);
		return $return;

	}

	public function Delete($id){
		$query = "DELETE FROM produk WHERE id=$id";
		$data = mysqli_query($this->koneksi, $query);
		if($data){
			return true;
		} else {
			return false;
		}
	}
} 


?>