<!doctype html>
<html class="no-js" lang="">
<?php 
include "_head.php"; 
include "model/koneksi.php";
include "model/class_produksi.php";
$db = new produksi();
?>

<body>
    <div id="right-panel" class="right-panel">
	<?php include "_header.php"; ?>
        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
					<a href="produksi_input.php" style="color:white"><button type="button" class="btn btn-md btn-info">Lakukan proses produksi&nbsp;&nbsp;<i class="fa fa-plus"></i></button></a>
                    <br><br>
					<?php
						$bulan = date('m');						
					?>
						<div class="card">
                            <div class="card-header alert alert-info">
                                <strong class="card-title">DATA PRODUKSI</strong>
                            </div>
                            <div class="card-body">
								<div class="col-md-3">
									<button type="button" class="btn btn-outline-info btn-md btn-block">Produksi bulan <b><?php $db->tampil_nama_bulan($bulan);?> <?php print date('Y');?></b> </button>
								</div>
							</div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th><center><small><b>Kode</small></center></th>
                                            <th><center><small><b>Tanggal</small></center></th>
											<th><center><small><b>Jumlah Produksi</small></center></th>
											<th><center><small><b>Terjual</small></center></th>
											<th><center><small><b>Tidak Terjual</small></center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
										$data = $db->tampil_produksi($bulan);
										if($data!=0){
											foreach($data as $m){
									?>
                                        <tr>
											<td><center><?php print $m['ID_produksi']; ?></center></td> 
											<td><center><?php print $m['pr_date']; ?></center></td> 
                                            <td><center><?php print $m['pr_total']; ?></center></td> 
                                            <td><center><?php print $sisa = $m['pr_total'] - $m['pr_jual']; ?></center></td>
                                            <td><center><span class="badge badge-warning"><?php print $m['pr_jual']; ?></span></center></td>
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
