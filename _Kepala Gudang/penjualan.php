<!doctype html>
<html class="no-js" lang="">
<?php 
include "_head.php"; 
include "model/koneksi.php";
include "model/class_produk.php";
include "model/class_penjualan.php";
$db = new penjualan();
$pr = new produk();

$bulan = date('m');
?>
<body>
    <div id="right-panel" class="right-panel">
	<?php include "_header.php"; ?>
        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
					<a href="penjualan_input.php" style="color:white"><button type="button" class="btn btn-md btn-info">Tambah Transaksi Penjualan&nbsp;&nbsp;<i class="fa fa-plus"></i></button></a>
                    <br><br>
						<div class="card">
                            <div class="card-header alert alert-info">
                                <strong class="card-title">DATA PENJUALAN</strong>
                            </div>
                            <div class="card-body">
								<div class="col-md-4">
									<button type="button" class="btn btn-outline-info btn-md btn-block">Penjualan bulan <b><?php print $db->tampil_namabulan($bulan);?> <?php print date('Y');?></b> </button>
								</div>
							</div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th><center><small><b>Kode</small></center></th>
                                            <th><center><small><b>Produk</small></center></th>
											<th><center><small><b>Tanggal</small></center></th>
											<th><center><small><b>Jumlah</small></center></th>
											<th><center><small><b>Harga</small></center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
										$data = $db->tampil_penjualan();
										if($data!=0){
											foreach($data as $m){
									?>
                                        <tr>
											<td><center><?php print $m['ID_penjualan']; ?></center></td> 
											<td><center><?php print $pr->tampil_nama_produk($m['ID_produk']); ?></center></td> 
                                            <td><center><?php print $m['pj_date']; ?></center></td> 
                                            <td><center><?php print $m['pj_jumlah']; ?></center></td>
											<td><center>Rp. <?php print $m['pj_harga']; ?></center></td>
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
