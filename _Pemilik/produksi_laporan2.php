<!doctype html>
<html class="no-js" lang="">
<?php include "_head.php"; ?>

<body>
    <div id="right-panel" class="right-panel">
	<?php 
		include "_header.php"; 
		include "model/koneksi.php";
		include "model/class_produk.php";
		$db = new produk();
		$awal = $_POST['awal'];
		$akhir = $_POST['akhir'];
		
		$tgl_awal = date('Y-m-d', strtotime($awal)); 
		$tgl_akhir = date('Y-m-d', strtotime($akhir)); 
	?>
        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
					<div class="col-md-4">
						<div class="card border border-info">
							<form method="POST" action="produksi_laporan2.php">
								<div class="card-body">
									<small> Tanggal Awal: </small>
									<input type="date" name="awal" class="form-control" required oninvalid="this.setCustomValidity('Tanggal tidak boleh kosong')" oninput="setCustomValidity('')"><br>
									<small> Tanggal Akhir: </small>
									<input type="date" name="akhir" class="form-control" required oninvalid="this.setCustomValidity('Tanggal tidak boleh kosong')" oninput="setCustomValidity('')">
									<br>
									<button class="btn btn-info btn-sm">Tampilkan</button>
								</div>
							</form>
						</div>
					</div>
				</div>
                <div class="row">
                    <div class="col-md-12">
						<a class="btn btn-info" style="color:white" href="produksi_print.php?tanggal=<?php print $tgl_awal.$tgl_akhir;?>">Cetak&nbsp;&nbsp;<i class="fa fa-print"></i></button></a>
						<br><br>
						<div class="card">
							<div class="card-header alert alert-info">
								<strong class="card-title">Data Produksi Ollanda Brownies</strong>
							</div>
							<div class="card-body">
								<table id="bootstrap-data-table" class="table table-striped table-bordered">
									<thead>
										<tr>
                                            <th><center><small><b>Kode Produksi</small></center></th>
                                            <th><center><small><b>Produk</small></center></th>
                                            <th><center><small><b>Tanggal</small></center></th>
                                            <th><center><small><b>Pre-Order (pcs)</small></center></th>
                                            <th><center><small><b>Total (pcs)</small></center></th>
                                            <th><center><small><b>Tersisa (pcs)</small></center></th>
                                        </tr>
									</thead>
									<tbody>
										<?php
											$query = mysqli_query($con, "SELECT * FROM produksi WHERE pr_laporan BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."'");
											while($m = mysqli_fetch_array($query))
											{
										  ?>
                                        <tr>
											<td><center><?php print $m['ID_produksi']; ?></center></td> 
											<td><center><?php print $db->tampil_nama_produk($m['ID_produk']); ?></center></td> 
											<td><center><?php print $m['pr_date']; ?></center></td> 
											<td><center><?php print $m['pr_sr']; ?></center></td> 
											<td><center><?php print $m['pr_total']; ?></center></td> 
											<td><center><?php print $m['pr_total'] - $m['pr_jual']; ?></center></td>
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
