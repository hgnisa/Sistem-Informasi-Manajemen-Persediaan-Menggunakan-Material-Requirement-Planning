<!doctype html>
<html class="no-js" lang="">
<?php 
include "_head.php";
include 'model/koneksi.php';
include 'model/class_notifikasi.php';
$nf = new notifikasi();
include 'model/class_pembelian.php';
$pb = new pembelian(); ?> 
<body>
    <div id="right-panel" class="right-panel">
	<?php include "_header.php"; ?>              
		<div class="content">
			<!-- Tampil Notif Porel-->
			<?php $nf->tampil_notifikasi_mrp(); ?>
			<div class="animated fadeIn">
                <div class="row">
					<div class="col-md-5">
						<a href="pembelian.php" style="color:white"><button type="button" class="btn btn-md btn-info">Lihat Data Pembelian&nbsp;&nbsp;<i class="fa fa-search"></i></button></a>
						<br><br>
					</div>
				</div>
                <div class="row">
                    <div class="col-md-5">
						<div class="card">
                            <div class="card-header alert alert-info">
                                <strong class="card-title">PEMBELIAN BAHAN BAKU</strong>
                            </div>
							<div class="card-body">
                                <table class="table">
                                    <?php
										foreach($pb->bahanbaku() as $m) {
									?>
                                    <tbody>
											<td><center><small><?php print $m['deskripsi'];?></font></small></center></td>
                                            <td><center><a href="pembelian_input2.php?deskripsi=<?php print $m['deskripsi'];?>"><button type="button" class="btn btn-info btn-sm">+</button></center></td>
                                        </tr>
                                    </tbody>
									<?php
										}
									?> 
                                </table>
                            </div>
                        </div>
                    </div>
					
					<div class="col-md-7">
                        <div class="card">
                            <div class="card-header alert alert-info">
                                <strong class="card-title">Keranjang <i class="fa fa-shopping-cart"></i></strong>
                            </div>
                            <div class="card-body"> 
							<?php
								$query = mysqli_query($con, "SELECT DISTINCT ID_supplier FROM keranjang");
								while($m = mysqli_fetch_array($query))
								{ 
									$ID_supplier =  $m['ID_supplier'];
									
									$query1 = mysqli_query($con, "SELECT * FROM supplier WHERE ID_supplier = '$ID_supplier'");
									while($n = mysqli_fetch_array($query1))
									{
										$nama_supplier = $n['nama_supplier'];
									}
									
									
							?>
								<table id="myTable" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="30%"><center><?php print $nama_supplier?></center></th>
                                        </tr>
                                    </thead>
									
									<?php
									$temp = 0;
									$total = 0;
									$final = 0;
									$query2 = mysqli_query($con, "SELECT * FROM keranjang WHERE ID_supplier = '$ID_supplier'");
									while($o = mysqli_fetch_array($query2))
									{
										$ID_bahanbaku = $o['ID_bahanbaku'];
										$jumlah = $o['jumlah'];
										$ID_keranjang = $o['ID_keranjang'];
										
											$query3 = mysqli_query($con, "SELECT * FROM bahanbaku WHERE ID_bahanbaku = '$ID_bahanbaku'");
											while($p = mysqli_fetch_array($query3))
											{
												$deskripsi = $p['deskripsi'];
												$unit = $p['unit'];
												$harga = $p['harga'];
											}
									
									?>
                                    <tbody>
										<tr>
											<td width="30%"><center><small><?php print $deskripsi;?></small></center></td>
                                            <td width="10%"><center><small><?php print $jumlah;?>&nbsp;<?php print $unit;?></small></center></td>
                                            <td width="10%"><center><small><?php print "Rp. ".$total = $jumlah*$harga; $temp = $total; $final += $temp;?></small></center></td>
											<td width="10%"><center>
											<a href="controller/proses_pembelian.php?id=<?php echo $ID_keranjang;?>&aksi=keranjang_hapus"><button class="btn btn-warning btn-sm"><i class="fa fa-trash-o "></i></button></a>
											</center></td>
                                        </tr>
									<?php 
									}
									?>
									
										<tr>
											<td> </td>
											<td> </td>
											<td width="30%"><b><center><small><?php print "Total:  ".$final;?></small></center></b></td>
                                        </tr>
                                    </tbody>
									<thead>
                                        <tr>
                                            <th><center><small><a href="controller/proses_pembelian.php?aksi=tambah&ID_supplier=<?php print $ID_supplier;?>"><button class="btn btn-info btn-sm btn-block">Pesan</button></a></center></th>
                                        </tr>
                                    </thead>
                                </table>
								<br><br>
								<?php 
								}
								?>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .animated -->
        </div><!-- .content -->
				
		<!-- Footer -->
		<?php include "_table.php"; ?>
</body>
</html>
