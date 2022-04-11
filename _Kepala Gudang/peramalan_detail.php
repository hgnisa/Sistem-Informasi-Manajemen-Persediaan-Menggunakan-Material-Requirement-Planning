<!doctype html>
<html class="no-js" lang="">
<?php 
include "_head.php";
include "model/class_peramalan.php";
$db = new peramalan();

include "model/class_produk.php";
$pr = new produk();
?>

<body>
    <div id="right-panel" class="right-panel">
	<?php include "_header.php"; ?>
        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-5">
						<div class="card">
						<?php
							$tahun= $_GET['ID'];
							$tahun_depan = $tahun + 1;
						?>
                            <div class="card-header">
                                <strong class="card-title">Filter Hasil Peramalan Tahun <?php print $tahun_depan;?></strong>
                            </div>
                            <div class="card-body">
                               <div class="col-md-12">
									<div class="card">
										<div class="card-header bg-info">
											<strong class="card-title text-light">Pilih Bulan: </strong>
										</div>
										<form method="POST" action="peramalan_detail2.php?ID=<?php print $tahun;?>">
											<div class="card-body text-white bg-info">
												<p class="card-text text-light">
													<select name="ID_produk" class="form-control">
														<option value="P-001"><center> Pilih Produk </center></option>
															<?php
															foreach($pr->tampil_produk() as $m)
															{ 
															?>	
															<option value="<?php print $m['ID_produk'];?>"> <?php print $m['nama_produk'];?></option>
															<?php
															}
															?>
													</select>
												</p>
												<p class="card-text text-light">
													<select name="bulan" class="form-control">
														<option value="01"><center> Pilih Bulan </center></option>
															<?php
															foreach($db->daftar_hasil_peramalan($tahun) as $m)
															{ 
															?>	
															<option value="<?php print $m['bulan'];?>"> <?php print $m['bulan'];?></option>
															<?php
															}
															?>
													</select>
												</p>
												<p class="card-text text-light">
													<button class="btn btn-outline-link btn-sm">Tampilkan</button>
												</p>
											</div>
										</form>
									</div>
								</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .animated -->
        </div><!-- .content -->
		<div class="clearfix"></div>
		<?php include "_table.php";?>
</body>
</html>
