<!doctype html>
<html class="no-js" lang="">
<?php 
include "_head.php"; 
include "model/koneksi.php";
include 'model/class_pembelian.php';
$pb = new pembelian(); 
include 'model/class_supplier.php';
$sp = new supplier();

$deskripsi = $_GET['deskripsi'];
$ID_bahanbaku = $pb->tampil_kode_bahanbaku(deskripsi);
?>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

<body>
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <?php include "_header.php";?>
        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header alert alert-info">
                                <i class="fa fa-edit"></i><strong>&nbsp;Pembelian Bahan Baku</strong>
                            </div>
							<?php
							if(is_array($pb->beli($_GET['deskripsi']))){
								foreach($pb->beli($_GET['deskripsi']) as $m) {
									$ID_mrp = $m['ID_mrp'];
								}
							}
								if($ID_mrp != null){
										//Sesuai dengan POREL
										?>
										<form action="controller/proses_pembelian.php?aksi=keranjang_tambah" method="post" class="form-horizontal">
											<div class="card-body">
												<div class="col col-sm-12">
													<div class="form-group">
														<label>Supplier</label>
														<input name="nama_supplier" type="text" class="form-control" readonly="" value="<?php print $m['nama_supplier']?>" >
													</div>
													<div class="form-group">
														<label>Bahan Baku</label>
														<input name="deskripsi" type="text" class="form-control" readonly="" value="<?php print $deskripsi?>">
													</div>
													<div class="form-group">
														<label>Jumlah Pemesanan sesuai <i>lot size</i></label>
														<input name="lotsize" type="text" class="form-control" readonly="" value="<?php print $m['lotsize']?>">
													</div>
													<div class="form-group">
														<input name="hari_sampai" type="hidden" value="POREL" class="form-control">
													</div>
													<a href=""><button type="submit" class="btn btn-info btn-md btn-block">Pesan</button></a>  
													<br>
													<a href="pembelian_input.php"><button type="button" class="btn btn-outline-link btn-md btn-block">Batal</button></a>
												</div>
												<hr>
											</div>
										</form>
								<?php
								}
								else{
								?>
										<form action="controller/proses_pembelian.php?aksi=keranjang_tambah" method="post" class="form-horizontal">
											<div class="card-body">
												<div class="col col-sm-12">
													<div class="form-group">
														<span class="badge badge-info">*Pembelian ini dilakukan di luar jadwal MRP (Tanggal POREL)</span>
													</div>
													<div class="form-group">
														<label>Supplier</label>
														<select name="nama_supplier" class="form-control">
														<?php
															foreach($pb->supplier() as $m) {
														?>	
															<option value="<?php print $m['nama_supplier'];?>"> <?php print $m['nama_supplier']; } ?></option>
														</select>
														<button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-link">Tambah supplier<i class="fa fa-plus"></i></button>
													</div>
													<div class="form-group">
														<label>Bahan Baku</label>
														<input name="deskripsi" type="text" class="form-control" readonly="" value="<?php print $deskripsi?>">
													</div>
													<div class="form-group">
														<label>Jumlah Pemesanan</label>
														<div class="row">
															<div class="col-md-6">
																<input name="lotsize" type="number" min=0 class="form-control" Onkeypress="return event.charCode >= 48 && event.charCode <=57" required oninvalid="this.setCustomValidity('Jumlah Pemesanan tidak boleh kosong')" oninput="setCustomValidity('')">
															</div>
															<div class="col-md-6">
																<select name="ukuran" class="form-control">
																<?php
																	foreach($pb->ukuran() as $m) {
																?>	
																	<option value="<?php print $m['nilai'];?>"> <?php print $m['ukuran']. " (".$m['nilai']." ".$m['unit'].")"; } ?></option>
																</select>
															</div>
														</div>
														</div>
													<div class="form-group">
														<label>Sampai dalam (hari)</label>
														<input name="hari_sampai" type="number" min=0 max=7 class="form-control" Onkeypress="return event.charCode >= 48 && event.charCode <=57" required oninvalid="this.setCustomValidity('Hari sampai tidak boleh kosong')" oninput="setCustomValidity('')">
													</div>
													<a href=""><button type="submit" class="btn btn-info btn-md btn-block">Pesan</button></a>  
													<br>
													<a href="pembelian_input.php"><button type="button" class="btn btn-outline-link btn-md btn-block">Batal</button></a>
												</div>
												<hr>
											</div>
										</form>
							<?php
								}
							?>
                        </div>
                    </div>
                </div><!-- .row -->
            </div><!-- .animated -->
        </div><!-- .content -->
		
		<!-- modal input Supplier -->
		<div id="myModal" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 align="center"><small>Tambah <i>Supplier</i></small></h4>
					</div>
					<div class="modal-body"> 
							<form action="controller/proses_supplier.php?aksi=tambah" method="post">
								<div class="form-group">
									<label>Kode Supplier</label>
									<input name="ID_supplier" type="text" class="form-control" readonly="" type="text" value="<?php echo $sp->kode_supplier(); ?>">
								</div>
								<div class="form-group">
									<label>Nama Supplier</label>
									<input name="nama_supplier" type="text" class="form-control" required oninvalid="this.setCustomValidity('Supplier tidak boleh kosong')" oninput="setCustomValidity('')">
								</div>
								<div class="form-group">
									<label>Alamat Supplier</label>
									<input name="alamat_supplier" type="text" class="form-control" required oninvalid="this.setCustomValidity('Alamat tidak boleh kosong')" oninput="setCustomValidity('')">
								</div>
									<div class="form-group">
									<label>Telp Supplier</label>
									<input name="telp_supplier" type="text" class="form-control" Onkeypress="return event.charCode >= 48 && event.charCode <=57" maxlength=12 required oninvalid="this.setCustomValidity('Telp tidak boleh kosong')" oninput="setCustomValidity('')">
								</div>	
								<div class="form-group">
									<label>Email Supplier</label>
									<input name="email_supplier" type="email" class="form-control" required oninvalid="this.setCustomValidity('Email tidak boleh kosong')" oninput="setCustomValidity('')">
								</div>														
								<div class="modal-footer">
								<a href="pembelian_input.php"><button type="button" class="btn btn-default">Batal</button></a>
								<input type="submit" class="btn btn-primary" value="Simpan">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		
        <div class="clearfix"></div>
		<?php include "_table.php";?>
</body>
</html>
