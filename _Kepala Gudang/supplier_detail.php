<!doctype html>
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<!-- Head -->
<?php include "_head.php"; ?>

<body>
    <div id="right-panel" class="right-panel">
	<?php include "_header.php"; 
		  $ID_supplier = $_GET['ID_supplier'];
	?>
        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
						<div class="card">
                            <div class="card-header">
							<?php
							$query = mysqli_query($con, "SELECT * FROM supplier WHERE ID_supplier = '$ID_supplier'");
							$a = mysqli_fetch_object($query);
							?>
                                <strong class="card-title">Data Bahan Baku Supplier: <?php echo $a->nama_supplier;?></strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th><center><small><b>Kode</center></th>
                                            <th><center><small><b>Bahan Baku</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
										include "Controller/koneksi.php";
											$i=0;
											$query = mysqli_query($con, "SELECT * from bahanbaku WHERE ID_supplier = '$ID_supplier';");
											while($m = mysqli_fetch_array($query))
											{ $i++ 
									?>
                                        <tr>
											<td><center><?php print $m['ID_bahanbaku']; ?></center></td> 
                                            <td><center><?php print $m['deskripsi'];?></td>
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
