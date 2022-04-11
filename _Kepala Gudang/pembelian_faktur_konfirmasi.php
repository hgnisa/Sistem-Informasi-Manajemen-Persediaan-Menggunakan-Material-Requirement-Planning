<!doctype html>
<html class="no-js" lang="">
<?php include "_head.php"; ?>
<?php 
include 'model/class_pembelian.php';
$db = new pembelian(); 
?>
<body>
    <div id="right-panel" class="right-panel">
	<?php include "_header.php"; ?>
        <div class="content">
			<div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
						<div class="card">
						<?php
							include 'model/koneksi.php';
							
						?>
                            <div class="card-header">
								<strong class="card-title">Konfirmasi Pembelian Bahan Baku Pada <?php print $_GET['ID_faktur'];?></strong>
                            </div>
							<div class="card-body">
								<div class="col-md-12">
									<div class="card">
										<div class="col-md-12">
											<span class="badge badge-info">* klik tombol ceklis untuk konfirmasi bahan baku telah tiba</span></a>
										</div><br>
										<table id="bootstrap-data-table" class="table table-striped table-bordered">
											<thead>
												<tr>
													<th><center>No.</center></th>
													<th><center>Bahan Baku</center></th>
													<th><center>Jumlah Pesan</center></th>
													<th><center>Harga per unit</center></th>
													<th><center>Harga Total</center></th>
													<th><center>Status</center></th>
													<th><center>Aksi</center></th>
												</tr>
											</thead>
											<tbody>
												<?php
													$i = 0;
													foreach($db->tampil_faktur($_GET['ID_faktur']) as $m) {	
														$i++;
												?>
												<tr>
													<td width="5%"><?php print $i; ?></td>
													<td width="20%"><?php print $m['deskripsi'];?></td>
													<td width="20%"><?php print $m['pb_jumlah'];?></td>
													<td width="20%">Rp. <?php print $m['harga'];?></td>
													<td width="20%">Rp. <?php print $total = $m['harga']*$m['pb_jumlah'];?></td>
													<td width="20%"><?php print $status = $m['pb_status'];?></td> 
													<td>
														<?php 
															if($status == 'Menunggu'){
																?>
																<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#staticModal"><i class="fa fa-check"></i></button>
																<div class="modal fade" id="staticModal" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true">
																		<div class="modal-dialog modal-sm" role="document">
																			<div class="modal-content">
																				<div class="modal-body">
																					<p>
																						<br>
																						Apakah data yang dimasukkan sudah sesuai?
																				   </p>
																			   </div>
																			   <div class="modal-footer">
																				<a href="#"><button type="button" class="btn btn-outline-link btn-md" data-dismiss="modal">Batal</button></a>
																				<a href="controller/proses_pembelian.php?ID_pembelian=<?php print $m['ID_pembelian'];print $_GET['ID_faktur'];?>&aksi=konfirmasi"><button class="btn btn-info btn-md">OK</button></a>
																			</div>
																		</div>
																	</div>
																</div>
																<?php
															}
															else{
																?>
																<a href="controller/proses_pembelian.php?ID_pembelian=<?php print $m['ID_pembelian'];print $_GET['ID_faktur'];?>&aksi=konfirmasi"><button disabled="" class="btn btn-secondary btn-sm"><i class="fa fa-check"></i></button></a>
																<?php
															}
														?>
														</td>
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
													<td width="20%">&nbsp;</td> 
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
