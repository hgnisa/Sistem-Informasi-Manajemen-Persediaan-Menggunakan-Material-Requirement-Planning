<!doctype html>
<html class="no-js" lang="">
<?php 
include "_head.php"; 
include "model/class_peramalan.php";
$db = new peramalan();
?>
<body>
    <div id="right-panel" class="right-panel">
	<?php include "_header.php"; 
		$tahun= $_GET['ID'];
		$tahun_ramal = $tahun + 1;?>
        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
					<a class="btn btn-info" style="color:white" href="peramalan_daftar_print.php?ID=<?php print $tahun;?>">Cetak&nbsp;&nbsp;<i class="fa fa-print"></i></button></a>
                    <br><br>
					<div class="card">
                            <div class="card-header">
                                <strong class="card-title">Hasil Peramalan Penjualan Tahun <?php print $tahun_ramal; ?></strong>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="9%"><center><small><b>Bulan</center></th>
                                            <th width="10%"><center><small><b>Data Historis Penjualan <?php print $tahun; ?> (pcs)</center></th>
											<th width="10%"><center><small><b>Penghalusan (<i>smoothing</i>) (pcs)</center></th>
											<th width="10%"><center><small><b>Hasil Peramalan Penjualan <?php print $tahun + 1; ?> (pcs)</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
										include "model/koneksi.php";
										$i = 0;
										foreach ($db->daftar_hasil_peramalan($tahun) as $m) 
										{ 
											$i++;
											$forecast = ROUND($m['forecast']);
									?>
                                        <tr>
											<td><center><small><?php print $db->tampil_namabulan($i); ?></center></small></td> 
											<td><center><small><?php print $m['jumlah']; ?></center></small></td> 
											<td><center><small><?php print $m['smoothing']; ?></center></small></td> 
                                            <td><center><small><?php print $forecast; ?></center></small></td>
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
