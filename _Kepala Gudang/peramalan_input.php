		<!doctype html>
		<html class="no-js" lang="">
		<?php 
		include "_head.php"; 
		include "model/class_produk.php";
		$db = new produk();
		include "model/class_peramalan.php";
		$pr = new peramalan();
		?>
		<body>
			<div id="right-panel" class="right-panel">
			<?php include "_header.php"; ?>
				<div class="content">
					<div class="animated fadeIn">
						<div class="row">
							<div class="col-md-12">
								<div class="card card-info">
									<div class="card-header alert alert-info">
										<strong class="card-title">INPUT DATA PENJUALAN </strong>&nbsp;<small>Peramalan</small>
									</div>
									<div class="card-body">
										<div id="pay-invoice">
											<div class="card-body card-block">
												<form action="controller/proses_peramalan_hitung.php" method="post" class="form-horizontal">
													<div class="row form-group">
														<div class="col col-sm-6">
															<select name="ID_produk" class="form-control">
																<small><option value="P-001"> Pilih Produk </option>
																<?php foreach($db->tampil_produk() as $m) { ?>
																<small><option value="<?php echo $m['ID_produk'];?>"> <?php echo $m['nama_produk']; ?></option>
																<?php } ?>
															</select>
														</div>
													</div>
													<div class="row form-group">
														<div class="col col-sm-6">
															<input name="tahun" type="text" placeholder="Tahun" class="form-control">
														</div>
													</div>
													<!-- Januari -->
													<div class="row form-group">
														<div class="col col-sm-2">
															<input name="jan" type="text" placeholder="Januari" value="01" readonly="" class="form-control">
														</div>
														<div class="col col-sm-4">
															<input name="jumlah1" type="number" placeholder="Jumlah Produk Terjual" class="form-control">
														</div>
													</div>
													
													<!-- Februari -->
													<div class="row form-group">
														<div class="col col-sm-2">
															<input name="feb" type="text" placeholder="Februari" value="02" readonly="" class="form-control">
														</div>
														<div class="col col-sm-4">
															<input name="jumlah2" type="number" placeholder="Jumlah Produk Terjual" class="form-control">
														</div>
													</div>
													
													<!-- Maret-->
													<div class="row form-group">
														<div class="col col-sm-2">
															<input name="mar" type="text" placeholder="Maret" value="03" readonly="" class="form-control">
														</div>
														<div class="col col-sm-4">
															<input name="jumlah3" type="number" placeholder="Jumlah Produk Terjual" class="form-control">
														</div>
													</div>
													
													<!-- April-->
													<div class="row form-group">
														<div class="col col-sm-2">
															<input name="apr" type="text" placeholder="April" value="04" readonly="" class="form-control">
														</div>
														<div class="col col-sm-4">
															<input name="jumlah4" type="number" placeholder="Jumlah Produk Terjual" class="form-control">
														</div>
													</div>
													
													<!-- Mei -->
													<div class="row form-group">
														<div class="col col-sm-2">
															<input name="mei" type="text" placeholder="Mei" value="05" readonly="" class="form-control">
														</div>
														<div class="col col-sm-4">
															<input name="jumlah5" type="number" placeholder="Jumlah Produk Terjual" class="form-control">
														</div>
													</div>
													
													<!-- Juni -->
													<div class="row form-group">
														<div class="col col-sm-2">
															<input name="jun" type="text" placeholder="Juni" value="06" readonly="" class="form-control">
														</div>
														<div class="col col-sm-4">
															<input name="jumlah6" type="number" placeholder="Jumlah Produk Terjual" class="form-control">
														</div>
													</div>
													
													<!-- Juli -->
													<div class="row form-group">
														<div class="col col-sm-2">
															<input name="jul" type="text" placeholder="Juli" value="07" readonly="" class="form-control">
														</div>
														<div class="col col-sm-4">
															<input name="jumlah7" type="number" placeholder="Jumlah Produk Terjual" class="form-control">
														</div>
													</div>
													
													<!-- Agustus-->
													<div class="row form-group">
														<div class="col col-sm-2">
															<input name="agt" type="text" placeholder="Agustus" value="08" readonly="" class="form-control">
														</div>
														<div class="col col-sm-4">
															<input name="jumlah8" type="number" placeholder="Jumlah Produk Terjual" class="form-control">
														</div>
													</div>
													
													<!-- September -->
													<div class="row form-group">
														<div class="col col-sm-2">
															<input name="sep" type="text" placeholder="September" value="09" readonly="" class="form-control">
														</div>
														<div class="col col-sm-4">
															<input name="jumlah9" type="number" placeholder="Jumlah Produk Terjual" class="form-control">
														</div>
													</div>
													
													<!-- Oktober -->
													<div class="row form-group">
														<div class="col col-sm-2">
															<input name="okt" type="text" placeholder="Oktober" value="10" readonly="" class="form-control">
														</div>
														<div class="col col-sm-4">
															<input name="jumlah10" type="number" placeholder="Jumlah Produk Terjual" class="form-control">
														</div>
													</div>
													
													<!-- November -->
													<div class="row form-group">
														<div class="col col-sm-2">
															<input name="nov" type="text" placeholder="November" value="11" readonly="" class="form-control">
														</div>
														<div class="col col-sm-4">
															<input name="jumlah11" type="number" placeholder="Jumlah Produk Terjual" class="form-control">
														</div>
													</div>
													
													<!-- Desember -->
													<div class="row form-group">
														<div class="col col-sm-2">
															<input name="des" type="text" placeholder="Desember" value="12" readonly="" class="form-control">
														</div>
														<div class="col col-sm-4">
															<input name="jumlah12" type="number" placeholder="Jumlah Produk Terjual" class="form-control">
														</div>
													</div>
													
													<div class="row form-group">
														<div class="col col-sm-6">
															<div class="form-actions form-group"><button type="submit" class="btn btn-info btn-md btn-block">Submit</button></div>
														</div>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
			</div><!-- /#right-panel -->
		<?php  include "_table.php";?>
</body>
</html>
