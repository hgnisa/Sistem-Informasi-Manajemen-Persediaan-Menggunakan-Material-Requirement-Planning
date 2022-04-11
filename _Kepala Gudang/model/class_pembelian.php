<?php
class pembelian {
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
	
	function tampil_daftar_pembelian() {	
		$bulan = date('m');
		$data = mysqli_query($this->con, "SELECT DISTINCT ID_faktur, ID_supplier FROM pembelian WHERE pb_bulan = '$bulan'");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;	
	}
	
	function tampil_daftar_pembelian_2($ID_faktur) {	
		$data = mysqli_query($this->con, "SELECT * FROM pembelian WHERE ID_faktur = '$ID_faktur'");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;	
	}
	
	function bahanbaku() {	
		$data = mysqli_query($this->con, "SELECT * FROM bahanbaku");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;	
	}
	
	function ukuran() {	
		$data = mysqli_query($this->con, "SELECT * FROM ukuran");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;	
	}
	
	function tampil_kode_bahanbaku($deskripsi) {	
		$data = mysqli_query($this->con, "SELECT * FROM bahanbaku WHERE deskripsi = '$deskripsi'");
		while ($d = mysqli_fetch_array($data)) {
			$hasil = $d['ID_bahanbaku'];
		}
		return $hasil;	
	}
	
	function beli ($deskripsi){
		$tanggal = date('d-m-Y');
		$query = mysqli_query($this->con, "SELECT * FROM bahanbaku WHERE deskripsi = '$deskripsi'");
		while($m = mysqli_fetch_array($query))
		{
			$ID_bahanbaku = $m['ID_bahanbaku'];
			
			$data = mysqli_query($this->con, "SELECT * FROM bahanbaku JOIN mrp ON bahanbaku.ID_bahanbaku = mrp.ID_bahanbaku JOIN supplier ON bahanbaku.ID_supplier = supplier.ID_supplier WHERE mrp.tanggal = '$tanggal' AND mrp.ID_bahanbaku = '$ID_bahanbaku'");
			while($d = mysqli_fetch_array($data))
			{
				$hasil[] = $d;
			}
		}
		return $hasil;
	}
	
	function supplier (){
		$query = mysqli_query($this->con, "SELECT * from supplier");
		while($d = mysqli_fetch_array($query))
		{
			$hasil[] = $d;
		}
		return $hasil;
	}
	
	function supplier_2 ($ID_supplier){
		$query = mysqli_query($this->con, "SELECT * from supplier WHERE ID_supplier = '$ID_supplier'");
		while($d = mysqli_fetch_array($query))
		{
			$hasil[] = $d;
		}
		return $hasil;
	}
	
	function keranjang_tambah ($ID_supplier, $ID_bahanbaku, $jumlah, $hari_sampai) {
		mysqli_query($this->con, "INSERT INTO keranjang(ID_supplier, ID_bahanbaku, jumlah, hari_sampai)VALUES('$ID_supplier', '$ID_bahanbaku', '$jumlah', '$hari_sampai')");
	}
	
	function keranjang_hapus ($ID_keranjang) {
		mysqli_query($this->con, "DELETE FROM keranjang WHERE ID_keranjang = '$ID_keranjang'");
	}
	
	function input ($ID_pembelian, $ID_faktur, $ID_supplier, $ID_bahanbaku, $pb_date, $pb_date_tiba, $pb_laporan, $pb_bulan, $pb_jumlah, $pb_status, $pb_porel) {
		mysqli_query($this->con, "INSERT INTO pembelian(ID_pembelian, ID_faktur, ID_supplier, ID_bahanbaku, pb_date, pb_date_tiba, pb_laporan, pb_bulan, pb_jumlah, pb_status, pb_porel)VALUES('$ID_pembelian', '$ID_faktur', '$ID_supplier', '$ID_bahanbaku', '$pb_date', '$pb_date_tiba', '$pb_laporan', '$pb_bulan', '$pb_jumlah', '$pb_status', '$pb_porel')");
	}
	
	function tampil_faktur ($ID_faktur){
		$query = mysqli_query($this->con, "SELECT * from pembelian INNER JOIN bahanbaku on pembelian.ID_bahanbaku = bahanbaku.ID_bahanbaku WHERE pembelian.ID_faktur = '$ID_faktur'");
		while($d = mysqli_fetch_array($query))
		{
			$hasil[] = $d;
		}
		return $hasil;
	}
	
	function tampil_detail_faktur ($ID_faktur){
		$query = mysqli_query($this->con, "SELECT * FROM pembelian INNER JOIN supplier ON pembelian.ID_supplier = supplier.ID_supplier WHERE ID_faktur = '$ID_faktur'");
		while($d = mysqli_fetch_array($query))
		{
			$hasil[] = $d;
		}
		return $hasil;
	}
}
?>