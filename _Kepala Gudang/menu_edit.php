<!doctype html>
<html class="no-js" lang="">
<!-- Header-->
<?php 
include "_head.php";
include 'model/class_produk.php';
$db = new produk();
?>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<body>
    <div id="right-panel" class="right-panel">
        <?php include "_header.php"; ?>
        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header alert alert-info">
                                <i class="fa fa-edit"></i><strong>&nbsp;Ubah Data Menu / Produk</strong>
                            </div>
							<form action="controller/proses_produk.php?aksi=update" method="post" class="form-horizontal">
								<?php 
									foreach ($db->edit($_GET['id']) as $m){
								?>
								<div class="card-body">
									<div class="col col-sm-12">
										<div class="form-group">
											<label>Kode Menu</label>
											<input name="ID_produk" type="text" class="form-control" readonly="" value="<?php echo $m['ID_produk'];?>">
										</div>
										<div class="form-group">
											<label> Nama Menu </label>
											<input name="nama_produk" type="text" class="form-control" value="<?php echo $m['nama_produk'];?>">
										</div>
										<a href=""><button type="submit" class="btn btn-info btn-sm btn-block">Simpan Menu</button></a>  
										<br>
										<a href="menu.php"><button type="button" class="btn btn-outline-link btn-md btn-block">Batal</button></a>
									</div>
									<hr>
								</div>
								<?php
									}
								?>
							</form>
                        </div>
                    </div>
                </div><!-- .row -->
            </div><!-- .animated -->	
        </div><!-- .content -->
        <div class="clearfix"></div>
</body>
</html>
