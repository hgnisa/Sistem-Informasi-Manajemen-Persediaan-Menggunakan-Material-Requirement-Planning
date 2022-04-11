<!doctype html>
<html class="no-js" lang="">
<?php 
include "_head.php";
include 'model/class_bahanbaku.php';
$db = new bahanbaku(); 
?>
<body>
    <div id="right-panel" class="right-panel">
	<?php include "_header.php"; ?>
        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
					<a class="btn btn-info" style="color:white" href="bahanbaku_print.php">Cetak&nbsp;&nbsp;<i class="fa fa-print"></i></button></a>
                    <br><br>
						<div class="card">
                            <div class="card-header alert alert-info">
                                <strong class="card-title">DATA BAHAN BAKU</strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="9%"><center><small><b>Kode</center></th>
                                            <th width="10%"><center><small><b>Bahan Baku</center></th>
											<th width="10%"><center><small><b>Stock</center></th>
											<th width="5%"><center><small><b>Reorder Point</center></th>
											<th width="10%"><center><small><b>Harga</center></th>
											<th width="10%"><center><small><b><i>Safety Stock</i></center></th>
											<th width="10%"><center><small><b><i>Lot Size</i></center></th>
											<th width="10%"><center><small><b>Leadtime</center></th>
											<th width="10%"><center><small><b>Supplier</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
										$data = $db->tampil_bahanbaku_supplier();
										if($data!=0){
											foreach($data as $m){
									?>
                                        <tr>
											<td><center><?php print $m['ID_bahanbaku'];?></center></td> 
                                            <td><center><?php print $m['deskripsi'];?> </center></td>
                                            <td><center><?php print $m['qty']." <small>".$m['unit']."</small>"; ?></center></td> 
											<td><center><?php print $m['rop']; ?></center></td> 
											<td><center><?php print $m['harga']." /<small>".$m['unit']."</small>"; ?></center></td> 
											<td><center><?php print $m['safetystock']." <small>".$m['unit']."</small>"; ?></center></td> 
											<td><center><?php print $m['lotsize']." <small>".$m['unit']."</small>"; ?></center></td> 
                                            <td><center><?php print $m['leadtime']." <small>hari</small>"; ?></center></td>
                                            <td><center><?php print $m['nama_supplier']; ?></center></td>
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
		
		<!-- Model Tambah Bahan Baku -->
		<div id="myModal" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 align="center"><small>Tambah Bahan Baku</small></h4>
					</div>
					<div class="modal-body">
						<form action="controller/proses_bahanbaku.php?id=<?php echo $db->tampil_kode(); ?>&aksi=tambah" method="post">
							<div class="form-group">
								<label>Kode</label>
								<input name="ID_bahanbaku" type="text" class="form-control" type="text" readonly="" value="<?php echo $db->tampil_kode(); ?>">
							</div>
							<div class="form-group">
								<label>Bahan Baku</label>
								<input name="deskripsi" type="text" class="form-control" required oninvalid="this.setCustomValidity('Nama tidak boleh kosong')" oninput="setCustomValidity('')">
							</div>
							<div class="form-group">
								<label>Jumlah Persediaan</label>
								<input name="qty" type="number" min=1 class="form-control" Onkeypress="return event.charCode >= 48 && event.charCode <=57" required oninvalid="this.setCustomValidity('Jumlah tidak boleh kosong')" oninput="setCustomValidity('')">
							</div>
							<div class="form-group">
								<label>Satuan</label>
								<input name="unit" type="text" class="form-control" placeholder="cth: kg, butir" required oninvalid="this.setCustomValidity('Satuan tidak boleh kosong')" oninput="setCustomValidity('')">
							</div>		
							<div class="form-group">
								<label>Harga</label>
								<input name="harga" type="number" min=1 placeholder="Rp. "class="form-control" Onkeypress="return event.charCode >= 48 && event.charCode <=57" required oninvalid="this.setCustomValidity('Harga tidak boleh kosong')" oninput="setCustomValidity('')">
							</div>				
							<div class="form-group">
								<label>Safety Stock</label>
								<input name="safetystock" type="number" min=1 class="form-control" Onkeypress="return event.charCode >= 48 && event.charCode <=57" required oninvalid="this.setCustomValidity('Safety stock tidak boleh kosong')" oninput="setCustomValidity('')">
							</div>			
							<div class="form-group">
								<label>Lot Size</label>
								<input name="lotsize" type="number" min=1 class="form-control" Onkeypress="return event.charCode >= 48 && event.charCode <=57" required oninvalid="this.setCustomValidity('Lot size tidak boleh kosong')" oninput="setCustomValidity('')">
							</div>	
							<div class="form-group">
								<label>Leadtime</label>
								<input name="leadtime" type="number" min=0 max=7 class="form-control" Onkeypress="return event.charCode >= 48 && event.charCode <=57" required oninvalid="this.setCustomValidity('Lot size tidak boleh kosong')" oninput="setCustomValidity('')">
							</div>											
								Supplier 
								<select name="ID_supplier" class="form-control">
									<?php 
										foreach($db->tampil_supplier() as $m) {
									?>
										<option value="<?php print $m['ID_supplier'];?>"> <?php print $m['nama_supplier']; ?></option>
									<?php
									}
									?>
								</select>
							<div class="modal-footer">
							<a href="bahanbaku.php"><button type="button" class="btn btn-default">Batal</button></a>
							<input type="submit" class="btn btn-primary" value="Simpan">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>	
		
		<!--footer -->
		<?php  include "_table.php";?>
</body>
</html>
