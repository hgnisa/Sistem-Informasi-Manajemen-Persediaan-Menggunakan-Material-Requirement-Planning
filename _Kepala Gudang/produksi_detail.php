<!doctype html>
<html class="no-js" lang="">
<?php include "_head.php"; 
include 'model/koneksi.php';
include"model/class_produk.php";
include"model/class_produksi.php";
$db = new produk();
$pro = new produksi();

$bulan = date('m');
$tanggal_produksi = $_GET['tgl'];
$tanggal_prod = substr($tanggal_produksi, 0, 2);
$bulan_prod = substr($tanggal_produksi, 3, 2);
$tahun_prod = substr($tanggal_produksi, 6, 4);
?>
<body>
    <div id="right-panel" class="right-panel">
	<?php include "_header.php"; ?>
        <div class="content">
			<div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
						<a class="btn btn-info" style="color:white" href="produksi_detail_print.php?ID_produksi=<?php print $ID_produksi;?>">Cetak&nbsp;&nbsp;<i class="fa fa-print"></i></button></a>
						<br><br>
						<div class="card">
                            <div class="card-header alert alert-info">
								<strong class="card-title">Detail Kebutuhan Produksi: <?php print $tanggal_prod;?> <?php echo $pro->tampil_nama_bulan($bulan);?> <?php print $tahun_prod;?></strong>
                            </div>
                            <div class="card-body">
								<div class="col-md-6">
									<table class="table table-striped table-bordered">
										<thead>
											<tr>
												<th><center>Menu</center></th>
												<th><center>Jumlah Produksi (pcs)</center></th>
											</tr>
										</thead>
										<tbody>
										<?php
											$query2 = mysqli_query($con, "SELECT * FROM produksi WHERE pr_date = '$tanggal_produksi'");
											while($o = mysqli_fetch_array($query2))
											{	
											?>
											<tr>
												<td><?php echo $db->tampil_nama_produk($o['ID_produk']);?></td>
												<td><center><?php echo $o['pr_total'];?></center></td>
											</tr>
											<?php
											}
											?>
										</tbody>
									</table>
								</div><br>
								<div class="col-md-12">
									<div class="card">
										<table id="bootstrap-data-table" class="table table-striped table-bordered">
											<thead>
												<tr>
													<th><center>Kode</center></th>
													<th><center>Bahan Baku</center></th>
													<th><center>Jumlah dibutuhkan</center></th>
													</tr>
											</thead>
											<tbody>
												<tr>
												<?php
												$query2 = mysqli_query($con, "SELECT DISTINCT ID_bahanbaku FROM bom");
												while($o = mysqli_fetch_array($query2))
												{	
													$ID_bahanbaku = $o['ID_bahanbaku'];
													
													?>
													<td width="20%"><?php print $ID_bahanbaku; ?></td>
													<?php
													
													$bom = 0;
													$query3 = mysqli_query($con, "SELECT * FROM bahanbaku INNER JOIN bom ON bahanbaku.ID_bahanbaku = bom.ID_bahanbaku WHERE bom.ID_bahanbaku = '$ID_bahanbaku'");
													while($o = mysqli_fetch_array($query3))
													{
														$bom = $o['bom'];
														$deskripsi = $o['deskripsi'];
														$unit = $o['unit'];
													}
													
													?>
													<td width="20%"><?php print $deskripsi; ?></td>
													<?php
													
													$gr = 0;
													$temp = 0;
													$query1 = mysqli_query($con, "SELECT * from produksi WHERE pr_date = '$tanggal_produksi'");
													while($n = mysqli_fetch_array($query1))
													{ 
														$ID_produk = $n['ID_produk'];
														$total_produksi = $n['pr_total'];
						
														$coba = $total_produksi*$bom; 
														$temp = $coba;
														$gr += $temp;
													}
												?>
													<td width="20%"><?php print $gr." ".$unit;?></td>
												</tr>	
												<?php
														
												}
												?>
											</tbody>
										</table>
									</div>
								</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .animated -->
        </div><!-- .content -->
		<?php include "_table.php";?>
</body>
</html>
