<?php
class produksi {
	var $host = "localhost";
	var $uname = "root";
	var $pass = "";
	var $db = "ollanda";
	var $con;
	
	public $ID_produksi;
	public $pj_produk;
	public $pj_date;
	
	function __construct () {
		$this->con = mysqli_connect($this->host, $this->uname, $this->pass, $this->db);
		mysqli_select_db($this->con,$this->db);
	}
	
	
	function tampil_nama_bulan($bulan){
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
		print $nama;
	}
	
	function tampilsemua(){
		$data = mysqli_query($this->con, "SELECT * FROM produksi");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}
	
	function tampil_stok_produk($ID_produk){
		$tanggal = date('d-m-Y');
		$data = mysqli_query($this->con, "SELECT * FROM produksi WHERE pr_date = '$tanggal' AND ID_produk = '$ID_produk'");
		while ($d = mysqli_fetch_array($data)) {
			$hasil = $d['pr_jual'];
		}
		return $hasil;
	}
	
	function tampil_produksi($bulan){
		$data = mysqli_query($this->con, "SELECT * FROM produksi WHERE pr_bulan = '$bulan'");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}
	
	function hapus ($id) {
		mysqli_query($this->con, "DELETE FROM produksi_temp WHERE ID_produksi='$id'");
	}
	
	function input ($ID_produksi, $ID_produk, $pr_date, $pr_laporan, $pr_bulan, $pr_tahun, $pr_ramal, $pr_tambahan, $pr_sr, $pr_total, $pr_jual) {
		mysqli_query($this->con, "INSERT INTO produksi(ID_produksi, ID_produk, pr_date, pr_laporan, pr_bulan, pr_tahun, pr_ramal, pr_tambahan, pr_sr, pr_total, pr_jual)VALUES('$ID_produksi', '$ID_produk', '$pr_date', '$pr_laporan', '$pr_bulan', '$pr_tahun', '$pr_ramal', '$pr_tambahan', '$pr_sr', '$pr_total', '$pr_jual')");
	}
}
?>