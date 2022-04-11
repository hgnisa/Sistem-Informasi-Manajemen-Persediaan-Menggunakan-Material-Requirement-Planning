<!doctype html>
<html class="no-js" lang="">
<?php include "_head.php"; ?>

<body>
    <div id="right-panel" class="right-panel">
	<?php include "_header.php"; ?>
        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
					<button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-md btn-info"><a  style="color:white">Tambah Bill of Material</a>&nbsp;&nbsp;<i class="fa fa-plus"></i></button>
                    <a class="btn btn-info" style="color:white" href="mrp_bom_print.php">Cetak&nbsp;&nbsp;<i class="fa fa-print"></i></button></a>
					<br><br>
						<div class="card">
                            <div class="card-header">
                                <strong class="card-title">Bill of Materials</strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th><center><small><b>Kode BOM</small></center></th>
                                            <th><center><small><b>Kode Bahan Baku</small></center></th>
											<th width="10%"><center><small><b>Bahan Baku</small></center></th>
											<th><center><small><b>Stock</small></center></th>
											<th><center><small><b><i>Lead Time</small></center></i></th>
											<th><center><small><b>BOM/<small>produk</small></small></center></th>
											<th><center><small><b>Aksi</small></center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
										include "Controller/koneksi.php";
										$i=0; 
										$query = mysqli_query($con,"SELECT * from bom INNER JOIN bahanbaku ON bom.ID_bahanbaku=bahanbaku.ID_bahanbaku");
										  while ($m=mysqli_fetch_array($query))
										  {
											$i++;
									  ?>
                                        <tr>
											<td><center><?php print $m['ID_bom']; ?></center></td> 
											<td><center><?php print $m['ID_bahanbaku']; ?></center></td> 
                                            <td><center><?php print $m['deskripsi']; ?></center></td>
											<td><center><?php print $m['qty']; ?></center></td> 
											<td><center><?php print $m['leadtime']; ?><small> hari</small></center></td> 
                                            <td><center><?php print $m['bom'];?>&nbsp;<small><?php print $m['unit'];?></small></center></td>
											<td >
											<a href="mrp_bom_edit.php?ID_bom=<?php print $m['ID_bom']?>" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
											<a href="Controller/bom_hapus.php?ID_bom=<?php $ambilKode; $ambilKode=$m['ID_bom']; print $ambilKode;?>"><button class="btn btn-warning btn-sm"><i class="fa fa-trash-o "></i></button></a>
											<?php
												
											?>
											</td>
                                        </tr>
									 <?php } ?>
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
						<h4 align="center"><small>Tambah <i> Bill of Material </i></small></h4>
					</div>
					<div class="modal-body">
									<?php
									include "Controller/koneksi.php";
									
									$ambilKode = mysqli_query($con, "SELECT substr((max(ID_bom)), 5, 3) as maxKode FROM bom");
									$ambilKode1 = mysqli_fetch_array($ambilKode);
									$ID_bom1 = $ambilKode1['maxKode'];
									$ID_bom1 = $ID_bom1 + 1;
									
									if ($ID_bom1 < 10){
										$char = "BOM-00";
										$final = $char . $ID_bom1;
									}
									else{
										$char = "BOM-0";
										$final = $char . $ID_bom1;
									}
									?>

						<form action="Controller/bom_tambah.php" method="post">
							<div class="form-group">
								<label>Kode BOM</label>
								<input name="ID_bom" type="text" class="form-control" readonly="" value="<?php print $final; ?>">
							</div>
							<div class="form-group">
								<label>Bahan Baku</label>
								<select name="ID_bahanbaku" class="form-control">
									<?php
										include "Controller/koneksi.php";
										$i=0;
										$query = mysqli_query($con, "SELECT * from bahanbaku ");
										while($m = mysqli_fetch_array($query)){ 
											$i++ 
										?>	
										<option value="<?php print $m['ID_bahanbaku'];?>"> <?php print $m['deskripsi']." (".$m['unit'].")"; }?></option>
								</select>
							</div>
							<div class="form-group">
								<label><i> Lead Time </i>(hari) </label>
								<input name="leadtime" type="number" min=0 class="form-control" Onkeypress="return event.charCode >= 48 && event.charCode <=57" required oninvalid="this.setCustomValidity('Led time tidak boleh kosong')" oninput="setCustomValidity('')">
							</div>
							<div class="form-group">
								<label><i>Quantitas dalam satu produk</i></label>
								<input name="bom" type="number" class="form-control" placeholder="0.000" required min="0" value="0" step="0.001" title="Currency" pattern="^\d+(?:\.\d{1,3})?$" onblur="
								this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,3})?$/.test(this.value)?'inherit':'red'">
							</div>
							<div class="modal-footer">
							<a href="mrp_bom.php"><button type="button" class="btn btn-default">Batal</button></a>
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
