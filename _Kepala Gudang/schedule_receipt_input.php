<!doctype html>
<html class="no-js" lang="">
<?php 
include "_head.php"; 
include "model/class_produk.php";
$db = new produk();
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
                                <i class="fa fa-gears"></i><strong>&nbsp;PRE ORDER</strong>
                            </div>
							<form action="controller/proses_schedulereceipt.php?aksi=tambah" method="post" class="form-horizontal">
								<div class="card-body">
									<div class="col col-sm-12">
										<?php
											$hari_ini = date("d-m-Y");
											$akhir = substr(date('t-m-Y', strtotime($hari_ini)),0,2);
										?>
										<div class="form-group">  
											 <form name="add_name" id="add_name">  
												  <div class="table-responsive">
													   <table class="table table-bordered" id="dynamic_field">  
															<tr>  
																<td>
																	<select name="ID_produk" class="form-control">
																	<small><option value="<?php echo $ID_produk;?>"> Pilih Menu </option>
																	<?php foreach($db->tampil_produk() as $m) { ?>
																	<small><option value="<?php echo $m['ID_produk'];?>"> <?php echo $m['nama_produk']; ?></option>
																	<?php } ?>
																	</select>
																 </td>
																 <td><input type="number" name="tgl" placeholder="Tgl" required oninvalid="this.setCustomValidity('Tanggal tidak boleh kosong')" oninput="setCustomValidity('')" class="form-control name_list" min=1 max="<?php print $akhir;?>"/></td>
																 <td><input type="number" name="bln" placeholder="Bln" required oninvalid="this.setCustomValidity('Bulan tidak boleh kosong')" oninput="setCustomValidity('')" class="form-control bln_list" min="1" max="12"/></td>
																 <td><input type="number" name="jmlh" placeholder="Jumlah" required oninvalid="this.setCustomValidity('Jumlah tidak boleh kosong')" oninput="setCustomValidity('')" class="form-control jmlh_list" min=1/></td>
																 <td><button type="button" class="btn btn-info btn-sm btn-block" data-toggle="modal" data-target="#staticModal">Simpan</button>
															</tr>  
													   </table>
												  </div>  
											 </form>  
										</div>  
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
									</div>
								</div>
							</form>
                        </div>
                    </div>
                </div>
				<div class="row">
                    <div class="col-md-12">
						<div class="card">
                            <div class="card-header alert alert-info">
                                </i><strong>&nbsp; DATA PRE ORDER</strong>
                            </div>
							<div class="card">
								<div class="card-body">
									<table id="bootstrap-data-table" class="table table-striped table-bordered">
										<thead>
											<tr>
												<th><center><small><b>Tanggal</small></center></th>
												<th><center><small><b>Menu</small></center></th>
												<th><center><small><b>Jumlah</small></center></th>
												<th><center><small><b>Aksi</small></center></th>
											</tr>
										</thead>
										<tbody>
										<?php
											include "model/koneksi.php";
											$i=0;
											$query = mysqli_query($con,"SELECT * FROM bom_temp1");
											  while ($m=mysqli_fetch_array($query))
											  {
												  
												$ID_sr = $m['ID_sr'];
												$ID_produk = $m['ID_produk'];
												$tanggal = $m['tanggal'];
												$bulan_angka = $m['bulan'];
												$jumlah = $m['jumlah'];
				
												$i++;
										  ?>
											<tr>
												<td><center><?php print $tanggal."/".$bulan_angka; ?></center></td>
												<td><center><?php print $db->tampil_nama_produk($ID_produk); ?></center></td>
												<td><center><?php print $jumlah; ?> <small> pcs</small></center></td>
												<?php
													$tanggal1 = $tanggal."-".$bulan_angka."-".date('Y');
													$tgl = new DateTime(date("Y-m-d", strtotime($tanggal1)));
													$today =  new DateTime(date("Y-m-d"));
													$diff = $today->diff($tgl);
													$diff->d;
													
													$final = 0; 
													$bln_skrg = date('m');
													$skrg = date('d');
													if($bulan_angka < $bln_skrg){
														?>
															<td><center>
																&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
																<a href="controller/proses_schedulereceipt.php?ID_sr=<?php print $ID_sr;?>&aksi=hapus"><button class="btn btn-warning btn-sm"><i class="fa fa-trash-o "></i></button></a>
															</td>
															<?php
													}
													else if($bulan_angka > $bln_skrg){
														?>
															<td><center>
																<a href="schedule_receipt_edit.php?ID_sr=<?php print $ID_sr;?>&aksi=edit" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
																<a href="controller/proses_schedulereceipt.php?ID_sr=<?php print $ID_sr;?>&aksi=hapus"><button class="btn btn-warning btn-sm"><i class="fa fa-trash-o "></i></button></a>
															</td>
															<?php
													}
													//bulan preorder > 7		   tanggal preorder < sekarang
													else if(($bulan_angka >= $bln_skrg) AND ($tanggal < $skrg)){
															?>
															<td><center>
																&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
																<a href="controller/proses_schedulereceipt.php?ID_sr=<?php print $ID_sr;?>&aksi=hapus"><button class="btn btn-warning btn-sm"><i class="fa fa-trash-o "></i></button></a>
															</td>
															<?php
													}
													else{
															?>
															<td><center>
																<a href="schedule_receipt_edit.php?ID_sr=<?php print $ID_sr;?>&aksi=edit" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
																<a href="controller/proses_schedulereceipt.php?ID_sr=<?php print $ID_sr;?>&aksi=hapus"><button class="btn btn-warning btn-sm"><i class="fa fa-trash-o "></i></button></a>
															</td>
															<?php
													}
													?>
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
        </div>
		<div class="clearfix"></div>
		<?php include "_table.php";?>
	</div>
	

</body>
</html>
