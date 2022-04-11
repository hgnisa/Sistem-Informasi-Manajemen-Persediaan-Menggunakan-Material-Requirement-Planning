<!doctype html>
<html class="no-js" lang="">
<?php include "_head.php"; ?>

<body>
    <div id="right-panel" class="right-panel">
	<?php 
		include "_header.php"; 
		include "model/koneksi.php";
	?>
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
															include "Controller/koneksi.php";
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
                <div class="row">
                    <div class="col-md-12">
						<button type="button" class="btn btn-md btn-info"><a style="color:white">Cetak</a>&nbsp;&nbsp;<i class="fa fa-print"></i></button>
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
                                            <th><center><small><b>Jumlah Dibeli</small></center></th
                                            <th><center><small><b>Satuan</small></center></th>
                                            <th><center><small><b>Status</small></center></th>
                                        </tr>
									</thead>
									<tbody>
										<?php
											$query = mysqli_query($con, "SELECT * FROM pembelian WHERE pb_laporan BETWEEN '0000-00-00' AND '0000-00-00'");
											while($m = mysqli_fetch_array($query))
											{
										  ?>
                                        <tr>
											<td><center><?php print $m['ID_faktur']; ?></center></td> 
											<td><center><?php print $m['ID_supplier']; ?></center></td> 
											<td><center><?php print $m['ID_bahanbaku']; ?></center></td> 
											<td><center><?php print $m['pb_date']; ?></center></td>
											<td><center><?php print $m['pb_jumlah']; ?></center></td> 
											<td><center><?php print $m['unit']; ?></center></td> 
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
