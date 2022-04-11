<!doctype html>
<html class="no-js" lang="">
<?php 
include "_head.php"; 
include "model/koneksi.php";
include 'model/class_produk.php';
$db = new produk(); 
$ID_produk = $_GET['id'];
?>
<body>
    <div id="right-panel" class="right-panel">
	<?php include "_header.php"; ?>
        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
						<button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-md btn-info"><a  style="color:white">Tambah BOM</a>&nbsp;&nbsp;<i class="fa fa-plus"></i></button>
						<a class="btn btn-info" style="color:white" href="bom_print.php?id=<?php echo $ID_produk;?>">Cetak&nbsp;&nbsp;<i class="fa fa-print"></i></button></a>
						<br><br>
						<div class="card">
                            <div class="card-header alert alert-info">
                                <strong class="card-title">BILL OF MATERIALS: <?php echo $db->tampil_nama_produk($ID_produk);?></strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th><small><b>Kode Bahanbaku</small></th>
                                            <th><small><b>Bahanbaku</small></th>
                                            <th><small><b>BOM/qty per produk</small></th>
											<th><small><b><center> Aksi </center></small></th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									$data = $db->tampil_bom($ID_produk);
									if($data!=0){
										foreach($data as $m){
									?>
                                        <tr>
											<td><?php print $m['ID_bahanbaku']; ?></td> 
											<td><?php print $m['deskripsi']; ?></td> 
											<td><?php print $m['bom']." ".$m['unit']; ?></td>
											<td><center>
											<a href="bom_edit.php?id=<?php echo $m['ID_bom'];?>&aksi=edit&ID_produk=<?php echo $ID_produk;?>" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
											<a href="controller/proses_bom.php?id=<?php echo $m['ID_bom']; ?>&aksi=hapus&ID_produk=<?php echo $ID_produk;?>"><button class="btn btn-warning btn-sm"><i class="fa fa-trash-o "></i></button></a>
											</center></td>
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
						<h4 align="center"><small>Tambah BOM </small></h4>
					</div>
					<div class="modal-body">
						<form action="controller/proses_bom.php?&aksi=tambah&id=<?php echo $ID_produk; ?>" method="post">
							<div class="form-group">
								<label>Produk</label>
								<input name="nama_produk" type="text" class="form-control" readonly="" value="<?php print $db->tampil_nama_produk($ID_produk);?>">
							</div>
							<div class="form-group">
								<label>Tambah bahanbaku sbg BOM</label>
								<select name="ID_bahanbaku" class="form-control">
									<?php
									foreach ($db->tampil_bahanbaku() as $m)
									{
									?>
										<option value="<?php print $m['ID_bahanbaku'];?>"> <?php print $m['deskripsi']." (".$m['unit'].")";?></option>
									<?php
									}
									?>
								</select>
							</div>
							<div class="form-group">
								<label><i>Quantitas dalam satu produk</i></label>
								<input name="bom" type="number" class="form-control" placeholder="0.000" required min="0" value="0" step="0.001" title="Currency" pattern="^\d+(?:\.\d{1,3})?$" onblur="
								this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,3})?$/.test(this.value)?'inherit':'red'">
							</div>
							<div class="form-group">
								<input name="ID_produk" type="hidden" class="form-control" value="<?php print $ID_produk;?>">
							</div>
							<div class="modal-footer">
							<a href="bom.php?id=<?php print $ID_produk;?>"><button type="button" class="btn btn-default">Batal</button></a>
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
