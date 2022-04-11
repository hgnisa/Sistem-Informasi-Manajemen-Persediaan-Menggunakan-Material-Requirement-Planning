<?php

class notifikasi {
	var $host = "localhost";
	var $uname = "root";
	var $pass = "";
	var $db = "ollanda";
	var $con;

	function __construct () {
		$this->con = mysqli_connect($this->host, $this->uname, $this->pass, $this->db);
		mysqli_select_db($this->con,$this->db);
	}
	
	
	function tampil_notifikasi_rop () {
		$data = mysqli_query($this->con, "SELECT * from bahanbaku WHERE qty <= rop");
		while($m=mysqli_fetch_array($data)){
			if($m['qty']<=$m['rop']){	
			echo"
				<div class='sufee-alert alert with-close alert-danger alert-dismissible fade show'>
				<span class='badge badge-pill badge-danger'>Warning</span>
					&nbsp;Persediaan <b> ".$m['deskripsi']." </b> yang tersisa kurang dari <b> ".$m['rop']." ".$m['unit']." </b> Lakukan pemesanan ke supplier!
					<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
						<span aria-hidden='true'>&times;</span>
					</button>
				</div>";
			}
		}
	}
	
	function tampil_notifikasi_mrp () {
		$data = mysqli_query($this->con, "SELECT * from mrp INNER JOIN bahanbaku ON mrp.ID_bahanbaku=bahanbaku.ID_bahanbaku");
		while($m=mysqli_fetch_array($data)){	
			$bulan = $m['bulan'];
			$porel = $m['tanggal'];
			$status = $m['status'];
			$deskripsi = $m['deskripsi'];
			$ambilbulanPorel = substr($porel, 3, 2);
						
			if($ambilbulanPorel == $bulan){
				$tgl = new DateTime(date("Y-m-d", strtotime($porel)));
				$today =  new DateTime(date("Y-m-d"));
				$diff = $today->diff($tgl);
				$diff->d;
				
				if ((($diff->d) <= 1) AND ($status == 0)){
					$ket = "";
					$skrg = date('d');
					$porel_tgl = substr($porel, 0, 2);
																	
					if($porel_tgl < $skrg){
						$ket = '0';
					}
					else{
						$ket = $diff->d;
					}
					
					echo "<div class='sufee-alert alert with-close alert-warning alert-dismissible fade show'>
						  <span class='badge badge-pill badge-warning'>Warning</span>
						  &nbsp;Jadwal pemesanan bahan baku <b> ".$deskripsi." </b> harus dilakukan ".$ket." hari lagi.
						  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
							<span aria-hidden='true'>&times;</span>
						  </button>
						  </div>";
				}
			}
		}
	}

	function tampil_notifikasi_pembelian () {
		$today = date('d-m-Y');
		$query = mysqli_query($this->con, "SELECT * from pembelian where pb_date_tiba = '$today' AND pb_status = 'Menunggu'");
		while($m = mysqli_fetch_array($query))
		{ 
			$tanggal_tiba = $m['pb_date_tiba'];
			$ID_bahanbaku = $m['ID_bahanbaku'];
					
			$query1 = mysqli_query($this->con, "SELECT * from bahanbaku where ID_bahanbaku = '$ID_bahanbaku'");
			while($n = mysqli_fetch_array($query1))
			{ 
				$deskripsi = $n['deskripsi'];
			}
											
			if($tanggal_tiba != NULL){
				echo "<div class='sufee-alert alert with-close alert-info alert-dismissible fade show'>
					   <span class='badge badge-pill badge-info'>Info</span>
							&nbsp;Bahan baku <b> ".$deskripsi." </b> akan tiba hari ini, mohon untuk konfirmasi pada data pembelian. 
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
								<span aria-hidden='true'>&times;</span>
							</button>
					   </div>";
			}
		}	
	}
	
	function tampil_card1 () {
		$hari_ini = date("d-m-Y");
		$tahun = date('Y');
		$data = mysqli_query($this->con, "SELECT SUM(pj_jumlah) as Jumlah from penjualan WHERE pj_date = '$hari_ini' AND pj_tahun = '$tahun'");
		while($m=mysqli_fetch_array($data)){	
			$jumlah = $m['Jumlah'];
			
			if($jumlah == null){
			$final = 0;
			}
			else{
				$final = $jumlah;
			}
		}
	return $final;
	}
	
	function tampil_card2 () {
		$hari_ini = date("d-m-Y");
		$tahun = date('Y');
		$data = mysqli_query($this->con, "SELECT SUM(pj_harga) as Harga from penjualan WHERE pj_date = '$hari_ini' AND pj_tahun = '$tahun'");
		while($m=mysqli_fetch_array($data)){	
			$harga = $m['Harga'];
			
			if($harga == null){
				$final = 0;
			}
			else{
				$final = $harga;
			}
		}
	return $final;
	}
	
	function tampil_card3 () {
		$hari_ini = date("d-m-Y");
		$tahun = date('Y');
		$data = mysqli_query($this->con, "SELECT SUM(pr_jual) as ReadyStock from produksi WHERE pr_date = '$hari_ini' AND pr_tahun = '$tahun'");
		while($m=mysqli_fetch_array($data)){	
			$stock = $m['ReadyStock'];
			
			if($stock == null){
				$final = 0;
			}
			else{
				$final = $stock;
			}
		}
	return $final;
	}
	
	function tampil_card4 () {
		$bulan_ini = date("m");
		$tahun = date('Y');
		$data = mysqli_query($this->con, "SELECT SUM(pj_jumlah) as ReadyStock from penjualan WHERE pj_bulan = '$bulan_ini' AND pj_tahun = '$tahun'");
		while($m=mysqli_fetch_array($data)){	
			$stock = $m['ReadyStock'];
			
			if($stock == null){
				$final = 0;
			}
			else{
				$final = $stock;
			}
		}
	return $final;
	}
	
	
}					

?>