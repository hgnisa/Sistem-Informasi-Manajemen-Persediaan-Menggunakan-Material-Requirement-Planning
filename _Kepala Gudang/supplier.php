<!doctype html>
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<!-- Head -->
<?php include "_head.php"; ?>
<?php 
include 'model/class_supplier.php';
$db = new supplier(); 
?>
<body>
    <div id="right-panel" class="right-panel">
	<?php include "_header.php"; ?>
        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
					<button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-md btn-info"><a  style="color:white">Tambah Supplier</a>&nbsp;&nbsp;<i class="fa fa-plus"></i></button>  
					<a class="btn btn-info" style="color:white" href="supplier_print.php">Cetak&nbsp;&nbsp;<i class="fa fa-print"></i></button></a>
                    <br><br>
						<div class="card">
                            <div class="card-header alert alert-info">
                                <strong class="card-title">DATA SUPPLIER</strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th><center><small><b>Kode</center></th>
                                            <th><center><small><b>Nama Supplier</center></th>
											<th><center><small><b>Alamat</center></th>
                                            <th><center><small><b>No. Telepon</center></th>
                                            <th><center><small><b>Email</center></th>
											<th><center><small><b><i>Aksi</center></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
										$data = $db->tampil_supplier();
										if($data!=0){
											foreach($data as $m){
									?>
                                        <tr>
											<td><center><?php print $m['ID_supplier']; ?></center></td> 
                                            <td><center><?php print $m['nama_supplier'];?></td>
                                            <td><center><?php print $m['alamat_supplier']; ?></center></td> 
                                            <td><center><?php print $m['telp_supplier']; ?></center></td> 
                                            <td><center><?php print $m['email_supplier']; ?></center></td>
											<td><center>
											<a href="supplier_edit.php?id=<?php echo $m['ID_supplier'];?>&aksi=edit" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
											<a href="controller/proses_supplier.php?id=<?php echo $m['ID_supplier']; ?>&aksi=hapus"><button class="btn btn-warning btn-sm"><i class="fa fa-trash-o "></i></button></a>
											</center></td>
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
		           
		<!-- modal input Supplier -->
		<div id="myModal" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 align="center"><small>Tambah <i>Supplier</i></small></h4>
					</div>
					<div class="modal-body"> 
									<?php
									include "model/koneksi.php";
									
									$ambilKode = mysqli_query($con, "SELECT substr((max(ID_supplier)), 5, 3) as maxKode FROM supplier");
									$ambilKode1 = mysqli_fetch_array($ambilKode);
									$ID1 = $ambilKode1['maxKode'];
									$ID1 = $ID1 + 1;
									
									if ($ID1 < 10){
										$char = "SUP-00";
										$final = $char . $ID1;
									}
									else{
										$char = "SUP-0";
										$final = $char . $ID1;
									}
									?>

							<form action="controller/proses_supplier.php?id=<?php echo $m['ID_supplier']; ?>&aksi=tambah" method="post">
								<div class="form-group">
									<label>Kode Supplier</label>
									<input name="ID_supplier" type="text" class="form-control" readonly="" type="text" value="<?php echo $final; ?>">
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
								<a href="supplier.php"><button type="button" class="btn btn-default">Batal</button></a>
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
