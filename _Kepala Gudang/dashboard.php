<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<?php include "../menu.php";
include "../model/koneksi.php";
include "../Class/ClassPeramalan.php";

$peramalan = new Peramalan;
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Prima Sari</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    




    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
	
<!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->


   
	<link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" rel="stylesheet" />
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

	   <style>
			#weatherWidget .currentDesc {
			color: #ffffff!important;
			}
			.traffic-chart {
				min-height: 335px;
			}
			#flotPie1  {
				height: 150px;
			}
			#flotPie1 td {
				padding:3px;
			}
			#flotPie1 table {
				top: 20px!important;
				right: -10px!important;
			}
			.chart-container {
				display: table;
				min-width: 270px ;
				text-align: left;
				padding-top: 10px;
				padding-bottom: 10px;
			}
			#flotLine5  {
				 height: 105px;
			}

			#flotBarChart {
				height: 150px;
			}
			#cellPaiChart{
				height: 160px;
			}
		</style>
</head>

<body>



        </header><!-- /header -->
        <!-- Header-->

       <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                 
                         
                        </ol>
                    </div>
                </div>
            </div>
        </div>

		<div class='col-sm-12'>
		  <button type="button" class="btn btn-outline-secondary btn-lg btn-block"> <?php echo date('l');?> , <?php echo date('M d, Y');?>
		  <br>
		  
		  <?php date_default_timezone_set('Asia/Jakarta'); echo date("H:i:s");?>
		  </button>
				
				<br><br>
			
			
<div class="col-sm-12 mb-7">
        <div class="card-group">
            <div class="card col-lg-4 col-md-9 no-padding bg-flat-color-1">
                <div class="card-body">
                    <div class="h1 text-muted text-right mb-4">
                        <i class="ti-package text-light"></i>
                    </div>
					 <?php include "../Controller/koneksi.php";  
								$jumlahProduk1 = mysqli_query($con, "SELECT COUNT(kode_produk) as kode_produk FROM produk");
								$jumlahProduk= mysqli_fetch_array($jumlahProduk1);
								$jumlahProduk2 = $jumlahProduk['kode_produk']; 
								
							?>
                    <div class="h4 mb-0 text-light">
                        <span class="count"><?php echo $jumlahProduk2; ?></span>
                    </div>
                    <small class="text-uppercase font-weight-bold text-light">Jumlah Produk</small>
                    <div class="progress progress-xs mt-3 mb-0 bg-light" style="width: 40%; height: 5px;"></div>
                </div>
            </div>
            <div class="card col-lg-4 col-md-6 no-padding no-shadow">
                <div class="card-body bg-flat-color-2">
                    <div class="h1 text-muted text-right mb-4">
                        <i class="ti-tag text-light"></i>
                    </div>
					 <?php include "../Controller/koneksi.php";  
								$jumlahSupplier1 = mysqli_query($con, "SELECT COUNT(kode_bahan_baku) as kode_bahan_baku FROM bahanbaku");
								$jumlahSupplier= mysqli_fetch_array($jumlahSupplier1);
								$jumlahSupplier2 = $jumlahSupplier['kode_bahan_baku']; 
							
							?>
                    <div class="h4 mb-0 text-light">
                          <span class="count"><?php echo $jumlahSupplier2; ?></span>
                    </div>
                    <small class="text-uppercase font-weight-bold text-light">Bahan Baku</small>
                    <div class="progress progress-xs mt-3 mb-0 bg-light" style="width: 40%; height: 5px;"></div>
                </div>
            </div>
            <div class="card col-lg-4 col-md-6 no-padding no-shadow">
                <div class="card-body bg-flat-color-3">
                    <div class="h1 text-right mb-4">
                        <i class="fa fa-cart-plus text-light"></i>
                    </div>
						<?php
						$bulan_ini = date('m');
						switch ($bulan_ini){
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
					?>
	
					<?php include "../Controller/koneksi.php";  
											$tahun = date('Y') ;
								
								
								$jumlahSupplier1 = mysqli_query($con, "SELECT SUM(jumlah_penjualan) as total FROM penjualan where bulan='$bulan_ini' and tahun='$tahun'");
								$jumlahSupplier= mysqli_fetch_array($jumlahSupplier1);
								$jumlahSupplier2 = $jumlahSupplier['total']; 
							
							?>
                    <div class="h4 mb-0 text-light">
					
                         <span class="count"><?php echo $jumlahSupplier2; ?></span>
                    </div>
                    <small class="text-light text-uppercase font-weight-bold">Terjual</small>
                    <div class="progress progress-xs mt-3 mb-0 bg-light" style="width: 40%; height: 5px;"></div>
                </div>
            </div>
            <div class="card col-lg-4 col-md-6 no-padding no-shadow">
                <div class="card-body bg-flat-color-5">
                    <div class="h1 text-right text-light mb-4">
                        <i class="ti-wallet"></i>
						<?php
						$bulan_ini = date('m');
						switch ($bulan_ini){
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
					?>
	
					<?php include "../Controller/koneksi.php";  
											$tahun = date('Y') ;
								
								
								$jumlahSupplier1 = mysqli_query($con, "SELECT SUM(total_penjualan) as total FROM penjualan where bulan='$bulan_ini' and tahun='$tahun'");
								$jumlahSupplier= mysqli_fetch_array($jumlahSupplier1);
								$jumlahSupplier2 = $jumlahSupplier['total']; 
							
							?>
						
                    </div>
                    <div class="h4 mb-0 text-light">
                      <span class="count">Rp. <?php echo number_format($jumlahSupplier2); ?></span>
                    </div>
                    <small class="text-uppercase font-weight-bold text-light">Pendapatan</small>
                    <div class="progress progress-xs mt-3 mb-0 bg-light" style="width: 40%; height: 5px;"></div>
                </div>
            </div>
           

    </div>
	   </div>
				
	<?php		
$query = mysqli_query($con, "SELECT * from bahanbaku WHERE jumlah_bahan_baku <= rop");
while($m=mysqli_fetch_array($query)){	
	if($m['jumlah_bahan_baku']<=['rop']){	
		?>	
		<script>
			$(document).ready(function(){
				$('#pesan_sedia').css("color","red");
				$('#pesan_sedia').append("<span class='glyphicon glyphicon-asterisk'></span>");
			});
		</script>
		<?php
		echo "
		
		<div class='col-sm-12' class='alert alert-warning'>
	 <div class='alert  alert-success alert-dismissible fade show' role='alert'>
		<small><span class='glyphicon glyphicon-info-sign'></span> 
		Stok  <a style='color:red'>". $m['nama_bahan_baku']."</a> yang tersisa sebanyak <a style='color:red'>". $m['rop']."</a> <a style='color:red'>". $m['satuan']." </a></small>
		<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
		
		</div>
		</div>";	
	}
}
?>


	<?php
				include "../Controller/koneksi.php";
				$query1 = mysqli_query($con, "SELECT * from porel INNER JOIN bahanbaku ON porel.kode_bahan_baku=bahanbaku.kode_bahan_baku");
				while($m = mysqli_fetch_array($query1))
				{ 
					$bulan = $m['bulan'];
					$porel = $m['tanggal'];
					$ambilPorel = substr($porel, 3, 2);
					$status = $m['status'];
											
					if($ambilPorel == $bulan){
						$tanggal = $m['tanggal'];
						$tgl = new DateTime(date("Y-m-d", strtotime($tanggal)));
						$today =  new DateTime(date("Y-m-d"));
						$diff = $today->diff($tgl);
						$diff->d;
												
						if ((($diff->d) <= 1) AND ($status ==0)){
						?>
						<br>

								<div class='col-sm-12' class='alert alert-warning'>
						 <div class='sufee-alert alert with-close alert-danger alert-dismissible fade show' role='alert'>
					
							<span class='badge badge-pill badge-warning'>Pemberitahuan Jadwal pemesanan bahan baku</span>
								<small>&nbsp; <b><?php print $m['nama_bahan_baku'];?></b> harus dilakukan 
								
								<?php
													$skrg = date('d');
													$porel_tgl = substr($porel, 0, 2);
													
													if($porel_tgl < $skrg){
														print 'Hari Pemesanan Sudah Lewat';
													}
													else if($porel_tgl == $skrg){
														print 'Pemesanan hari ini';
													}
													else{
														print $diff->d;  
														print ' Hari lagi';
													}
												?>
								
								
								</small>
								
								
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div> </div>
							<?php
						}
						
						

					}
				}
			?>

			
			<!-- Tampil Notif Submit MRP-->
			<?php
				$hari_ini = date("d-m-Y");
				$tahun = date('Y');
				$akhir = date('t-m-Y', strtotime($hari_ini));
				
				if($hari_ini == $akhir){
				?>
						<div class="sufee-alert alert with-close alert-warning alert-dismissible fade show">
							<span class="badge badge-pill badge-warning">Warning</span>
							 &nbsp;Hari ini adalah akhir bulan. Lakukan perhitungan perencanaan produksi (MRP) !
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
				<?php
				}
			?>	
			
			
			
						<?php
							include '../Controller/koneksi.php';
						
							$i = 0;
							$kode = "";
							$tahun = "";
							$query = mysqli_query($con, "SELECT * FROM produk");
							while ($m=mysqli_fetch_array($query))
							{	
								$kode_produk = $m['kode_produk'];
							}
						?>
	
 
	
						<?php
							include '../Controller/koneksi.php';
							
							$i = 0;
							
							$query1 = mysqli_query($con, "SELECT nama_produk FROM produk where kode_produk='$kode_produk'");
							while ($m=mysqli_fetch_array($query1))
							{	
								$nama_produk= $m['nama_produk'];
								
							}
						?>
                            <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">

							
						<form method="get">
						<table> 
						<tr> <td>
						<select name="kode_produk1" class="form-control">
						
							<option> Pilih Produk </option>
										<?php
        									include "../Controller/koneksi.php";
        									$i=0;
        									$query = mysqli_query($con, "SELECT * from produk");
        									while($m = mysqli_fetch_array($query))
        									{ $i++ 
        										?>	
  											<option value="<?php echo $m['kode_produk']; ?>"> <?php print $m['kode_produk']."  ".$m['nama_produk']; 
  											?>
  											<?php } ?></option></select>
  										</td>
  						<td><select name="tahun1" class="form-control">
									<option> Pilih Tahun </option>
									<?php
									$i=0; 
									$data=$peramalan->TampilTahun();
									if($data!=0){
									foreach($data as $m){
											$tahun = $m['tahun'];
									$i++;  
									?>	
  									<option value="<?php echo $m['tahun']; ?>"> <?php print $m['tahun']; ?>
  									<?php }} ?>
									</option>
									</select>
								</td>	
							<td width="70px" align="center"><button class="btn-sm btn-warning">Tampilkan</button></center></td> 
								</tr>
								
					
						<?php

	if (isset($_GET['kode_produk1']) and isset ($_GET['tahun1'])){
		
	$kode_produk = $_GET['kode_produk1'];	
	$tahun = $_GET['tahun1'];	
	
	$jan = mysqli_query($con, "SELECT * FROM peramalan_penjualan WHERE bulan='Januari' AND tahun='$tahun' 
		and kode_produk='$kode_produk'"); while($m = mysqli_fetch_array($jan)){ $f_jan = $m['peramalan']; $d_jan = $m['jumlah'];}
  
	$feb = mysqli_query($con, "SELECT * FROM peramalan_penjualan WHERE bulan='Februari' AND tahun='$tahun'
	and kode_produk='$kode_produk'"); while($m = mysqli_fetch_array($feb)){ $f_feb = $m['peramalan']; $d_feb = $m['jumlah'];}
   
	$mar = mysqli_query($con, "SELECT * FROM peramalan_penjualan WHERE bulan='Maret' AND tahun='$tahun'
	and kode_produk='$kode_produk'"); while($m = mysqli_fetch_array($mar)){ $f_mar = $m['peramalan']; $d_mar = $m['jumlah'];}
  
	$apr = mysqli_query($con, "SELECT * FROM peramalan_penjualan WHERE bulan='April' AND tahun='$tahun'
	and kode_produk='$kode_produk'"); while($m = mysqli_fetch_array($apr)){ $f_apr = $m['peramalan']; $d_apr = $m['jumlah'];}
   
	$mei = mysqli_query($con, "SELECT * FROM peramalan_penjualan WHERE bulan='Mei' AND tahun='$tahun'
	and kode_produk='$kode_produk'"); while($m = mysqli_fetch_array($mei)){ $f_mei = $m['peramalan']; $d_mei = $m['jumlah'];}
	
	$jun = mysqli_query($con, "SELECT * FROM peramalan_penjualan WHERE bulan='Juni' AND tahun='$tahun'
	and kode_produk='$kode_produk'"); while($m = mysqli_fetch_array($jun)){ $f_jun = $m['peramalan']; $d_jun = $m['jumlah'];}
    
	$jul = mysqli_query($con, "SELECT * FROM peramalan_penjualan WHERE bulan='Juli' AND tahun='$tahun'
	and kode_produk='$kode_produk'"); while($m = mysqli_fetch_array($jul)){ $f_jul = $m['peramalan']; $d_jul = $m['jumlah'];}
    
	$agt = mysqli_query($con, "SELECT * FROM peramalan_penjualan WHERE bulan='Agustus' AND tahun='$tahun'
	and kode_produk='$kode_produk'"); while($m = mysqli_fetch_array($agt)){ $f_agt = $m['peramalan']; $d_agt = $m['jumlah'];}
	
    
	$sep = mysqli_query($con, "SELECT * FROM peramalan_penjualan WHERE bulan='September' AND tahun='$tahun'
	and kode_produk='$kode_produk'"); while($m = mysqli_fetch_array($sep)){ $f_sep = $m['peramalan']; $d_sep = $m['jumlah'];}
    
	$okt = mysqli_query($con, "SELECT * FROM peramalan_penjualan WHERE bulan='Oktober' AND tahun='$tahun'
	and kode_produk='$kode_produk'"); while($m = mysqli_fetch_array($okt)){ $f_okt = $m['peramalan']; $d_okt = $m['jumlah'];}
    ?>
	
    <?php
	include "../Controller/koneksi.php";
		$i = 0;
		$tahun = $_GET['tahun1'];
									
			$ID = $tahun.$kode_produk."-11";
			$query = mysqli_query($con, "SELECT * FROM peramalan_penjualan WHERE ID='$ID' AND tahun='$tahun'and kode_produk='$kode_produk'");
			while ($m=mysqli_fetch_array($query))
			{
				$november_f = $m['peramalan'];
				$november_d = $m['jumlah'];
			}
			
		
		?>
		
		
	
	<?php $des = mysqli_query($con, "SELECT * FROM peramalan_penjualan WHERE bulan='Desember' AND tahun='$tahun' and kode_produk='$kode_produk'"); while($m = mysqli_fetch_array($des)){ $f_des = $m['peramalan']; $d_des = $m['jumlah'];}?>
		
	 <?php
	 $query1 = mysqli_query($con, "SELECT nama_produk FROM produk where kode_produk='$kode_produk'");
							while ($m=mysqli_fetch_array($query1))
							{	
								$nama_produk= $m['nama_produk'];
								
							}
		$jan = mysqli_query($con, "SELECT SUM(jumlah_penjualan) as Penjualan FROM penjualan WHERE bulan='01' AND tahun='$tahun' and nama_produk='$nama_produk'"); while($m = mysqli_fetch_array($jan)){ $data_jan = $m['Penjualan'];}
	
		$feb = mysqli_query($con, "SELECT SUM(jumlah_penjualan) as Penjualan FROM penjualan WHERE bulan='02' AND tahun='$tahun' and nama_produk='$nama_produk'"); while($m = mysqli_fetch_array($feb)){ $data_feb = $m['Penjualan'];}
	
		$mar = mysqli_query($con, "SELECT SUM(jumlah_penjualan) as Penjualan FROM penjualan WHERE bulan='03' AND tahun='$tahun' and nama_produk='$nama_produk'"); while($m = mysqli_fetch_array($mar)){ $data_mar = $m['Penjualan'];}

		$apr = mysqli_query($con, "SELECT SUM(jumlah_penjualan) as Penjualan FROM penjualan WHERE bulan='04' AND tahun='$tahun' and nama_produk='$nama_produk'"); while($m = mysqli_fetch_array($apr)){ $data_apr = $m['Penjualan'];}

		$mei = mysqli_query($con, "SELECT SUM(jumlah_penjualan) as Penjualan FROM penjualan WHERE bulan='05' AND tahun='$tahun' and nama_produk='$nama_produk'"); while($m = mysqli_fetch_array($mei)){ $data_mei = $m['Penjualan'];}	
	
		$jun = mysqli_query($con, "SELECT SUM(jumlah_penjualan) as Penjualan FROM penjualan WHERE bulan='06' AND tahun='$tahun' and nama_produk='$nama_produk'"); while($m = mysqli_fetch_array($jun)){ $data_jun = $m['Penjualan'];}	
	
		$jul = mysqli_query($con, "SELECT SUM(jumlah_penjualan) as Penjualan FROM penjualan WHERE bulan='07' AND tahun='$tahun' and nama_produk='$nama_produk'"); while($m = mysqli_fetch_array($jul)){ $data_jul = $m['Penjualan'];}
	
		$agt= mysqli_query($con, "SELECT SUM(jumlah_penjualan) as Penjualan FROM penjualan WHERE bulan='08' AND tahun='$tahun' and nama_produk='$nama_produk'"); while($m = mysqli_fetch_array($agt)){ $data_agt = $m['Penjualan'];}	
	
		$sep = mysqli_query($con, "SELECT SUM(jumlah_penjualan) as Penjualan FROM penjualan WHERE bulan='09' AND tahun='$tahun' and nama_produk='$nama_produk'"); while($m = mysqli_fetch_array($sep)){ $data_sep = $m['Penjualan'];}	
	
		$okt = mysqli_query($con, "SELECT SUM(jumlah_penjualan) as Penjualan FROM penjualan WHERE bulan='10' AND tahun='$tahun' and nama_produk='$nama_produk'"); while($m = mysqli_fetch_array($okt)){ $data_okt = $m['Penjualan'];}
	
		$nov = mysqli_query($con, "SELECT SUM(jumlah_penjualan) as Penjualan FROM penjualan WHERE bulan='11' AND tahun='$tahun' and nama_produk='$nama_produk'"); while($m = mysqli_fetch_array($nov)){ $data_nov = $m['Penjualan'];}
	
		$des = mysqli_query($con, "SELECT SUM(jumlah_penjualan) as Penjualan FROM penjualan WHERE bulan='12' AND tahun='$tahun' and nama_produk='$nama_produk'"); while($m = mysqli_fetch_array($des)){ $data_des = $m['Penjualan'];}
?>


	
	
	<div class="card-header">
                                <h4 class="box-title">Perbandingan Hasil peramalan, Data Penjualan dan Aktual Tahun <?php print $nama_produk;?> <?php print $tahun;?></h4>
                            </div>
							
		<?php
		
		
	}
 else{ 
 $kode_produk = "PRODUK-001";
 $tahun = 2020;
 	$jan = mysqli_query($con, "SELECT * FROM peramalan_penjualan WHERE bulan='Januari' AND tahun='$tahun' 
		and kode_produk='$kode_produk'"); while($m = mysqli_fetch_array($jan)){ $f_jan = $m['peramalan']; $d_jan = $m['jumlah'];}
  
	$feb = mysqli_query($con, "SELECT * FROM peramalan_penjualan WHERE bulan='Februari' AND tahun='$tahun'
	and kode_produk='$kode_produk'"); while($m = mysqli_fetch_array($feb)){ $f_feb = $m['peramalan']; $d_feb = $m['jumlah'];}
   
	$mar = mysqli_query($con, "SELECT * FROM peramalan_penjualan WHERE bulan='Maret' AND tahun='$tahun'
	and kode_produk='$kode_produk'"); while($m = mysqli_fetch_array($mar)){ $f_mar = $m['peramalan']; $d_mar = $m['jumlah'];}
  
	$apr = mysqli_query($con, "SELECT * FROM peramalan_penjualan WHERE bulan='April' AND tahun='$tahun'
	and kode_produk='$kode_produk'"); while($m = mysqli_fetch_array($apr)){ $f_apr = $m['peramalan']; $d_apr = $m['jumlah'];}
   
	$mei = mysqli_query($con, "SELECT * FROM peramalan_penjualan WHERE bulan='Mei' AND tahun='$tahun'
	and kode_produk='$kode_produk'"); while($m = mysqli_fetch_array($mei)){ $f_mei = $m['peramalan']; $d_mei = $m['jumlah'];}
	
	$jun = mysqli_query($con, "SELECT * FROM peramalan_penjualan WHERE bulan='Juni' AND tahun='$tahun'
	and kode_produk='$kode_produk'"); while($m = mysqli_fetch_array($jun)){ $f_jun = $m['peramalan']; $d_jun = $m['jumlah'];}
    
	$jul = mysqli_query($con, "SELECT * FROM peramalan_penjualan WHERE bulan='Juli' AND tahun='$tahun'
	and kode_produk='$kode_produk'"); while($m = mysqli_fetch_array($jul)){ $f_jul = $m['peramalan']; $d_jul = $m['jumlah'];}
    
	$agt = mysqli_query($con, "SELECT * FROM peramalan_penjualan WHERE bulan='Agustus' AND tahun='$tahun'
	and kode_produk='$kode_produk'"); while($m = mysqli_fetch_array($agt)){ $f_agt = $m['peramalan']; $d_agt = $m['jumlah'];}
	
    
	$sep = mysqli_query($con, "SELECT * FROM peramalan_penjualan WHERE bulan='September' AND tahun='$tahun'
	and kode_produk='$kode_produk'"); while($m = mysqli_fetch_array($sep)){ $f_sep = $m['peramalan']; $d_sep = $m['jumlah'];}
    
	$okt = mysqli_query($con, "SELECT * FROM peramalan_penjualan WHERE bulan='Oktober' AND tahun='$tahun'
	and kode_produk='$kode_produk'"); while($m = mysqli_fetch_array($okt)){ $f_okt = $m['peramalan']; $d_okt = $m['jumlah'];}
	
	?>
    <?php
	include "../Controller/koneksi.php";
		$i = 0;
		$kode = "";
		$tahun = "";
		
		$query = mysqli_query($con, "SELECT max(tahun) as maxKode FROM peramalan_penjualan where kode_produk='$kode_produk'");
		
		while ($m=mysqli_fetch_array($query))
		{	
			$tahun = 2020;
			$ID = $tahun.$kode_produk."-11";
			$query = mysqli_query($con, "SELECT * FROM peramalan_penjualan WHERE ID='$ID' AND tahun='$tahun'and kode_produk='$kode_produk'");
			while ($m=mysqli_fetch_array($query))
			{
				$november_f = $m['peramalan'];
				$november_d = $m['jumlah'];
			}
		}
		
		?>
		
		
	
	<?php $des = mysqli_query($con, "SELECT * FROM peramalan_penjualan WHERE bulan='Desember' AND tahun='$tahun' and kode_produk='$kode_produk'"); while($m = mysqli_fetch_array($des)){ $f_des = $m['peramalan']; $d_des = $m['jumlah'];}?>
		
		
		 
		 <?php $query1 = mysqli_query($con, "SELECT nama_produk FROM produk where kode_produk='$kode_produk'");
							while ($m=mysqli_fetch_array($query1))
							{	
								$nama_produk= $m['nama_produk'];
							}	
		?>
	 <?php
		$jan = mysqli_query($con, "SELECT SUM(jumlah_penjualan) as Penjualan FROM penjualan WHERE bulan='01' AND tahun='$tahun' and nama_produk='$nama_produk'"); while($m = mysqli_fetch_array($jan)){ $data_jan = $m['Penjualan'];}
	
		$feb = mysqli_query($con, "SELECT SUM(jumlah_penjualan) as Penjualan FROM penjualan WHERE bulan='02' AND tahun='$tahun' and nama_produk='$nama_produk'"); while($m = mysqli_fetch_array($feb)){ $data_feb = $m['Penjualan'];}
	
		$mar = mysqli_query($con, "SELECT SUM(jumlah_penjualan) as Penjualan FROM penjualan WHERE bulan='03' AND tahun='$tahun' and nama_produk='$nama_produk'"); while($m = mysqli_fetch_array($mar)){ $data_mar = $m['Penjualan'];}

		$apr = mysqli_query($con, "SELECT SUM(jumlah_penjualan) as Penjualan FROM penjualan WHERE bulan='04' AND tahun='$tahun' and nama_produk='$nama_produk'"); while($m = mysqli_fetch_array($apr)){ $data_apr = $m['Penjualan'];}

		$mei = mysqli_query($con, "SELECT SUM(jumlah_penjualan) as Penjualan FROM penjualan WHERE bulan='05' AND tahun='$tahun' and nama_produk='$nama_produk'"); while($m = mysqli_fetch_array($mei)){ $data_mei = $m['Penjualan'];}	
	
		$jun = mysqli_query($con, "SELECT SUM(jumlah_penjualan) as Penjualan FROM penjualan WHERE bulan='06' AND tahun='$tahun' and nama_produk='$nama_produk'"); while($m = mysqli_fetch_array($jun)){ $data_jun = $m['Penjualan'];}	
	
		$jul = mysqli_query($con, "SELECT SUM(jumlah_penjualan) as Penjualan FROM penjualan WHERE bulan='07' AND tahun='$tahun' and nama_produk='$nama_produk'"); while($m = mysqli_fetch_array($jul)){ $data_jul = $m['Penjualan'];}
	
		$agt= mysqli_query($con, "SELECT SUM(jumlah_penjualan) as Penjualan FROM penjualan WHERE bulan='08' AND tahun='$tahun' and nama_produk='$nama_produk'"); while($m = mysqli_fetch_array($agt)){ $data_agt = $m['Penjualan'];}	
	
		$sep = mysqli_query($con, "SELECT SUM(jumlah_penjualan) as Penjualan FROM penjualan WHERE bulan='09' AND tahun='$tahun' and nama_produk='$nama_produk'"); while($m = mysqli_fetch_array($sep)){ $data_sep = $m['Penjualan'];}	
	
		$okt = mysqli_query($con, "SELECT SUM(jumlah_penjualan) as Penjualan FROM penjualan WHERE bulan='10' AND tahun='$tahun' and nama_produk='$nama_produk'"); while($m = mysqli_fetch_array($okt)){ $data_okt = $m['Penjualan'];}
	
		$nov = mysqli_query($con, "SELECT SUM(jumlah_penjualan) as Penjualan FROM penjualan WHERE bulan='11' AND tahun='$tahun' and nama_produk='$nama_produk'"); while($m = mysqli_fetch_array($nov)){ $data_nov = $m['Penjualan'];}
	
		$des = mysqli_query($con, "SELECT SUM(jumlah_penjualan) as Penjualan FROM penjualan WHERE bulan='12' AND tahun='$tahun' and nama_produk='$nama_produk'"); while($m = mysqli_fetch_array($des)){ $data_des = $m['Penjualan'];}
?>
<div class="card-header">
                                <h4 class="box-title">Perbandingan Hasil peramalan, Data Penjualan dan Aktual Tahun <?php print $nama_produk;?> <?php print $tahun;?></h4>
                            </div>
<?php
 
 
 
 }
		?>	</table>
			
							
							
							
							
							
							
                            <div class="row">
                                <div class="col-lg-11">
                                    <div class="card-body">
                                        <canvas id="team-chart"></canvas>
                                    </div>
                                </div>
                            </div>
                    
                        </div>
                    </div> 
                </div>
			</div>
			

	
		<div class="clearfix"></div>
	
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <script src="../vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../assets/js/main.js"></script>


    <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="../vendors/jszip/dist/jszip.min.js"></script>
    <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.colVis.min.js"></script>
   


<!--  Chart js -->
		<script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.bundle.min.js"></script>
		<!--Chartist Chart-->
		<script src="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/chartist-plugin-legend@0.6.2/chartist-plugin-legend.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/flot-pie@1.0.0/src/jquery.flot.pie.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/flot-spline@0.0.1/js/jquery.flot.spline.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/simpleweather@3.1.0/jquery.simpleWeather.min.js"></script>
		<script src="assets/js/init/weather-init.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/moment@2.22.2/moment.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>
		<script src="../assets/js/init/fullcalendar-init.js"></script>
	

		<script>
     ( function ( $ ) {
    "use strict";

     //Team chart
    var ctx = document.getElementById( "team-chart" );
    ctx.height = 150;
    var myChart = new Chart( ctx, {
        type: 'line',
        data: {
            labels: [ 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'],
            type: 'line',
            defaultFontFamily: 'Montserrat',
            datasets: [ {
                 label: "Hasil Peramalan",
                            borderColor: "rgba(245, 23, 66, 0.9)",
                            borderWidth: "1",
                            backgroundColor: "rgba(245, 23, 66,.5)",
                            pointHighlightStroke: "rgba(245, 23, 66,.5)",
                            data: [ <?php print $f_jan;?>, <?php print $f_feb;?>, <?php print $f_mar;?>, <?php print $f_apr;?>, <?php print $f_mei;?>, <?php print $f_jun;?>, <?php print $f_jul;?>, <?php print $f_agt;?>,  <?php print $f_sep;?>, <?php print $f_okt;?>, <?php print $november_f;?>, <?php print $f_des;?>,  ]
                    },
                    {
                data: [ <?php print $d_jan;?>,<?php print $d_feb;?>,<?php print $d_mar;?>,<?php print $d_apr;?>,<?php print $d_mei;?>,<?php print $d_jun;?>,<?php print $d_jul?> ,<?php print $d_agt;?> ,<?php print $d_sep;?>, <?php print $d_okt;?>,
				<?php print $november_d;?>,<?php print $d_des;?>  ],
                label: "Data Penjualan",
                backgroundColor: 'rgba(0,194,146,.25)',
                borderColor: 'rgba(0,194,146,0.5)',
                borderWidth: 3.5,
                pointStyle: 'circle',
                pointRadius: 5,
            
            
                    },

				{
                data: [ <?php print $data_jan;?>, <?php print $data_feb;?>, <?php print $data_mar;?>, <?php print $data_apr;?>, <?php print $data_mei;?>, <?php print $data_jun;?>, <?php print $data_jul;?> , <?php print $data_agt;?>, <?php print $data_sep;?>,<?php print $data_okt;?>,<?php print $data_nov;?>,<?php print $data_des;?>],
                label: "Data Aktual",
                borderColor: "rgba(40, 169, 46, 0.9)",
                backgroundColor: "rgba(40, 169, 46, .5)",  
                borderWidth: 3.5,
                pointStyle: 'circle',
                pointRadius: 5,
                pointBorderColor: 'transparent',
             
                    },
					]
        },
        options: {
            responsive: true,
                        tooltips: {
                            mode: 'index',
                            intersect: false
            },
          hover: {
                            mode: 'nearest',
                            intersect: true

            },
            scales: {
                xAxes: [ {
                    display: true,
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    scaleLabel: {
                        display: false,
                        labelString: 'Month'
                    }
                        } ],
                yAxes: [ {
                    display: true,
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Value'
                    }
                        } ]
            },
            title: {
                display: false,
            }
        }
    } );


 



} )( jQuery );
		</script>
</body>
	
	
	
	
	
	
	

</body>

</html>
 