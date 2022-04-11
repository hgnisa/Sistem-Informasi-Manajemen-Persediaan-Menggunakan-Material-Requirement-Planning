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
	?>
        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
					<div class="col-md-4">
						<div class="card border border-info">
							<form method="POST" action="penjualan_laporan2.php">
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
						<button type="button" class="btn btn-md btn-info"><a style="color:white">Cetak</a>&nbsp;&nbsp;<i class="fa fa-print"></i></button>
						<br><br>
						<div class="card">
							<div class="card-header alert alert-info">
								<strong class="card-title">Data Penjualan Ollanda Brownies</strong>
							</div>
							<div class="card-body">
								<table id="bootstrap-data-table" class="table table-striped table-bordered">
									<thead>
										<tr>
                                            <th><center><small><b>Kode Penjualan</small></center></th>
                                            <th><center><small><b>Produk</small></center></th>
                                            <th><center><small><b>Tanggal</small></center></th>
                                            <th><center><small><b>Total</small></center></th>
                                            <th><center><small><b>Harga</small></center></th>
                                        </tr>
									</thead>
									<tbody>
										<?php
											$query = mysqli_query($con, "SELECT * FROM penjualan WHERE pj_laporan BETWEEN '0000-00-00' AND '0000-00-00'");
											while($m = mysqli_fetch_array($query))
											{
										  ?>
                                        <tr>
											<td><center><?php print $m['ID_penjualan']; ?></center></td> 
											<td><center><?php print $db->tampil_nama_produk($m['ID_produk']); ?></center></td>
											<td><center><?php print $m['pj_date']; ?></center></td> 
											<td><center><?php print $m['pj_date']; ?></center></td> 
											<td><center><?php print $m['pj_jumlah']; ?></center></td> 
											<td><center><?php print $m['pj_harga']; ?></center></td>
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
