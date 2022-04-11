<?php
class penjualan {
	var $host = "localhost";
	var $uname = "root";
	var $pass = "";
	var $db = "ollanda";
	var $con;

	function __construct () {
		$this->con = mysqli_connect($this->host, $this->uname, $this->pass, $this->db);
		mysqli_select_db($this->con,$this->db);
	}
	
	function tampil_namabulan($bulan) {
		switch ($bulan){
		case 1:
			$nama = "Januari";
			break;
		case 2:
			$nama = "Februari";
			break;
		case 3:
			$nama = "Maret";
			break;
		case 4:
			$nama = "April";
			break;
		case 5:
			$nama = "Mei";
			break;
		case 6:
			$nama = "Juni";
			break;
		case 7:
			$nama = "Juli";
			break;
		case 8:
			$nama = "Agustus";
			break;
		case 9:
			$nama = "September";
			break;
		case 10:
			$nama = "Oktober";
			break;
		case 11:
			$nama = "November";
			break;
		case 12:
			$nama = "Desember";
			break;
		default:
			$nama = "";
			break;
		}
	return $nama;
	}
	
	function tampil_penjualan() {
		$bulan = date('m');
		$tahun = date('Y');
		$data = mysqli_query($this->con, "SELECT * FROM penjualan WHERE pj_bulan = '$bulan' AND pj_tahun = '$tahun'");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
	return $hasil;
	}
	
	function tampil_produk() {
		$data = mysqli_query($this->con, "SELECT * FROM produk");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
	return $hasil;
	}
	
	function tampil_stok() {
		$hari_ini = date('d-m-Y');
		$data = mysqli_query($this->con, "SELECT SUM(pr_jual) as ReadyStock from produksi WHERE pr_date = '$hari_ini'");
		while ($m = mysqli_fetch_array($data)) {
			$stock = $m['ReadyStock'];
			
			if ($stock != null){ 
				$final = $stock;
			}
			else{
				 $final = "0";
			}
		}
	return $final;
	}
	
	function input ($ID_penjualan, $ID_produk, $pj_date, $pj_laporan, $pj_bulan, $pj_tahun, $pj_jumlah, $pj_harga) {
		mysqli_query($this->con, "INSERT INTO penjualan(ID_penjualan,ID_produk,pj_date,pj_laporan,pj_bulan,pj_tahun,pj_jumlah,pj_harga)VALUES('$ID_penjualan','$ID_produk', '$pj_date', '$pj_laporan', '$pj_bulan', '$pj_tahun', '$pj_jumlah', '$pj_harga')");
	}
}
?>