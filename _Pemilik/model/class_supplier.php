<?php
class supplier {
	var $host = "localhost";
	var $uname = "root";
	var $pass = "";
	var $db = "ollanda";
	var $con;

	function __construct () {
		$this->con = mysqli_connect($this->host, $this->uname, $this->pass, $this->db);
		mysqli_select_db($this->con,$this->db);
	}
	
	
	function tampil_supplier () {
	$data = mysqli_query($this->con, "select * from supplier");
	while ($d = mysqli_fetch_array($data)) {
		$hasil[] = $d;
	}
	return $hasil;
	}
	
	function kode_supplier () {
		$data = mysqli_query($this->con, "SELECT substr((max(ID_supplier)), 5, 3) as maxKode FROM supplier");
		while ($d = mysqli_fetch_array($data)) {
			$ID1= $d['maxKode'];
			$ID1 = $ID1 + 1;
			
			if ($ID1 < 10){
				$char = "SUP-00";
				$final = $char . $ID1;
			}
			else{
				$char = "SUP-0";
				$final = $char . $ID1;
			}
		}
	return $final;
	}
	
	function input ($ID_supplier, $nama_supplier, $alamat_supplier, $telp_supplier, $email_supplier) {
		mysqli_query($this->con, "INSERT INTO supplier(ID_supplier,nama_supplier,alamat_supplier,telp_supplier,email_supplier)VALUES('$ID_supplier','$nama_supplier','$alamat_supplier','$telp_supplier','$email_supplier')");
	}
	
	
	function hapus ($id) {
		mysqli_query($this->con, "DELETE FROM supplier WHERE ID_supplier='$id'");
	}
	
	
	function edit ($id){
		$data = mysqli_query($this->con, "SELECT * FROM supplier WHERE ID_supplier = '$id'");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}
	
	
	function update ($ID_supplier, $nama_supplier, $alamat_supplier, $telp_supplier, $email_supplier) {
		mysqli_query ($this->con, "UPDATE supplier SET ID_supplier = '$ID_supplier', nama_supplier = '$nama_supplier', alamat_supplier = '$alamat_supplier', telp_supplier = '$telp_supplier', email_supplier = '$email_supplier' WHERE ID_supplier = '$ID_supplier'");
	}
}
?>