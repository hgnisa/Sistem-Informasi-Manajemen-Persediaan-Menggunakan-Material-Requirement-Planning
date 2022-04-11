<!doctype html>
<html class="no-js" lang="">
<!-- Header-->
<?php 
include "_head.php";
include 'model/class_bom.php';
$db = new bom();

include 'model/class_produk.php';
$pd = new produk();

include 'model/class_bahanbaku.php';
$bk = new bahanbaku();
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
                                <i class="fa fa-edit"></i><strong>&nbsp;Ubah Bill of Material: <?php print $pd->tampil_nama_produk($_GET['ID_produk']);?></strong>
                            </div>
							<form action="controller/proses_bom.php?aksi=update&id=<?php echo $_GET['ID_produk']; ?>" method="post" class="form-horizontal">
								<?php 
									foreach ($db->edit($_GET['id']) as $m){
								?>
								<div class="card-body">
									<div class="col col-sm-12">
										<div class="form-group">
											<input name="ID_bom" type="hidden" class="form-control" readonly="" value="<?php echo $m['ID_bom'];?>">
										</div>
										<div class="form-group">
											<input name="ID_product" type="hidden" class="form-control" readonly="" value="<?php echo $_GET['ID_produk'];?>">
										</div>
										<div class="form-group">
											<label>Kode Bahan Baku </label>
											<input name="ID_bahanbaku" type="text" class="form-control" readonly="" value="<?php echo $m['ID_bahanbaku'];?>">
										</div>
										<div class="form-group">
											<label>Bahan Baku</label>
											<input name="deskripsi" type="text" class="form-control" readonly="" value="<?php foreach ($bk->tampil_bahanbaku($m['ID_bahanbaku']) as $o) { echo $o['deskripsi']; } ?>">
										</div>
										<div class="form-group">
											<label>Kuantitas dalam satu produk<small> per ukuran satuan</small></label>
											<input name="bom" type="number" class="form-control" placeholder="0.000" required min="0" value="<?php echo $m['bom'];?>" step="0.001" title="Currency" pattern="^\d+(?:\.\d{1,3})?$" onblur="
											this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,3})?$/.test(this.value)?'inherit':'red'">
										</div>
										<a href=""><button type="submit" class="btn btn-info btn-sm btn-block">Simpan BOM</button></a>  
										<br>
										<a href="bom.php?id=<?php echo $_GET['ID_produk']; ?>"><button type="button" class="btn btn-outline-link btn-md btn-block">Batal</button></a>
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
