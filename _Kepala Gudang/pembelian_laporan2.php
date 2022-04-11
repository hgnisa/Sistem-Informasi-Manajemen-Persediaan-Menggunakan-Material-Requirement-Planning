<!doctype html>
<html class="no-js" lang="">
<?php include "_head.php"; 
	$bd_sup = "";
	$bd_tgl = ""; 
	$bd_bb  = "";
	
	$tgl_awal = "";
	$tgl_akhir = "";
	$bahanbaku = "";
	$supplier = "";
	
	include "model/koneksi.php";
	?>
<body>
    <div id="right-panel" class="right-panel">
        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
					<div class="col-md-12">
						<div class="card border border-info">
							<form method="POST" action="pembelian_laporan2.php">
								<div class="card-body">
									<div class="row">
										<div class="col-md-3">
											<div class="card-body">
												<small> Tanggal Awal: </small>
												<input type="date" name="awal" class="form-control" required oninvalid="this.setCustomValidity('Tanggal tidak boleh kosong')" oninput="setCustomValidity('')"><br>
												<small> Tanggal Akhir: </small>
												<input type="date" name="akhir" class="form-control" required oninvalid="this.setCustomValidity('Tanggal tidak boleh kosong')" oninput="setCustomValidity('')">
										
											</div>
										</div>
										<div class="col-md-3">
											<div class="card-body">
												<small>Berdasarkan supplier:</small>
													<select name="supplier" class="form-control">
													<option value=""> Semua </option>
														<?php
															$i=0;
															$query = mysqli_query($con, "SELECT * from supplier");
															while($m = mysqli_fetch_array($query))
															{ 
														?>	
														<option value="<?php print $m['ID_supplier']; ?>"> <?php print $m['nama_supplier']; } ?></option>
													</select>
											</div>
										</div>
										<div class="col-md-3">
											<div class="card-body">
												<small>Berdasarkan bahanbaku:</small>
													<select name="bahanbaku" class="form-control">
													<option value=""> Semua </option>
													<?php
														include "Controller/koneksi.php";
														$i=0;
														$query = mysqli_query($con, "SELECT * from bahanbaku");
														while($m = mysqli_fetch_array($query))
														{ 
													?>	
													<option value="<?php print $m['ID_bahanbaku']; ?>"> <?php print $m['deskripsi']; } ?></option>
													</select>
											</div>
										</div>
										<div class="col-md-3">
											<div class="card-body">
												<small>Berdasarkan status pesanan:</small>
													<select name="status" class="form-control">
													<option value=""> Semua </option>
													<option value="Menunggu"> Menunggu </option>
													<option value="Tiba"> Tiba </option>
													</select>
											</div>
										</div>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<button class="btn btn-info btn-sm">Tampilkan</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<?php 
					include "_header.php"; 
					//berdasarkan tanggal
					$awal = $_POST['awal'];
					$akhir = $_POST['akhir'];
					
					//berdasarkan supplier
					$supplier = $_POST['supplier'];
					
					//berdasarkan bahanbaku
					$bahanbaku = $_POST['bahanbaku'];
					
					//berdasarkan status
					$status = $_POST['status'];
					
					
					$tgl_awal = date('Y-m-d', strtotime($awal)); 
					$tgl_akhir = date('Y-m-d', strtotime($akhir)); 
					//--------------------------------------------------------filter berdasarkan
					
					$bd_sup='';
					if($supplier!=''){
						$bd_sup= "AND pembelian.ID_supplier='".$supplier."'";
					}
					
					$bd_bb='';
					if($bahanbaku!=''){
						$bd_bb = "AND pembelian.ID_bahanbaku='".$bahanbaku."'";
					}
					
					$bd_status='';
					if($status!=''){
						$bd_status = "AND pembelian.pb_status='".$status."'";
					}
					
					$bd_tgl = '';
					if($tgl_akhir!=null && $tgl_akhir!=null){
						$bd_tgl = "AND pembelian.pb_laporan BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."'";
					}
					
				?>
                <div class="row">
                    <div class="col-md-12">
						<a class="btn btn-info" style="color:white" href="pembelian_print.php?ID=<?php print $tgl_awal.$tgl_akhir.$supplier.$bahanbaku.$status;?>">Cetak&nbsp;&nbsp;<i class="fa fa-print"></i></button></a>
						<br><br>
						<div class="card">
							<div class="card-header alert alert-info">
								<strong class="card-title">Data Pembelian Bahan Baku</strong>
							</div>
							<div class="card-body">
								<table id="bootstrap-data-table" class="table table-striped table-bordered">
									<thead>
										<tr>
                                            <th><center><small><b>No. Faktur</small></center></th>
                                            <th><center><small><b>Supplier</small></center></th>
                                            <th><center><small><b>Bahan Baku</small></center></th>
                                            <th><center><small><b>Tanggal</small></center></th>
                                            <th><center><small><b>Jumlah Dibeli</small></center></th>
                                            <th><center><small><b>Status</small></center></th>
                                        </tr>
									</thead>
									<tbody>
										<?php
											$temp = "";
											$query = mysqli_query($con, "SELECT * FROM pembelian INNER JOIN supplier ON pembelian.ID_supplier = supplier.ID_supplier INNER JOIN bahanbaku ON pembelian.ID_bahanbaku = bahanbaku.ID_bahanbaku WHERE pembelian.ID_faktur = pembelian.ID_faktur ".$bd_sup." ".$bd_bb." ".$bd_tgl." ".$bd_status."");
											while($m = mysqli_fetch_array($query))
											{
												$ID_faktur = $m['ID_faktur'];
												$ket = $m['pb_status'];
										  ?>
                                        <tr>
											<td><center><?php if($ID_faktur != $temp){ print $ID_faktur; $temp = $ID_faktur;}else{ ?><font color="#f2f2f2"><?php print $ID_faktur;}?></font></center></td>
											<td><center><?php print $m['nama_supplier']; ?></center></td> 
											<td><center><?php print $m['deskripsi']; ?></center></td> 
											<td><center><?php print $m['pb_date']; ?></center></td>
											<td><center><?php print $m['pb_jumlah']." ".$m['unit'];?></center></td>
											<td><center><?php print $m['pb_status']; ?></center></td>
                                        </tr>
									 <?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
            </div><!-- .animated -->
        </div><!-- .content -->
		
		<!--footer -->
		<?php  include "_table.php";?>
</body>
</html>
