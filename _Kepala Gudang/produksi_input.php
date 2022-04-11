<!doctype html>
<html class="no-js" lang="">
<?php 
include "_head.php"; 
include "model/class_produk.php";
$pr = new produk();

$tgl = date('d-m-Y');
$bulan = date('m');
$tahun_ini = date('Y');
$hari_ini = date ('d');
$akhir = substr(date('t-m-Y', strtotime($hari_ini)),0,2);
$tahun_peramalan = $tahun_ini - 1;
$ID = $tahun_peramalan."-".$bulan;
?>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script>
function math() {
	var a = parseInt(document.getElementById("pr_ramal").value);
	var b = parseInt(document.getElementById("pr_tambahan").value);
	var c = parseInt(document.getElementById("pr_sr").value);
	if(document.getElementById("p3").checked){
		document.getElementById("pr_total").value = a+b+c;
	}
	else{
		
		document.getElementById("pr_total").value = b+c;
	}
}
</script>
<script>  
	$(document).ready(function(){  
		var i=1;  
			$('#add').click(function(){  
				i++;  
				$('#dynamic_field').append('<tr id="row'+i+'"><td><input type="number" name="name[]" placeholder="Tanggal" class="form-control name_list" min="1" max="31"/></td><td><input type="number" name="jmlh[]" placeholder="Jumlah" class="form-control jmlh_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn-sm btn-warning btn_remove">X</button></td></tr>');  
			});  
			$(document).on('click', '.btn_remove', function(){  
				var button_id = $(this).attr("id");   
				$('#row'+button_id+'').remove();  
			});  
	});  
</script>
<?php 
include 'model/koneksi.php';
include 'model/class_produksi.php';
$db = new produksi(); 
?>
<body>
    <div id="right-panel" class="right-panel">
	<?php include "_header.php"; ?>
		<div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-7">
						<a href="produksi.php" style="color:white"><button type="button" class="btn btn-md btn-info">Lihat Data Produksi&nbsp;&nbsp;<i class="fa fa-search"></i></button></a>
						<br><br>
					</div>
				</div>
                <div class="row">
                    <div class="col-md-7">
						<div class="card">
                            <div class="card-header alert alert-info">
                                <i class="fa fa-gears"></i><strong>&nbsp;Produksi Produk</strong>
                            </div>
							<div class="card-body">
								<div class="col col-sm-12">
									<form method="GET">
										<table> 
											<tr> 
												<td><select name="ID_produk1" class="form-control">
													<option> Produk </option>
													<?php
														include "model/koneksi.php";
														$i=0;
														$query = mysqli_query($con, "SELECT * from produk");
														while($m = mysqli_fetch_array($query))
														{ $i++ 
													?>	
													<option value="<?php echo $m['ID_produk']; ?>"> <?php echo $m['nama_produk'];?> <?php } ?></option></select>
												</td>
												<td width="120px"><button class="btn btn-md btn-info">Pilih Produk</button></center></td>  
											</tr>
										</table>
									</form>
								</div>
							</div>
							<form action="controller/proses_produksi.php?aksi=keranjang" method="post" class="form-horizontal">
								<div class="card-body">
									<div class="col col-sm-12">
										<?php	
											if (isset($_GET['ID_produk1'])){
											$ID_produk = $_GET['ID_produk1'];
											$result = mysqli_query($con, "SELECT * FROM peramalan WHERE ID_produk = '$ID_produk' AND bulan = '$bulan' AND tahun ='$tahun_peramalan'");
											while($m = mysqli_fetch_array($result)){
												$forecast = ceil($m['forecast'] / $akhir);
											}
											
											$schedule = 0;
											$sr_tgl = date('d');
											$sr_bln = date('m');
											$result1 = mysqli_query($con, "SELECT * FROM bom_temp1 WHERE tanggal='$sr_tgl' AND bulan='$sr_bln' and ID_produk='$ID_produk'");
											while($n = mysqli_fetch_array($result1)){
												if ($n['jumlah'] == null){
													$schedule = 0;
												}
												else{
													$schedule = $n['jumlah'];
												}
											}
										}
										else{
											$ID_produk = "P-001";
											$result = mysqli_query($con, "SELECT * FROM peramalan WHERE ID_produk = '$ID_produk' AND bulan = '$bulan' AND tahun ='$tahun_peramalan'");
											while($m = mysqli_fetch_array($result)){
												$forecast = ceil($m['forecast'] / $akhir);
											}
											
											$schedule = 0;
											$sr_tgl = date('d');
											$sr_bln = date('m');
											$result1 = mysqli_query($con, "SELECT * FROM bom_temp1 WHERE tanggal='$sr_tgl' AND bulan='$sr_bln'");
											while($n = mysqli_fetch_array($result1)){
												if ($n['jumlah'] == null){
													$schedule = 0;
												}
												else{
													$schedule = $n['jumlah'];
												}
											}
										}
										?>
										
										<small>Kode Produk</small>
										<input name="ID_produk" type="text" value="<?php print $ID_produk;?>" readonly="" placeholder="produk" class="form-control">
										<br>
											
										<small>Lakukan rencana produksi untuk hari ini, tanggal:</small>
										<input name="pr_date" type="text" value="<?php print date('d-m-Y');?>" readonly="" placeholder="Hari" class="form-control">
										<br>
										
										<small>Hasil peramalan penjualan produk hari ini: </small>
										<input name="pr_ramal" id="pr_ramal" onchange="math()" type="text" value="<?php print $forecast;?>" readonly="" class="form-control">
										<input type="checkbox" id="p3" name="p3" value="<?php print $forecast;?>" onchange="math()"/>
										<small>Gunakan hasil peramalan</small>		
										<br><br>
										
										<small>Pre order hari ini:</small>
										<input name="pr_sr" id="pr_sr" type="text" onchange="math()" value="<?php if ($schedule == null){ print 0; }else{ print $schedule;}?>" readonly="" class="form-control">
										<br>
										
										<small>Tambah jumlah produksi</small>
										<input name="pr_tambahan" id="pr_tambahan" onchange="math()" type="number" min=0 class="form-control">
										<br> 
										
										<small><b>Total jumlah produksi</b></small>
										<input name="pr_total" id="pr_total" type="number" readonly="" class="form-control">
										<br> 
										
										<button type="submit"  class="btn btn-info btn-md btn-block">Simpan</button></a>
										<small><small>catatan: produksi produk yang sama hanya dilakukan sekali dalam sehari</small></small>
										<br>
									</div>
								</div>
							</form>
                        </div>
                    </div>
					
					<div class="col-md-4">
						<div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-header alert alert-info">
										<strong class="card-title"><i class="fa fa-shopping-cart"></i> Proses Produksi </strong>
									</div>
									<div class="card-body"> 
									<?php
										$query = mysqli_query($con, "SELECT DISTINCT pr_date FROM produksi_temp");
										while($m = mysqli_fetch_array($query))
										{ 
											$pr_date =  $m['pr_date'];
									?>
										<table id="myTable" class="table table-striped table-bordered">
											<thead>
												<tr>
													<th width="30%"><center>Produksi hari ini: </center></th>
												</tr>
											</thead>
											
											<?php
											$query2 = mysqli_query($con, "SELECT * FROM produksi_temp WHERE pr_date = '$pr_date'");
											while($o = mysqli_fetch_array($query2))
											{
											?>
											<tbody>
													<td width="30%"><center><small><?php print $pr->tampil_nama_produk($o['ID_produk']);?></small></center></td>
													<td width="10%"><center><small><?php print $o['pr_total']." pcs";?></small></center></td>
													<td width="10%"><center>
													<a href="controller/proses_produksi.php?aksi=keranjang_hapus&id=<?php print $o['ID_produksi'];?>"   onClick="return confirm('Apakah Anda ingin membatalkan produksi produk ini?')"><button class="btn btn-warning btn-sm"><i class="fa fa-trash-o "></i></button></a>
													</center></td>
												</tr>
											</tbody>
										<?php 
											}
										?>
											<thead>
												<tr>
												   <th><center><small>
												   <a href="controller/proses_produksi.php?aksi=tambah&pr_date=<?php print $pr_date;?>"  onClick="return confirm('Apakah Anda benar-benar mau Produksi?')"><button class="btn btn-info btn-sm btn-block">Produksi</button></a></center></th>
												</tr>
											</thead>
										</table>
										<?php 
										}
										?>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-header alert alert-info">
										<i class="fa fa-gears"></i><strong>&nbsp;Catatan Produksi</strong>
									</div>
									<div class="card-body">
										<div class="col col-sm-12">
											<?php
												$total_produksi = 0;
												$result = mysqli_query($con, "SELECT SUM(pr_total) as TotalProduksi FROM produksi WHERE pr_date = '$tgl'");
												while($m = mysqli_fetch_array($result)){
													$total_produksi = $m['TotalProduksi'];
												} 
												
												if ($total_produksi != 0){?>
														<a href="produksi_detail.php?tgl=<?php print $tgl;?>" class="btn btn-info btn-sm btn-block">Lihat kebutuhan produksi &nbsp;<i class="fa fa-search"></i></a>
														<?php
													}
													else {?>
														<button type="button" disabled="disabled" class="btn btn-info btn-sm btn-block">-</button>
														<small><small>catatan: produksi belum dilakukan</small></small>
														<?php
													}
												?>
										</div>
									</div>
								</div>
							</div>
						</div>
                    </div>
                </div>
            </div>
        </div>
		<!--footer -->
		<?php  include "_table.php";?>
</body>
</html>
