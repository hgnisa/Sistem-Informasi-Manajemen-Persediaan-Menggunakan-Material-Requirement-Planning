<?php

class mrp {
	var $host = "localhost";
	var $uname = "root";
	var $pass = "";
	var $db = "ollanda";
	var $con;

	function __construct () {
		$this->con = mysqli_connect($this->host, $this->uname, $this->pass, $this->db);
		mysqli_select_db($this->con,$this->db);
	}
	
	function tampil_bulan ($bulan_angka) {
		if ($bulan_angka == 1){
			$bulan = "Januari";
		}else if ($bulan_angka == 2){
			$bulan = "Februari";
		}else if ($bulan_angka == 3){
			$bulan = "Maret";
		}else if ($bulan_angka == 4){
			$bulan = "April";
		}else if ($bulan_angka == 5){
			$bulan = "Mei";
		}else if ($bulan_angka == 6){
			$bulan = "Juni";
		}else if ($bulan_angka == 7){
			$bulan = "Juli";
		}else if ($bulan_angka == 8){
			$bulan = "Agustus";
		}else if ($bulan_angka == 9){
			$bulan = "September";
		}else if ($bulan_angka == 10){
			$bulan = "Oktober";
		}else if ($bulan_angka == 11){
			$bulan = "November";
		}else if ($bulan_angka == 12){
			$bulan = "Desember";
		}
		return $bulan; 
	}

	function tampil_sisahari ($porel) {
		$bulan = date('m');
		$bulan_porel = substr($porel, 3, 2);
		if($bulan_porel == $bulan){
			$tgl = new DateTime(date("Y-m-d", strtotime($porel)));
			$today =  new DateTime(date("Y-m-d"));
			$diff = $today->diff($tgl);
			$diff->d;
		}
		return $diff->d;
	}
	
	function tampil_mrp_hasil () {
	$data = mysqli_query($this->con, "SELECT * from mrp INNER JOIN bahanbaku ON mrp.ID_bahanbaku = bahanbaku.ID_bahanbaku");
	while ($d = mysqli_fetch_array($data)) {
		$hasil[] = $d;
	}
	return $hasil;
	}
	
	//TAMPIL TABLE PERHITUNGAN MRP (PRODUK)
			function tampil_mrp_produk () {
			$data = mysqli_query($this->con, "SELECT * from mrp_perhitungan_produk");
			while ($d = mysqli_fetch_array($data)) {
				$hasil[] = $d;
			}
			return $hasil;
			}
			
	//TAMPIL TABLE PERHITUNGAN MRP - KECIL
			function tampil_mrp_bahanbaku () {
			$data = mysqli_query($this->con, "SELECT DISTINCT ID_bahanbaku from mrp_perhitungan ORDER BY ID_perhitungan ASC");
			while ($d = mysqli_fetch_array($data)) {
				$hasil[] = $d;
			}
			return $hasil;
			}
			
			function tampil_mrp_kecil($ID_bahanbaku) {
			$data = mysqli_query($this->con, "SELECT * FROM bahanbaku INNER JOIN bom ON bahanbaku.ID_bahanbaku = bom.ID_bahanbaku WHERE bahanbaku.ID_bahanbaku = '$ID_bahanbaku'");
			while ($d = mysqli_fetch_array($data)) {
				$hasil[] = $d;
			}
			return $hasil;
			}
	
	//TAMPIL TABLE PERHITUNGAN MRP - KECIL
			function tampil_bahanbaku ($ID_bahanbaku) {
			$data = mysqli_query($this->con, "SELECT * from bahanbaku WHERE ID_bahanbaku = '$ID_bahanbaku'");
			while ($d = mysqli_fetch_array($data)) {
				$hasil[] = $d;
			}
			return $hasil;
			}
	
			function tampil_mrp_besar ($ID_bahanbaku) {
			$data = mysqli_query($this->con, "SELECT * from mrp_perhitungan WHERE ID_bahanbaku = '$ID_bahanbaku'");
			while ($d = mysqli_fetch_array($data)) {
				$hasil[] = $d;
			}
			return $hasil;
			}
			
			function tampil_mrp_besar_net ($ID_bahanbaku,$tgl) {
			$data = mysqli_query($this->con, "SELECT * from mrp_perhitungan WHERE ID_bahanbaku = '$ID_bahanbaku' AND tgl = '$tgl'");
			while ($d = mysqli_fetch_array($data)) {
				$hasil = $d['net'];
				
				if($hasil == NULL){
					$final = " ";
				}
				else{
					$final = $hasil;
				}
			}
			return $final;
			}
			
			
			function tampil_mrp_besar_porec ($ID_bahanbaku,$tgl) {
			$data = mysqli_query($this->con, "SELECT * from mrp_perhitungan WHERE ID_bahanbaku = '$ID_bahanbaku' AND tgl = '$tgl'");
			while ($d = mysqli_fetch_array($data)) {
				$hasil = $d['porec'];
				
				if($hasil == NULL){
					$final = " ";
				}
				else{
					$final = $hasil;
				}
			}
			return $final;
			}
			
			
			function tampil_mrp_besar_porel ($ID_bahanbaku,$tgl) {
			$data = mysqli_query($this->con, "SELECT * from mrp_perhitungan WHERE ID_bahanbaku = '$ID_bahanbaku' AND tgl = '$tgl'");
			while ($d = mysqli_fetch_array($data)) {
				$hasil = $d['porel'];
				
				if($hasil == NULL){
					$final = " ";
				}
				else{
					$final = $hasil;
				}
			}
			return $final;
			}
			
	//PERHITUNGAN MRP
	function tampil_peramalan ($ID_peramalan) {
			$data = mysqli_query($this->con, "SELECT * from peramalan WHERE ID = '$ID_peramalan'");
			while ($d = mysqli_fetch_array($data)) {
				$hasil = $d['forecast'];
			}
			return $hasil;
			}
}
?>