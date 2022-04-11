<!doctype html>
<html class="no-js" lang="">
<?php 
include "_head.php"; 
include "model/koneksi.php";
include 'model/class_produk.php';
$db = new produk(); 
?>
<body>
    <div id="right-panel" class="right-panel">
	<?php include "_header.php"; ?>
        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
						<a class="btn btn-info" style="color:white" href="menu_print.php">Cetak&nbsp;&nbsp;<i class="fa fa-print"></i></button></a>
						<br><br>
						<div class="card">
                            <div class="card-header alert alert-info">
                                <strong class="card-title">PRODUK / MENU</strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th><small><b>Kode</small></th>
                                            <th><small><b>Kode Produk</small></th>
											<th><small><b>Detail</small></th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									$data = $db->tampil_produk();
									if($data!=0){
										foreach($data as $m){
									?>
                                        <tr>
											<td><?php print $m['ID_produk']; ?></td> 
											<td><?php print $m['nama_produk']; ?></td> 
											<td>
											<a href="bom.php?id=<?php echo $m['ID_produk'];?>" class="btn btn-info btn-sm">BOM <i class="fa fa-search"></i></a>
											</td>
                                        </tr>
									 <?php } 
									}
									?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		
		<!-- Model Tambah Bahan Baku -->
		<div id="myModal" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 align="center"><small> Menambah Produk Baru </small></h4>
					</div>
					<div class="modal-body">
						<form action="controller/proses_produk.php?&aksi=tambah" method="post">
							<div class="form-group">
								<label>Kode Menu</label>
								<input name="ID_produk" type="text" class="form-control" readonly="" value="<?php print $db->tampil_kode(); ?>">
							</div>
							<div class="form-group">
								<label>Nama Menu</label>
								<input name="nama_produk" type="text" class="form-control" required oninvalid="this.setCustomValidity('Nama produk tidak boleh kosong')" oninput="setCustomValidity('')">
							</div>
							<div class="modal-footer">
							<a href="menu.php"><button type="button" class="btn btn-default">Batal</button></a>
							<input type="submit" class="btn btn-primary" value="Simpan">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<?php  include "_table.php";?>
</body>
</html>
