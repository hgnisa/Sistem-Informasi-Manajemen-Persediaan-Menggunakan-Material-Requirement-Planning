<!doctype html>
<html class="no-js" lang="">
<?php 
include "_head.php"; 
include "model/koneksi.php";
include "model/class_pembelian.php";
$db = new pembelian();

$bulan = date('m');
$tahun = date('Y');
?>

<body>
    <div id="right-panel" class="right-panel">
	<?php include "_header.php"; ?>
        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
					<a href="pembelian_input.php" style="color:white"><button type="button" class="btn btn-md btn-info">Tambah Transaksi Pembelian&nbsp;&nbsp;<i class="fa fa-plus"></i></button></a>
                    <br><br>
						<div class="card">
                            <div class="card-header alert alert-info">
                                <strong class="card-title">DATA PEMBELIAN <small>Bahan Baku</small></strong>
                            </div>
                            <div class="card-body">
								<div class="col-md-4">
									<button type="button" class="btn btn-outline-info btn-md btn-block">Penjualan bulan <b><?php print $db->tampil_namabulan($bulan);?> <?php print $tahun = date('Y');?></b> </button>
								</div>
							</div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th><center>Faktur</center></th>
                                            <th><center>Supplier</center></th>
                                            <th><center>Keterangan</center></th>
                                            <th><center>Status</center></th>
                                            <th><center>Detail</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
										$i=0;
										$query = mysqli_query($con,"SELECT DISTINCT ID_faktur, ID_supplier FROM pembelian WHERE pb_bulan = '$bulan' AND pb_tahun = '$tahun'");
										while ($m=mysqli_fetch_array($query))
										{
											
											$ID_supplier = $m['ID_supplier'];
											$ID_faktur = $m['ID_faktur'];
											
											$menunggu = 0;
											$tiba = 0;
											$query2 = mysqli_query($con,"SELECT * FROM pembelian WHERE ID_faktur = '$ID_faktur'");
											while ($o=mysqli_fetch_array($query2))
											{
												$status = $o['pb_status'];
												$porel = $o['pb_porel'];
												if($status == 'Menunggu'){
													$menunggu++;
												}
												else{
													$tiba++;
												}
											}
											
											$query1 = mysqli_query($con,"SELECT * FROM supplier WHERE ID_supplier = '$ID_supplier'");
											while ($n=mysqli_fetch_array($query1))
											{
									  ?>
                                        <tr>
											<td><center><?php print $m['ID_faktur']; ?></center></td> 
											<td><center><?php print $n['nama_supplier']; ?></center></td>
											<td><center>
												<?php
													if($porel == 0){
														print 'Tidak Sesuai Jadwal Porel';
													}
													else{
														print 'Sesuai Jadwal Porel';
													}
												?>
											</center></td>
											<td><center>
												<?php 
													$ket = "";
													if($tiba == 0){
														$ket = "Menunggu";
														print "<span class='badge badge-warning'>$ket</span>";
													}
													else if($menunggu == 0){
														$ket = "Tiba";
														print "<span class='badge badge-info'>$ket</span>";
													}
													else{
														print "<small>Menunggu</small> <span class='badge badge-info'>".$menunggu."</span> <small>Tiba</small> <span class='badge badge-info'>".$tiba."</span>";
													}
												
												?>
											</center></td>
											<td><center>
												<?php
													if($ket == "Menunggu"){
														?>
															<a href="pembelian_faktur_detail.php?ID_faktur=<?php print $m['ID_faktur'];?>"><button class="btn btn-info btn-sm"><i class="fa fa-search"></i></button></a>
															<a href="pembelian_faktur_konfirmasi.php?ID_faktur=<?php print $m['ID_faktur'];?>"><button class="btn btn-info btn-sm">konfirmasi</button></a>
														<?php
													}
													else if($ket == "Tiba"){
														?>
															<a href="pembelian_faktur_detail.php?ID_faktur=<?php print $m['ID_faktur'];?>"><button class="btn btn-info btn-sm"><i class="fa fa-search"></i></button></a>
														<?php
													}
													else{
														?>
															<a href="pembelian_faktur_detail.php?ID_faktur=<?php print $m['ID_faktur'];?>"><button class="btn btn-info btn-sm"><i class="fa fa-search"></i></button></a>
															<a href="pembelian_faktur_konfirmasi.php?ID_faktur=<?php print $m['ID_faktur'];?>"><button class="btn btn-info btn-sm">konfirmasi</button></a>
														<?php
													}
												?>
											<center></td>
                                        </tr>
									 <?php 
											}
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
		
		<!--footer -->
		<?php include "_table.php";?>
</body>
</html>
