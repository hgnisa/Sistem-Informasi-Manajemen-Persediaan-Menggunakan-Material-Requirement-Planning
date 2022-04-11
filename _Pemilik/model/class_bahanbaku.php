<?php

class bahanbaku {
	var $host = "localhost";
	var $uname = "root";
	var $pass = "";
	var $db = "ollanda";
	var $con;

	function __construct () {
		$this->con = mysqli_connect($this->host, $this->uname, $this->pass, $this->db);
		mysqli_select_db($this->con,$this->db);
	}
	
	
	function tampil_bahanbaku_supplier () {
		$data = mysqli_query($this->con, "select * from bahanbaku INNER JOIN supplier ON bahanbaku.ID_supplier = supplier.ID_supplier");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}
	
	function tampil_bahanbaku($ID_bahanbaku) {
		$data = mysqli_query($this->con, "select * from bahanbaku WHERE ID_bahanbaku = '$ID_bahanbaku'");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}
	
	function tampil_nama_bahanbaku($ID_bahanbaku) {
		$data = mysqli_query($this->con, "select * from bahanbaku WHERE ID_bahanbaku = '$ID_bahanbaku'");
		while ($d = mysqli_fetch_array($data)) {
			$hasil = $d['deskripsi'];
		}
		return $hasil;
	}
	
	function tampil_kode () {
		$data = mysqli_query($this->con, "SELECT substr((max(ID_bahanbaku)), 3, 3) as maxKode FROM bahanbaku");
		while ($d = mysqli_fetch_array($data)) {
			$hasil = $d['maxKode'];
			$hasil = $hasil + 1;
			
			if ($hasil < 10){
				$char = "A-00";
				$final = $char . $hasil;
			}
			else{
				$char = "A-0";
				$final = $char . $hasil;
			}
		}
		return $final;
	}
	
	function tampil_supplier () {
		$data = mysqli_query($this->con, "SELECT * FROM supplier");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}
	
	function input ($ID_bahanbaku, $deskripsi, $qty, $unit, $harga, $safetystock, $lotsize, $leadtime, $ID_supplier) {
		mysqli_query($this->con, "INSERT INTO bahanbaku(ID_bahanbaku,deskripsi,qty,unit,rop,harga,safetystock,lotsize,leadtime,ID_supplier)VALUES('$ID_bahanbaku','$deskripsi','$qty','$unit',0,'$harga','$safetystock','$lotsize','$leadtime','$ID_supplier')");
	}
	
	
	function hapus ($id) {
		mysqli_query($this->con, "DELETE FROM bahanbaku WHERE ID_bahanbaku='$id'");
	}
	
	
	function edit ($id){
		$data = mysqli_query($this->con, "SELECT * FROM bahanbaku WHERE ID_bahanbaku='$id'");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}
	
	function update ($ID_bahanbaku, $deskripsi, $unit, $harga, $safetystock, $lotsize, $ID_supplier) {
		mysqli_query ($this->con, "UPDATE bahanbaku SET ID_bahanbaku = '$ID_bahanbaku', deskripsi = '$deskripsi', unit = '$unit', harga = '$harga', safetystock = '$safetystock', lotsize = '$lotsize', ID_supplier = '$ID_supplier' WHERE ID_bahanbaku = '$ID_bahanbaku'");
	}
}
?>