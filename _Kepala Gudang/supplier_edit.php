<!doctype html>
<?php $i = 0;?>
<html class="no-js" lang="">
<!-- Header-->
<?php include "_head.php"; ?>
<?php 
include 'model/class_supplier.php';
$db = new supplier(); 
?>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

<body>
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <?php include "_header.php"; ?>
        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header alert alert-info">
                                <i class="fa fa-edit"></i><strong>&nbsp;Ubah Data Supplier</strong>
                            </div>
							<form action="controller/proses_supplier.php?aksi=update" method="post" class="form-horizontal">
								<?php 
									foreach ($db->edit($_GET['id']) as $m){
								?>
								<div class="card-body">
									<div class="col col-sm-8">
										<div class="form-group">
											<label>Kode</label>
											<input name="ID_supplier" type="text" class="form-control" readonly="" value="<?php echo $m['ID_supplier'];?>">
										</div>
										<div class="form-group">
											<label>Nama Supplier</label>
											<input name="nama_supplier" type="text" class="form-control" value="<?php echo $m['nama_supplier'];?>" required oninvalid="this.setCustomValidity('Supplier tidak boleh kosong')" oninput="setCustomValidity('')">
										</div>
										<div class="form-group">
											<label>Alamat</label>
											<input name="alamat_supplier" type="text" class="form-control" value="<?php echo $m['alamat_supplier'];?>" required oninvalid="this.setCustomValidity('Alamat tidak boleh kosong')" oninput="setCustomValidity('')">
										</div>
										<div class="form-group">
											<label>No Telp</label>
											<input name="telp_supplier" type="number" class="form-control" value="<?php echo $m['telp_supplier'];?>" Onkeypress="return event.charCode >= 48 && event.charCode <=57" maxlength=12 required oninvalid="this.setCustomValidity('Telp tidak boleh kosong')" oninput="setCustomValidity('')">
										</div>
										<div class="form-group">
											<label>Email</label>
											<input name="email_supplier" type="email" class="form-control" value="<?php echo $m['email_supplier'];?>" required oninvalid="this.setCustomValidity('Email tidak boleh kosong')" oninput="setCustomValidity('')">
										</div>
										<a href=""><button type="submit" class="btn btn-info btn-md btn-block">Ubah Supplier</button></a> 
										<br>
										<a href="supplier.php"><button type="button" class="btn btn-outline-link btn-md btn-block">Batal</button></a>
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
