<?php
class produk {
	var $host = "localhost";
	var $uname = "root";
	var $pass = "";
	var $db = "ollanda";
	var $con;

	function __construct () {
		$this->con = mysqli_connect($this->host, $this->uname, $this->pass, $this->db);
		mysqli_select_db($this->con,$this->db);
	}
	
	
	function tampil_produk () {
	$data = mysqli_query($this->con, "select * from produk");
	while ($d = mysqli_fetch_array($data)) {
		$hasil[] = $d;
	}
	return $hasil;
	}
	
	function tampil_bahanbaku () {
	$data = mysqli_query($this->con, "select * from bahanbaku");
	while ($d = mysqli_fetch_array($data)) {
		$hasil[] = $d;
	}
	return $hasil;
	}
	
	function tampil_nama_produk ($ID_produk) {
	$data = mysqli_query($this->con, "select * from produk WHERE ID_produk = '$ID_produk'");
	while ($d = mysqli_fetch_array($data)) {
		$hasil = $d['nama_produk'];
	}
	return $hasil;
	}
	
	function tampil_bom ($ID_produk) {
	$data = mysqli_query($this->con, "select * from bom INNER JOIN bahanbaku ON bom.ID_bahanbaku = bahanbaku.ID_bahanbaku WHERE bom.ID_produk = '$ID_produk'");
	while ($d = mysqli_fetch_array($data)) {
		$hasil[] = $d;
	}
	return $hasil;
	}
	
	function tampil_kode () {
	$data = mysqli_query($this->con, "SELECT substr((max(ID_produk)), 3, 3) as maxKode FROM produk");
	while ($d = mysqli_fetch_array($data)) {
		$ID_produk = $d['maxKode'];
		$ID_produk = $ID_produk + 1;
		
		if ($ID_produk< 10){
			$char = "P-00";
			$final = $char . $ID_produk;
		}
		else{
			$char = "P-0";
			$final = $char . $ID_produk;
		}
	}
	return $final;
	}
	
	function input ($ID_produk, $nama_produk) {
		mysqli_query($this->con, "INSERT INTO produk(ID_produk, nama_produk)VALUES('$ID_produk', '$nama_produk')");
	}
	
	
	function hapus ($ID_produk) {
		mysqli_query($this->con, "DELETE FROM produk WHERE ID_produk ='$ID_produk'");
	}
	
	
	function edit ($ID_produk){
		$data = mysqli_query($this->con, "SELECT * FROM produk WHERE ID_produk ='$ID_produk'");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}
	
	
	function update ($ID_produk, $nama_produk) {
		mysqli_query ($this->con, "UPDATE produk SET nama_produk = '$nama_produk' WHERE ID_produk = '$ID_produk'");
	}
}
?>