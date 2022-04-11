<?php

class peramalan {
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

	function tampil_tahun_inputperamalan () {
		$data = mysqli_query($this->con, "SELECT substr((max(ID)), 1, 4) as maxKode FROM peramalan");
		while ($d = mysqli_fetch_array($data)) {
			$hasil = $d['maxKode'];
		}
		return $hasil;
	}
	
	
	function daftar_hasil_peramalan ($tahun) {
		$data = mysqli_query($this->con, "SELECT * from peramalan WHERE tahun = '$tahun' ORDER BY ID");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}
	
	
	function ambil_penjualan_jan () {
		$tahun_ini = date('Y');
		$data = mysqli_query($this->con, "SELECT SUM(pj_jumlah) as Jumlah FROM penjualan WHERE pj_bulan = '01' AND pj_tahun = '$tahun_ini'");
		while ($d = mysqli_fetch_array($data)) {
			$hasil = $d['Jumlah'];
			
			if($hasil == null){ 
				$hasil = 0; 
			} 
			else { 
				$hasil = $hasil;
			}
		}
		return $hasil;
	}
	
	function ambil_penjualan_feb () {
		$tahun_ini = date('Y');
		$data = mysqli_query($this->con, "SELECT SUM(pj_jumlah) as Jumlah FROM penjualan WHERE pj_bulan = '02' AND pj_tahun = '$tahun_ini'");
		while ($d = mysqli_fetch_array($data)) {
			$hasil = $d['Jumlah'];
			
			if($hasil == null){ 
				$hasil = 0; 
			} 
			else { 
				$hasil = $hasil;
			}
		}
		return $hasil;
	}
	
	function ambil_penjualan_mar () {
		$tahun_ini = date('Y');
		$data = mysqli_query($this->con, "SELECT SUM(pj_jumlah) as Jumlah FROM penjualan WHERE pj_bulan = '03' AND pj_tahun = '$tahun_ini'");
		while ($d = mysqli_fetch_array($data)) {
			$hasil = $d['Jumlah'];
			
			if($hasil == null){ 
				$hasil = 0; 
			} 
			else { 
				$hasil = $hasil;
			}
		}
		return $hasil;
	}

	function ambil_penjualan_apr () {
		$tahun_ini = date('Y');
		$data = mysqli_query($this->con, "SELECT SUM(pj_jumlah) as Jumlah FROM penjualan WHERE pj_bulan = '04' AND pj_tahun = '$tahun_ini'");
		while ($d = mysqli_fetch_array($data)) {
			$hasil = $d['Jumlah'];
			
			if($hasil == null){ 
				$hasil = 0; 
			} 
			else { 
				$hasil = $hasil;
			}
		}
		return $hasil;
	}
	
	function ambil_penjualan_mei () {
		$tahun_ini = date('Y');
		$data = mysqli_query($this->con, "SELECT SUM(pj_jumlah) as Jumlah FROM penjualan WHERE pj_bulan = '05' AND pj_tahun = '$tahun_ini'");
		while ($d = mysqli_fetch_array($data)) {
			$hasil = $d['Jumlah'];
			
			if($hasil == null){ 
				$hasil = 0; 
			} 
			else { 
				$hasil = $hasil;
			}
		}
		return $hasil;
	}
	
	function ambil_penjualan_jun () {
		$tahun_ini = date('Y');
		$data = mysqli_query($this->con, "SELECT SUM(pj_jumlah) as Jumlah FROM penjualan WHERE pj_bulan = '06' AND pj_tahun = '$tahun_ini'");
		while ($d = mysqli_fetch_array($data)) {
			$hasil = $d['Jumlah'];
			
			if($hasil == null){ 
				$hasil = 0; 
			} 
			else { 
				$hasil = $hasil;
			}
		}
		return $hasil;
	}
	
	function ambil_penjualan_jul () {
		$tahun_ini = date('Y');
		$data = mysqli_query($this->con, "SELECT SUM(pj_jumlah) as Jumlah FROM penjualan WHERE pj_bulan = '06' AND pj_tahun = '$tahun_ini'");
		while ($d = mysqli_fetch_array($data)) {
			$hasil = $d['Jumlah'];
			
			if($hasil == null){ 
				$hasil = 0; 
			} 
			else { 
				$hasil = $hasil;
			}
		}
		return $hasil;
	}
	
	function ambil_penjualan_agt () {
		$tahun_ini = date('Y');
		$data = mysqli_query($this->con, "SELECT SUM(pj_jumlah) as Jumlah FROM penjualan WHERE pj_bulan = '08' AND pj_tahun = '$tahun_ini'");
		while ($d = mysqli_fetch_array($data)) {
			$hasil = $d['Jumlah'];
			
			if($hasil == null){ 
				$hasil = 0; 
			} 
			else { 
				$hasil = $hasil;
			}
		}
		return $hasil;
	}
	
	function ambil_penjualan_sep () {
		$tahun_ini = date('Y');
		$data = mysqli_query($this->con, "SELECT SUM(pj_jumlah) as Jumlah FROM penjualan WHERE pj_bulan = '09' AND pj_tahun = '$tahun_ini'");
		while ($d = mysqli_fetch_array($data)) {
			$hasil = $d['Jumlah'];
			
			if($hasil == null){ 
				$hasil = 0; 
			} 
			else { 
				$hasil = $hasil;
			}
		}
		return $hasil;
	}
	
	function ambil_penjualan_okt () {
		$tahun_ini = date('Y');
		$data = mysqli_query($this->con, "SELECT SUM(pj_jumlah) as Jumlah FROM penjualan WHERE pj_bulan = '10' AND pj_tahun = '$tahun_ini'");
		while ($d = mysqli_fetch_array($data)) {
			$hasil = $d['Jumlah'];
			
			if($hasil == null){ 
				$hasil = 0; 
			} 
			else { 
				$hasil = $hasil;
			}
		}
		return $hasil;
	}
	
	function ambil_penjualan_nov () {
		$tahun_ini = date('Y');
		$data = mysqli_query($this->con, "SELECT SUM(pj_jumlah) as Jumlah FROM penjualan WHERE pj_bulan = '11' AND pj_tahun = '$tahun_ini'");
		while ($d = mysqli_fetch_array($data)) {
			$hasil = $d['Jumlah'];
			
			if($hasil == null){ 
				$hasil = 0; 
			} 
			else { 
				$hasil = $hasil;
			}
		}
		return $hasil;
	}
	
	function ambil_penjualan_des () {
		$tahun_ini = date('Y');
		$data = mysqli_query($this->con, "SELECT SUM(pj_jumlah) as Jumlah FROM penjualan WHERE pj_bulan = '12' AND pj_tahun = '$tahun_ini'");
		while ($d = mysqli_fetch_array($data)) {
			$hasil = $d['Jumlah'];
			
			if($hasil == null){ 
				$hasil = 0; 
			} 
			else { 
				$hasil = $hasil;
			}
		}
		return $hasil;
	}

}
?>