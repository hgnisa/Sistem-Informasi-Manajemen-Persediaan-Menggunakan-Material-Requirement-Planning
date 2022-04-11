<!doctype html>
<html class="no-js" lang="">
<?php 
include "_head.php"; 
include "model/class_produk.php";
$db = new produk();
?>
<body>
    <div id="right-panel" class="right-panel">
	<?php include "_header.php"; ?>
        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
						<div class="card">
                            <div class="card-header alert alert-info">
                                <strong class="card-title">HASIL PERAMALAN</strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="serial"><center>#</center></th>
                                            <th><center>Data Penjualan Tahun</center></th>
                                            <th><center>Detail</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
										include "model/koneksi.php";

										$i = 0;
										$kode = "";
										$tampil = "";
										$query = mysqli_query($con, "SELECT substr(ID, 1, 4) as maxKode FROM peramalan");
										while ($m=mysqli_fetch_array($query))
										{		
											$tampil = $m['maxKode'];
											if ($tampil != $kode){
												
											$i++;
									?>
                                        <tr>
											<td><center><?php print $i; ?></center></td>
                                            <td><center><?php print $tampil; $kode = $tampil; ?></center></td>
                                            <td>
												<center><a href="peramalan_detail.php?ID=<?php print $tampil;?>"><button class="btn btn-info btn-sm"><i class="fa fa-search"></i></button></a>
												        <a href="peramalan_daftar.php?ID=<?php print $tampil;?>"><button class="btn btn-info btn-sm"><i class="fa fa-list"></i></button></a></center>
											</td>
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
            </div><!-- .animated -->
        </div><!-- .content -->
		
		<!--footer -->
		<?php  include "_table.php";?>
</body>
</html>
