<!doctype html>
<html class="no-js" lang="">
<?php 
include "_head.php";
include 'model/class_bahanbaku.php';
$db = new bahanbaku();
?>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

<body>
    <div id="right-panel" class="right-panel">
        <?php include "_header.php"; ?>
        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header alert alert-info">
                                <i class="fa fa-edit"></i><strong>&nbsp;Ubah Data Bahan Baku</strong>
                            </div>
							<form action ="controller/proses_bahanbaku.php?aksi=update" method="post" class="form-horizontal">
								<?php 
									foreach ($db->edit($_GET['id']) as $m){
								?>
								<div class="card-body">
									<div class="col col-sm-8">
										<div class="form-group">
											<label>Kode</label>
											<input name="ID_bahanbaku" type="text" class="form-control" readonly="" value="<?php echo $m['ID_bahanbaku'];?>">
										</div>
										<div class="form-group">
											<label>Bahan Baku</label>
											<input name="deskripsi" type="text" class="form-control" value="<?php echo $m['deskripsi'];?>" required oninvalid="this.setCustomValidity('Nama tidak boleh kosong')" oninput="setCustomValidity('')">
										</div>
										<div class="form-group">
											<label>Satuan</label>
											<input name="unit" type="text" class="form-control" placeholder="cth: kg, butir" value="<?php echo $m['unit'];?>" required oninvalid="this.setCustomValidity('Satuan tidak boleh kosong')" oninput="setCustomValidity('')">
										</div>
										<div class="form-group">
											<label>Harga <small>per satuan</small></label>
											<input name="harga" type="number" placeholder="Rp." class="form-control" min=1 value="<?php echo $m['harga'];?>" Onkeypress="return event.charCode >= 48 && event.charCode <=57" required oninvalid="this.setCustomValidity('Harga tidak boleh kosong')" oninput="setCustomValidity('')">
										</div>
										<div class="form-group">
											<label>Safety Stock</label>
											<input name="safetystock" type="number" class="form-control" min=1 value="<?php echo $m['safetystock'];?>" Onkeypress="return event.charCode >= 48 && event.charCode <=57" required oninvalid="this.setCustomValidity('Safety Stock tidak boleh kosong')" oninput="setCustomValidity('')">
										</div>
										<div class="form-group">
											<label>Lotsize</label>
											<input name="lotsize" type="number" class="form-control" min=1 value="<?php echo $m['lotsize'];?>" Onkeypress="return event.charCode >= 48 && event.charCode <=57" required oninvalid="this.setCustomValidity('Lot Size tidak boleh kosong')" oninput="setCustomValidity('')">
										</div>
										<div class="form-group">
											<label>Kode Supplier</label>
											<select name="ID_supplier" class="form-control">
												<?php
													foreach ($db->tampil_supplier() as $m){
												?>	
													<option value="<?php echo $m['ID_supplier'];?>"> <?php print $m['nama_supplier'];?> </option>
												<?php
												}
												?>
											</select>
										</div>
										<a href=""><button type="submit" class="btn btn-info btn-md btn-block">Ubah Bahan Baku</button></a>  
										<br>
										<a href="bahanbaku.php"><button type="button" class="btn btn-outline-link btn-md btn-block">Batal</button></a>
									</div>
									<hr>
								</div>
									<?php } ?>
							</form>
                        </div>
                    </div>
                </div><!-- .row -->
            </div><!-- .animated -->
        </div><!-- .content -->
        <div class="clearfix"></div>
</body>
</html>
