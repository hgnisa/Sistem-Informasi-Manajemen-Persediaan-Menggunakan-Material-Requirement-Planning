<!doctype html>
<html class="no-js" lang="">
<?php include "_head.php"; ?>

<body>
    <div id="right-panel" class="right-panel">
	<?php 
		include "_header.php"; 
		include 'model/koneksi.php';
		$ID_faktur = $_GET['ID_faktur'];
	?>
        <div class="content">
			<div class="animated fadeIn">
                <div class="row">
					<div class="col-md-12">
						<a class="btn btn-info" style="color:white" href="pembelian_faktur_detail_print.php?ID_faktur=<?php print $ID_faktur;?>">Cetak&nbsp;&nbsp;<i class="fa fa-print"></i></button></a>
                    </div><br><br>
                    <div class="col-md-12">
						<div class="card">
						<?php
							$result = mysqli_query($con, "SELECT * FROM pembelian INNER JOIN supplier ON pembelian.ID_supplier = supplier.ID_supplier WHERE ID_faktur = '$ID_faktur'");	
							while($m = mysqli_fetch_array($result))
							{
								$nama_supplier = $m['nama_supplier'];
								$alamat_supplier = $m['alamat_supplier'];
								$telp_supplier = $m['telp_supplier'];
								$email_supplier = $m['email_supplier'];
								$tanggal = $m['pb_date'];
								$tanggal_tiba = $m['pb_date_tiba'];
							}
						?>
                            <div class="card-header alert alert-info">
								<strong class="card-title">Detail Pembelian Bahan Baku Pada <?php print $ID_faktur;?></strong>
                            </div>
							<div class="card-body">
								<div class="col-md-12">
									<table class="table">
										<tr>
											<td>
												<!-- .data supplier -->
												<table>
													<tr>
														<th width="20%">Supplier</th>
														<td>:</td>
														<td><?php print $nama_supplier;?></td>
													</tr>
													<tr>
														<th>Alamat</th>
														<td>:</td>
														<td><?php print $alamat_supplier;?></td>
													</tr>
													<tr>
														<th>No. Telp</th>
														<td>:</td>
														<td><?php print $telp_supplier;?></td>
													</tr>
													<tr>
														<th>Email</th>
														<td>:</td>
														<td><?php print $email_supplier;?></td>
													</tr>
												</table>
											</td>
											<td> &nbsp;&nbsp; </td>
											<td> &nbsp;&nbsp; </td>
											<td> &nbsp;&nbsp; </td>
											<td> &nbsp;&nbsp; </td>
											<td> &nbsp;&nbsp; </td>
											<td>
												<table class="table">
													<tr>
														<th width="30%">No. Faktur</th>
														<td>:</td>
														<td><?php print $ID_faktur;?></td>
													</tr>
													<tr>
														<th>Tanggal</th>
														<td>:</td>
														<td><?php print $tanggal;?></td>
													</tr>
													<tr>
														<th>Tanggal Tiba</th>
														<td>:</td>
														<td><?php print $tanggal_tiba;?></td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</div>
								<div class="col-md-12">
									<div class="card">
										<table id="bootstrap-data-table" class="table table-striped table-bordered">
											<thead>
												<tr>
													<th><center>No.</center></th>
													<th><center>Bahan Baku</center></th>
													<th><center>Jumlah Pesan</center></th>
													<th><center>Status</center></th>
													<th><center>Harga per unit</center></th>
													<th><center>Harga Total</center></th>
												</tr>
											</thead>
											<tbody>
												<?php
													$i = 0;
													$harga_total = 0;
													$result = mysqli_query($con, "SELECT * FROM pembelian WHERE ID_faktur = '$ID_faktur'");	
													while($m = mysqli_fetch_array($result))
													{
														$i++;
														$ID_bahanbaku = $m['ID_bahanbaku'];
														$result1 = mysqli_query($con, "SELECT * FROM bahanbaku WHERE ID_bahanbaku = '$ID_bahanbaku'");	
														while($n = mysqli_fetch_array($result1))
														{
															$deskripsi = $n['deskripsi'];
															$harga = $n['harga'];
														}
														
												?>
												<tr>
													<td width="5%"><?php print $i; ?></td>
													<td width="20%"><?php print $deskripsi;?></td>
													<td width="20%"><?php print $m['pb_jumlah'];?></td>
													<td width="20%"><?php print $m['pb_status'];?></td> 
													<td width="20%">Rp. <?php print $harga;?></td>
													<td width="20%">Rp. <?php print $total = $harga*$m['pb_jumlah'];?></td>
												</tr>
												<?php
													$harga_total += $total;
													}
												?>
											</tbody>
											<tbody>
												<tr>
													<td width="5%">&nbsp;</td>
													<td width="20%">&nbsp;</td>
													<td width="20%">&nbsp;</td>
													<td width="20%">&nbsp;</td> 
													<td width="20%"><strong>Total Harga</strong></td>
													<td width="20%"><strong>Rp. <?php print $harga_total;?></strong></td>
												</tr>
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
