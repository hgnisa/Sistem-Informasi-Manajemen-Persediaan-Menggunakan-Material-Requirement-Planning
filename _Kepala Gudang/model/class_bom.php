<?php

class bom {
	var $host = "localhost";
	var $uname = "root";
	var $pass = "";
	var $db = "ollanda";
	var $con;

	function __construct () {
		$this->con = mysqli_connect($this->host, $this->uname, $this->pass, $this->db);
		mysqli_select_db($this->con,$this->db);
	}
	
	
	function tampil_bom_bahanbaku () {
	$data = mysqli_query($this->con, "select * from bom INNER JOIN bahanbaku on bom.ID_bahanbaku = bahanbaku.ID_bahanbaku");
	while ($d = mysqli_fetch_array($data)) {
		$hasil[] = $d;
	}
	return $hasil;
	}
	
	
	function tampil_kode () {
	$data = mysqli_query($this->con, "SELECT substr((max(ID_bom)), 5, 3) as maxKode FROM bom");
	while ($d = mysqli_fetch_array($data)) {
		$ID_bom = $d['maxKode'];
		$ID_bom = $ID_bom + 1;
		
		if ($ID_bom < 10){
			$char = "BOM-00";
			$final = $char . $ID_bom;
		}
		else{
			$char = "BOM-0";
			$final = $char . $ID_bom;
		}
	}
	return $final;
	}
	
	
	function tampil_bahanbaku () {
		$data = mysqli_query($this->con, "SELECT * FROM bahanbaku");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}
	
	
	function input ($ID_produk, $ID_bahanbaku, $bom) {
		mysqli_query($this->con, "INSERT INTO bom(ID_produk, ID_bahanbaku, bom)VALUES('$ID_produk','$ID_bahanbaku','$bom')");
	}
	
	
	function hapus ($id) {
		mysqli_query($this->con, "DELETE FROM bom WHERE ID_bom='$id'");
	}
	
	
	function edit ($id){
		$data = mysqli_query($this->con, "SELECT * FROM bom WHERE ID_bom ='$id'");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}
	
	
	function update ($ID_bom, $bom) {
		mysqli_query ($this->con, "UPDATE bom SET bom = '$bom' WHERE ID_bom = '$ID_bom'");
	}
}
?>