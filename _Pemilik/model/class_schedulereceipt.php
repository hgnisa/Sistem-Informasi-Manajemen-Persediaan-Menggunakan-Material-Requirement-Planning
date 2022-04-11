<?php

class schedulereceipt {
	var $host = "localhost";
	var $uname = "root";
	var $pass = "";
	var $db = "ollanda";
	var $con;

	function __construct () {
		$this->con = mysqli_connect($this->host, $this->uname, $this->pass, $this->db);
		mysqli_select_db($this->con,$this->db);
	}
	
	function input ($ID_produk,$tanggal, $bulan, $jumlah) {
		mysqli_query($this->con, "INSERT INTO bom_temp1(ID_produk, tanggal, bulan, jumlah)VALUES('$ID_produk','$tanggal', '$bulan', '$jumlah')");
	}
	
	function hapus ($ID_sr) {
		mysqli_query($this->con, "DELETE FROM bom_temp1 WHERE ID_sr='$ID_sr'");
	}
	
	function edit ($ID_sr){
		$data = mysqli_query($this->con, "SELECT * FROM bom_temp1 WHERE ID_sr='$ID_sr'");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}
	
	function update ($ID_sr, $jumlah) {
		mysqli_query ($this->con, "UPDATE bom_temp1 SET jumlah = '$jumlah' WHERE ID_sr = '$ID_sr'");
	}
}
?>