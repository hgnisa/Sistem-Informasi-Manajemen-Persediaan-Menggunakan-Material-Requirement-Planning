<?php

class grafik {
	var $host = "localhost";
	var $uname = "root";
	var $pass = "";
	var $db = "ollanda";
	var $con;
	
	function __construct () {
		$this->con = mysqli_connect($this->host, $this->uname, $this->pass, $this->db);
		mysqli_select_db($this->con,$this->db);
	}
	
	//PENJUALAN
	function pj_jan($ID_produk, $tahun){
		$tahun = $tahun + 1;
		$data = mysqli_query($this->con, "SELECT SUM(pj_jumlah) as pj_jan FROM penjualan WHERE pj_bulan='01' AND pj_tahun='$tahun' AND ID_produk = '$ID_produk'");
		while ($d = mysqli_fetch_array($data)) {
			print $d['pj_jan'];
		}
	}
	
	function pj_feb($ID_produk, $tahun){
		$tahun = $tahun + 1;
		$data = mysqli_query($this->con, "SELECT SUM(pj_jumlah) as pj_feb FROM penjualan WHERE pj_bulan='02' AND pj_tahun='$tahun' AND ID_produk = '$ID_produk'");
		while ($d = mysqli_fetch_array($data)) {
			print $d['pj_feb'];
		}
	}
	
	function pj_mar($ID_produk, $tahun){
		$tahun = $tahun + 1;
		$data = mysqli_query($this->con, "SELECT SUM(pj_jumlah) as pj_mar FROM penjualan WHERE pj_bulan='03' AND pj_tahun='$tahun' AND ID_produk = '$ID_produk'");
		while ($d = mysqli_fetch_array($data)) {
			print $d['pj_mar'];
		}
	}
	
	function pj_apr($ID_produk, $tahun){
		$tahun = $tahun + 1;
		$data = mysqli_query($this->con, "SELECT SUM(pj_jumlah) as pj_apr FROM penjualan WHERE pj_bulan='04' AND pj_tahun='$tahun' AND ID_produk = '$ID_produk'");
		while ($d = mysqli_fetch_array($data)) {
			print $d['pj_apr'];
		}
	}
	
	function pj_mei($ID_produk, $tahun){
		$tahun = $tahun + 1;
		$data = mysqli_query($this->con, "SELECT SUM(pj_jumlah) as pj_mei FROM penjualan WHERE pj_bulan='05' AND pj_tahun='$tahun' AND ID_produk = '$ID_produk'");
		while ($d = mysqli_fetch_array($data)) {
			print $d['pj_mei'];
		}
	}
	
	function pj_jun($ID_produk, $tahun){
		$tahun = $tahun + 1;
		$data = mysqli_query($this->con, "SELECT SUM(pj_jumlah) as pj_jun FROM penjualan WHERE pj_bulan='06' AND pj_tahun='$tahun' AND ID_produk = '$ID_produk'");
		while ($d = mysqli_fetch_array($data)) {
			print $d['pj_jun'];
		}
	}
	
	function pj_jul($ID_produk, $tahun){
		$tahun = $tahun + 1;
		$data = mysqli_query($this->con, "SELECT SUM(pj_jumlah) as pj_jul FROM penjualan WHERE pj_bulan='07' AND pj_tahun='$tahun' AND ID_produk = '$ID_produk'");
		while ($d = mysqli_fetch_array($data)) {
			print $d['pj_jul'];
		}
	}
	function pj_agt($ID_produk, $tahun){
		$tahun = $tahun + 1;
		$data = mysqli_query($this->con, "SELECT SUM(pj_jumlah) as pj_agt FROM penjualan WHERE pj_bulan='08' AND pj_tahun='$tahun' AND ID_produk = '$ID_produk'");
		while ($d = mysqli_fetch_array($data)) {
			print $d['pj_agt'];
		}
	}
	
	function pj_sep($ID_produk, $tahun){
		$tahun = $tahun + 1;
		$data = mysqli_query($this->con, "SELECT SUM(pj_jumlah) as pj_sep FROM penjualan WHERE pj_bulan='09' AND pj_tahun='$tahun' AND ID_produk = '$ID_produk'");
		while ($d = mysqli_fetch_array($data)) {
			print $d['pj_sep'];
		}
	}
	
	function pj_okt($ID_produk, $tahun){
		$tahun = $tahun + 1;
		$data = mysqli_query($this->con, "SELECT SUM(pj_jumlah) as pj_okt FROM penjualan WHERE pj_bulan='10' AND pj_tahun='$tahun' AND ID_produk = '$ID_produk'");
		while ($d = mysqli_fetch_array($data)) {
			print $d['pj_okt'];
		}
	}
	
	function pj_nov($ID_produk, $tahun){
		$tahun = $tahun + 1;
		$data = mysqli_query($this->con, "SELECT SUM(pj_jumlah) as pj_nov FROM penjualan WHERE pj_bulan='11' AND pj_tahun='$tahun' AND ID_produk = '$ID_produk'");
		while ($d = mysqli_fetch_array($data)) {
			print $d['pj_nov'];
		}
	}
	
	function pj_des($ID_produk, $tahun){
		$tahun = $tahun + 1;
		$data = mysqli_query($this->con, "SELECT SUM(pj_jumlah) as pj_des FROM penjualan WHERE pj_bulan='12' AND pj_tahun='$tahun' AND ID_produk = '$ID_produk'");
		while ($d = mysqli_fetch_array($data)) {
			print $d['pj_des'];
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	//PERAMALAN
	function fr_jan($ID_produk, $tampil){
		$data = mysqli_query($this->con, "SELECT * FROM peramalan WHERE bulan='01' AND tahun='$tampil' AND ID_produk = '$ID_produk'");
		while ($d = mysqli_fetch_array($data)) {
			print ROUND($d['forecast']);
		}
	}
	
	function fr_feb($ID_produk, $tampil){
		$data = mysqli_query($this->con, "SELECT * FROM peramalan WHERE bulan='02' AND tahun='$tampil' AND ID_produk = '$ID_produk'");
		while ($d = mysqli_fetch_array($data)) {
			print $d['forecast'];
		}
	}
	
	function fr_mar($ID_produk, $tampil){
		$data = mysqli_query($this->con, "SELECT * FROM peramalan WHERE bulan='03' AND tahun='$tampil' AND ID_produk = '$ID_produk'");
		while ($d = mysqli_fetch_array($data)) {
			print $d['forecast'];
		}
	}
	
	function fr_apr($ID_produk, $tampil){
		$data = mysqli_query($this->con, "SELECT * FROM peramalan WHERE bulan='04' AND tahun='$tampil' AND ID_produk = '$ID_produk'");
		while ($d = mysqli_fetch_array($data)) {
			print $d['forecast'];
		}
	}
	
	function fr_mei($ID_produk, $tampil){
		$data = mysqli_query($this->con, "SELECT * FROM peramalan WHERE bulan='05' AND tahun='$tampil' AND ID_produk = '$ID_produk'");
		while ($d = mysqli_fetch_array($data)) {
			print $d['forecast'];
		}
	}
	
	function fr_jun($ID_produk, $tampil){
		$data = mysqli_query($this->con, "SELECT * FROM peramalan WHERE bulan='06' AND tahun='$tampil' AND ID_produk = '$ID_produk'");
		while ($d = mysqli_fetch_array($data)) {
			print $d['forecast'];
		}
	}
	
	function fr_jul($ID_produk, $tampil){
		$data = mysqli_query($this->con, "SELECT * FROM peramalan WHERE bulan='07' AND tahun='$tampil' AND ID_produk = '$ID_produk'");
		while ($d = mysqli_fetch_array($data)) {
			print $d['forecast'];
		}
	}
	
	function fr_agt($ID_produk, $tampil){
		$data = mysqli_query($this->con, "SELECT * FROM peramalan WHERE bulan='08' AND tahun='$tampil' AND ID_produk = '$ID_produk'");
		while ($d = mysqli_fetch_array($data)) {
			print $d['forecast'];
		}
	}
	
	function fr_sep($ID_produk, $tampil){
		$data = mysqli_query($this->con, "SELECT * FROM peramalan WHERE bulan='09' AND tahun='$tampil' AND ID_produk = '$ID_produk'");
		while ($d = mysqli_fetch_array($data)) {
			print $d['forecast'];
		}
	}
	
	function fr_okt($ID_produk, $tampil){
		$data = mysqli_query($this->con, "SELECT * FROM peramalan WHERE bulan='10' AND tahun='$tampil' AND ID_produk = '$ID_produk'");
		while ($d = mysqli_fetch_array($data)) {
			print $d['forecast'];
		}
	}
	
	function fr_nov($ID_produk, $tampil){
		$ID = $tampil."-11";
		$data = mysqli_query($this->con, "SELECT * FROM peramalan WHERE bulan='11' AND tahun='$tampil' AND ID_produk = '$ID_produk'");
		while ($d = mysqli_fetch_array($data)) {
			print $d['forecast'];
		}
	}
	
	function fr_des($ID_produk, $tampil){
		$data = mysqli_query($this->con, "SELECT * FROM peramalan WHERE bulan='12' AND tahun='$tampil' AND ID_produk = '$ID_produk'");
		while ($d = mysqli_fetch_array($data)) {
			print $d['forecast'];
		}
	}
	
	
	
	
	
	
	
	
	
	//DATA HISTORI
	function dt_jan($ID_produk, $tampil){
		$data = mysqli_query($this->con, "SELECT * FROM peramalan WHERE bulan='01' AND tahun='$tampil' AND ID_produk = '$ID_produk'");
		while ($d = mysqli_fetch_array($data)) {
			print $d['jumlah'];
		}
	}
	
	function dt_feb($ID_produk, $tampil){
		$data = mysqli_query($this->con, "SELECT * FROM peramalan WHERE bulan='02' AND tahun='$tampil' AND ID_produk = '$ID_produk'");
		while ($d = mysqli_fetch_array($data)) {
			print $d['jumlah'];
		}
	}
	
	function dt_mar($ID_produk, $tampil){
		$data = mysqli_query($this->con, "SELECT * FROM peramalan WHERE bulan='03' AND tahun='$tampil' AND ID_produk = '$ID_produk'");
		while ($d = mysqli_fetch_array($data)) {
			print $d['jumlah'];
		}
	}
	
	function dt_apr($ID_produk, $tampil){
		$data = mysqli_query($this->con, "SELECT * FROM peramalan WHERE bulan='04' AND tahun='$tampil' AND ID_produk = '$ID_produk'");
		while ($d = mysqli_fetch_array($data)) {
			print $d['jumlah'];
		}
	}
	
	function dt_mei($ID_produk, $tampil){
		$data = mysqli_query($this->con, "SELECT * FROM peramalan WHERE bulan='05' AND tahun='$tampil' AND ID_produk = '$ID_produk'");
		while ($d = mysqli_fetch_array($data)) {
			print $d['jumlah'];
		}
	}
	
	function dt_jun($ID_produk, $tampil){
		$data = mysqli_query($this->con, "SELECT * FROM peramalan WHERE bulan='06' AND tahun='$tampil' AND ID_produk = '$ID_produk'");
		while ($d = mysqli_fetch_array($data)) {
			print $d['jumlah'];
		}
	}
	
	function dt_jul($ID_produk, $tampil){
		$data = mysqli_query($this->con, "SELECT * FROM peramalan WHERE bulan='07' AND tahun='$tampil' AND ID_produk = '$ID_produk'");
		while ($d = mysqli_fetch_array($data)) {
			print $d['jumlah'];
		}
	}
	
	function dt_agt($ID_produk, $tampil){
		$data = mysqli_query($this->con, "SELECT * FROM peramalan WHERE bulan='08' AND tahun='$tampil' AND ID_produk = '$ID_produk'");
		while ($d = mysqli_fetch_array($data)) {
			print $d['jumlah'];
		}
	}
	
	function dt_sep($ID_produk, $tampil){
		$data = mysqli_query($this->con, "SELECT * FROM peramalan WHERE bulan='09' AND tahun='$tampil' AND ID_produk = '$ID_produk'");
		while ($d = mysqli_fetch_array($data)) {
			print $d['jumlah'];
		}
	}
	
	function dt_okt($ID_produk, $tampil){
		$data = mysqli_query($this->con, "SELECT * FROM peramalan WHERE bulan='10' AND tahun='$tampil' AND ID_produk = '$ID_produk'");
		while ($d = mysqli_fetch_array($data)) {
			print $d['jumlah'];
		}
	}
	
	function dt_nov($ID_produk, $tampil){
		$ID = $tampil."-11";
		$data = mysqli_query($this->con, "SELECT * FROM peramalan WHERE bulan='11' AND tahun='$tampil' AND ID_produk = '$ID_produk'");
		while ($d = mysqli_fetch_array($data)) {
			print $d['jumlah'];
		}
	}
	
	function dt_des($ID_produk, $tampil){
		$data = mysqli_query($this->con, "SELECT * FROM peramalan WHERE bulan='12' AND tahun='$tampil' AND ID_produk = '$ID_produk'");
		while ($d = mysqli_fetch_array($data)) {
			print $d['jumlah'];
		}
	}
}
?>