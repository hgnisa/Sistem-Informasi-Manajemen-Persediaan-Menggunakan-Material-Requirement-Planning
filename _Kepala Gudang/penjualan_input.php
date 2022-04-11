<!doctype html>
<html class="no-js" lang="">
<?php 
include "_head.php";
include "model/koneksi.php"; 
include 'model/class_produk.php';
include 'model/class_produksi.php';
include 'model/class_penjualan.php';
$pr = new produk(); 
$db = new penjualan();
$pro = new produksi();

$ID_produk1 = $_POST['ID_produk'];
?>
<script type="text/javascript">
function math() {
	var a = parseInt(document.getElementById("jumlah").value);
	var b = 60000;
	if(a && b)
		document.getElementById("harga").value = a*b;
}
</script>
<script>
    $(document).ready(function(){
        $('#kd_barang').on('change', function(){
            $.ajax({
                url:"controller/find_barang.php?act=find_barang",
                method:"POST",
                data:{kd_barang:$(this).val()},
                cache:false,
                success:function(res){
                    data = JSON.parse(res);

                    $('#harga_barang').val(data.harga_jual);
                    $('#stok').val(data.stok);
                }
            })
        });
</script>
<body>
    <div id="right-panel" class="right-panel">
	<?php include "_header.php"; ?>
        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
                        <a href="penjualan.php" style="color:white"><button type="button" class="btn btn-md btn-info">Lihat Data Penjualan&nbsp;&nbsp;<i class="fa fa-search"></i></button></a>
						<br><br>
						<div class="card">
							<div class="card">
								<div class="card-header alert alert-info">
									<strong class="card-title">Penjualan Produk</strong>
								</div>
								<div class="card-body">
									<form method="POST" action="penjualan_input.php">
										<table> 
											<tr> 
												<td>
													<select name="ID_produk" class="form-control">
														<small><option value="ID_produk"> Pilih Produk </option>
														<?php
															$data = $pr->tampil_produk();
															if($data!=0){
																foreach($data as $m){
														?>
														<small><option value="<?php echo $m['ID_produk'];?>"> <?php echo $m['nama_produk'];?></option>
														<?php 
																}
															}
														?>
													</select>
												</td>
												<td width="70px" align="center"><button class="btn btn-md btn-info">Tampilkan</button></center></td> 
											</tr>
										</table>
									</form>
								</div>
								<div class="card-body">
									<form action="controller/proses_penjualan.php?aksi=tambah" method="post" class="form-horizontal">
										<table id="myTable" class="table table-striped table-bordered">
											<thead>
												<tr>
													<th><center>Menu</center></th>
													<th><center>Jumlah</center></th>
													<th><center>Harga</center></th>
													<th><center>#</center></th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td width="50%"><center>
														<input name="ID_produk" type="hidden" class="form-control" value="<?php echo $ID_produk1;?>" readonly>
														<input name="nama_produk" type="text" class="form-control" value="<?php echo $pr->tampil_nama_produk($ID_produk1);?>" readonly></select></center>
													</td>
													
													
													<td width="10%"><center>
														<select name="jumlah" id="jumlah" min=0 onchange="math()" class="form-control" Onkeypress="return event.charCode >= 48 && event.charCode <=57" required oninvalid="this.setCustomValidity('Jumlah tidak boleh kosong')" oninput="setCustomValidity('')">
															<option value="0">0</option>
															<?php
																for($i = 1; $i <= $pro->tampil_stok_produk($ID_produk1);$i++){
															?>	
															<option value="<?php print $i;?>"> <?php print $i;}?></option>
														</select></center>
													</td>
													
													
													<td width="20%"><center>
														<input name="harga" placeholder="Rp. " id="harga" type="text" class="form-control"></center>
													</td>
													
													
													<td width="20%"><center>
													<?php
														// harusnya !=
														if (($pro->tampil_stok_produk($ID_produk1) != null) && ($pro->tampil_stok_produk($ID_produk1) != 0)){?>
															<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#staticModal">OK</button>
															<div class="modal fade" id="staticModal" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true">
																<div class="modal-dialog modal-sm" role="document">
																	<div class="modal-content">
																		<div class="modal-body">
																			<p>
																			<br>
																			Apakah data yang dimasukkan sudah sesuai?
																		   </p>
																		</div>
																		<div class="modal-footer">
																			<a href="#"><button type="button" class="btn btn-outline-link btn-md" data-dismiss="modal">Batal</button></a>
																			<button class="btn btn-info btn-md">OK</button>
																		</div>
																	</div>
																</div>
															</div>
															<?php
														}
														else {?>
															<button type="button" disabled="disabled" class="btn btn-info btn-sm" data-toggle="modal" data-target="#staticModal">OK</button>
															<div class="modal fade" id="staticModal" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true">
																<div class="modal-dialog modal-sm" role="document">
																	<div class="modal-content">
																		<div class="modal-body">
																			<p>
																			<br>
																			Apakah data yang dimasukkan sudah sesuai?
																		   </p>
																		</div>
																		<div class="modal-footer">
																			<a href="#"><button type="button" class="btn btn-outline-link btn-md" data-dismiss="modal">Batal</button></a>
																			<button class="btn btn-info btn-md">OK</button>
																		</div>
																	</div>
																</div>
															</div>
															<?php
														}
													?>
													</center></td>
												</tr>
											</tbody>
										</table>
									</form>
								</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .animated -->
        </div><!-- .content -->
		
		<div class="clearfix"></div>
		<!-- Footer -->
		<?php include "_table.php";?>
</body>
</html>
