<!doctype html>
<html class="no-js" lang="">
<?php include "_head.php"; 
include "model/koneksi.php"; 
include 'model/class_mrp.php';
$db = new mrp();

$tanggal = date('d');
$bulan = date('m');
$tahun = date('Y');
$akhir = substr(date('t-m-Y', strtotime(date('d-m-Y'))),0,2);
$peramalan1 = $tahun-1;
?>
<body>
    <div id="right-panel" class="right-panel">
	<?php include "_header.php";?>
    	<div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
								<strong class="card-title">Tabel Perhitungan MRP Produk (Level 0) <?php print $db->tampil_bulan($bulan);?></strong>
							</div>
							<div class="card-body">
							<?php
//PRODUK
							$sql1 = mysqli_query($con, "SELECT DISTINCT ID_produk from bom");
							while($a = mysqli_fetch_array($sql1)){ 
								$ID_produk = $a['ID_produk'];
							?>
								<div class="col-sm-4">
									<div class="order-table table-stats ov-h">
										<table class="table table-striped table-bordered">
											<tbody>
												<tr>
													<th><strong>Produk</th>
													<th>:</th>
													<?php
													$sql12 = mysqli_query($con, "SELECT * FROM produk WHERE ID_produk= '$ID_produk'");
													while($b = mysqli_fetch_array($sql12))
													{ 
														$nama_produk = $b['nama_produk'];
													?>
													<th><strong><?php echo $nama_produk;?></strong></th>
													<?php } ?>
												</tr>
												<tr>
													<th><strong>Lot Size</th>
													<th>:</th>
													<th><strong>1 pcs</strong></th>
												</tr>
												<tr>
													<th><strong>Lead Time</th>
													<th>:</th>
													<th><strong>0 hari</strong></th>
												</tr>
											<tbody>
										</table>
									</div>
								</div>
				
								<div class="col-sm-12">
									<div class="order-table table-stats ov-h">
										<table class="table table-striped table-bordered">
											<thead>
												<tr>
													<th width="5px"><center>#</center></th>
													<th width="10px"><center>PD</center></th>
													<?php
													for($i = $tanggal+1; $i <= $akhir; $i++){
													?>	
													<th width="40px"><center><?php echo $i;?></center></th>
													<?php } ?>
												</tr>	
											</thead>
											<tbody>
												<tr>
													<td>Gross Requirement</td>
													<td></td>
													<?php
													$ambil =0;
													$query3 = mysqli_query($con, "SELECT * from peramalan WHERE tahun = '$peramalan1' AND bulan = '$bulan' AND ID_produk='$ID_produk'");
													while($p = mysqli_fetch_array($query3))
													{ 
														if ($p['forecast'] == null){
															$ambil = 0;
														}
														else{
															$ambil = $p['forecast'];
														}
														
														$ambil = $p['forecast'];
													}
																			
													for($i = $tanggal+1; $i <= $akhir; $i++){
													?>
													<td><center><?php echo  round(ceil($ambil/$akhir));}?></center></td>
												</tr>
												<tr>
													<td>Schedule Receipt</td>
													<td></td>
													<?php	
													for($i = $tanggal+1; $i <= $akhir; $i++){
													if ($i < 10){
														$kode=  "0".$i;
													}
													else{
														$kode = $i;
													}	
						
													$sr_p = 0;
													//Cek jumlah Schedule Receipt PRODUK
													$sql5 = mysqli_query($con, "SELECT * FROM bom_temp1 WHERE tanggal = '$kode' AND bulan = '$bulan' and ID_produk='$ID_produk'");
													while($e = mysqli_fetch_array($sql5))
													{
														$sr_p  = $e['jumlah'];
													}
													?>
													<td><center><?php echo  $sr_p;}?></center></td>
												</tr>
												<tr>
													<td>Project On Hands</td>
													<td><center>0</center></td>
													<?php		
													for($i = $tanggal+1; $i <= $akhir; $i++){
														$ph = 0;
													?>
													<td><center><?php echo  $ph;}?></center></td>
												</tr>
												<tr>
													<td>Net Requirement</td>
													<td></td>
													<?php					
													for($i = $tanggal+1; $i <= $akhir; $i++){
														if ($i < 10){
															$kode= "0".$i;
														}
														else{
															$kode = $i;
														}	
							
														$ambil =0;
														$query3 = mysqli_query($con, "SELECT * from peramalan WHERE tahun = '$peramalan1' AND bulan = '$bulan' AND ID_produk='$ID_produk'");
														while($p = mysqli_fetch_array($query3))
														{ 
															if ($p['forecast'] == null){
																$ambil = 0;
															}
															else{
																$ambil = $p['forecast'];
															}
															$ambil = $p['forecast'];
														}
													
														$gr = ceil($ambil/$akhir);
				
														$sr_p = 0;
														$sql5 = mysqli_query($con, "SELECT * FROM bom_temp1 WHERE tanggal = '$kode' AND bulan = '$bulan' and ID_produk='$ID_produk'");
														while($e = mysqli_fetch_array($sql5))
														{
															$sr_p  = $e['jumlah'];
														}
													?>
													<td><center><?php echo $gr+$sr_p;}?></center></td>
												</tr>	
												<tr>
													<td>Point Order Receipt</td>
													<td></td>
													<?php	
													for($i = $tanggal+1; $i <= $akhir; $i++){
														if ($i < 10){
															$kode= "0".$i;
														}
														else{
															$kode = $i;
														}	
														
														$ambil =0;
														$query3 = mysqli_query($con, "SELECT * from peramalan WHERE tahun = '$peramalan1' AND bulan = '$bulan' AND ID_produk='$ID_produk'");
														while($p = mysqli_fetch_array($query3))
														{ 
															if ($p['forecast'] == null){
																$ambil = 0;
															}
															else{
																$ambil = $p['forecast'];
															}
															$ambil = $p['forecast'];
														}
													
														$gr = ceil($ambil/$akhir);
														$sr_p = 0;
														$sql5 = mysqli_query($con, "SELECT * FROM bom_temp1 WHERE tanggal = '$kode' AND bulan = '$bulan' and ID_produk='$ID_produk'");
														while($e = mysqli_fetch_array($sql5))
														{
															$sr_p  = $e['jumlah'];
														}
													?>
													<td><center><?php echo $gr+$sr_p;}?></center></td>
												</tr>			
												<tr>
													<td>Point Order Release</td>
													<td><center></center></td>
													<?php		
													for($i = $tanggal+1; $i <= $akhir; $i++){
														if ($i < 10){
															$kode= "0".$i;
														}
														else{
															$kode = $i;
														}
						
														$ambil =0;
														$query3 = mysqli_query($con, "SELECT * from peramalan WHERE tahun = '$peramalan1' AND bulan = '$bulan' AND ID_produk='$ID_produk'");
														while($p = mysqli_fetch_array($query3))
														{ 
															if ($p['forecast'] == null){
																$ambil = 0;
															}
															else{
																$ambil = $p['forecast'];
															}
															$ambil = $p['forecast'];
														}
						
														$gr = ceil($ambil/$akhir);
														$sr_p = 0;
					
														//Cek jumlah Schedule Receipt PRODUK
														$sql5 = mysqli_query($con, "SELECT * FROM bom_temp1 WHERE tanggal = '$kode' AND bulan = '$bulan' and ID_produk='$ID_produk'");
														while($e = mysqli_fetch_array($sql5))
														{
															$sr_p  = $e['jumlah'];
														}
														?>
													<td><center><?php echo  $gr+$sr_p;}?></center></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							<?php	
							}
							?>
							</div>
						</div>
					</div>
                    <div class="col-md-12">
                        <div class="card">	
							<div class="card-header">
								<strong class="card-title">Tabel Perhitungan MRP (Level 1) Bahan Baku</strong>
							</div>
							<div class="card-body">						
							<!--BAHAN BAKU-->	
							<?php
							$sql88 = mysqli_query($con, "SELECT DISTINCT ID_bahanbaku from bom");
							while($b = mysqli_fetch_array($sql88))
							{ 
								$ID_bahanbaku = $b['ID_bahanbaku'];
							?>
								<div class="col-sm-4">
									<div class="order-table table-stats ov-h">
										<table class="table table-striped table-bordered">
											<tbody>
												<tr>
													<th>Bahan Baku</th>
													<th>:</th>
													<?php
													$sql12 = mysqli_query($con, "SELECT * FROM bahanbaku WHERE ID_bahanbaku= '$ID_bahanbaku'");
													while($l = mysqli_fetch_array($sql12))
													{ 
														$deskripsi = $l['deskripsi'];
													?>
													<th><b><?php echo $deskripsi;?></b></th>
													<?php } ?>
												</tr>
												<tr>
													<th>Lot Size</th>
													<th>:</th>
													<?php
													$sql12 = mysqli_query($con, "SELECT * FROM bahanbaku WHERE ID_bahanbaku= '$ID_bahanbaku'");
													while($l = mysqli_fetch_array($sql12))
													{ 
														$satuan = $l['lotsize'];
													?>
													<th><b><?php echo $satuan." ".$l['unit'];?></b></th>
													<?php } ?>
												</tr>
												<tr>
													<th>Lead Time</th>
													<th>:</th>
													<?php
													$sql12 = mysqli_query($con, "SELECT * FROM bahanbaku WHERE ID_bahanbaku= '$ID_bahanbaku'");
													while($l = mysqli_fetch_array($sql12))
													{ 
														$satuan = $l['leadtime'];
													?>
													<th><b><?php echo $satuan." hari";?></b></th>
													<?php } ?>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
				
								<div class="col-sm-12">
									<div class="order-table table-stats ov-h">
										<table class="table table-striped table-bordered">
											<thead>
												<tr>
													<th width="6px"><center>#</center></th>
													<th width="40px"><center>PD</center></th>
													<?php
													for($i = $tanggal+1; $i <= $akhir; $i++){
													?>	
													<th width="40px"><center><?php echo $i;?></center></th>
													<?php } ?>
												
													<td></td>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>Gross Requirement</td>
													<td></td>
													<?php
													for($i = $tanggal+1; $i <= $akhir; $i++){
														if ($i < 10){
															$kode= "0".$i;
														}
														else{
															$kode = $i;
														}	
														
														$gr = 0;
														$query1 = mysqli_query($con, "SELECT * from produk");
														while($n = mysqli_fetch_array($query1))
														{ 
															$ID_produk = $n['ID_produk'];
					
															$ambil =0;
															$query3 = mysqli_query($con, "SELECT * from peramalan  WHERE tahun = '$peramalan1' AND bulan = '$bulan' AND ID_produk='$ID_produk'");
															while($p = mysqli_fetch_array($query3))
															{ 
																if ($p['forecast'] == null){
																	$ambil = 0;
																}
																else{
																	$ambil = $p['forecast'];
																}
																$ambil = $p['forecast'];
															}
					
															$temp = 0;
															$bom = 0;
															$query2 = mysqli_query($con, "SELECT * from bom INNER JOIN bahanbaku ON bom.ID_bahanbaku = bahanbaku.ID_bahanbaku WHERE bom.ID_bahanbaku = '$ID_bahanbaku' AND bom.ID_produk = '$ID_produk'");
															while($o = mysqli_fetch_array($query2))
															{
																$bom = $o['bom'];
																$ph = $o['jumlah_bahan_baku'];
																$lotsize = $o['lotsize'];
															}
				
															$coba = round(((ceil($ambil/$akhir))*$bom), 1);
															$temp = $coba;
															$gr += $temp;	
														}
														
														$sr_p = 0;
														$sr_b = 0;
															
														$temp1 = 0;
														$temp2 = 0;
														
														$sql2 = mysqli_query($con, "SELECT * FROM bom_temp1 WHERE tanggal = '$kode' AND bulan = '$bulan'");
														while($w = mysqli_fetch_array($sql2))
														{
															$ID_produk = $w['ID_produk'];
															$n = round(($w['jumlah']*$bom), 1); 
															$temp1 = $n;
															$sr_p += $temp1;
														}
													//Harusnya $gr + sr_p
													?>
													<td><center><?php echo  $gr + $sr_p;?></center></td>
													<?php } ?>
													<td></td>
												</tr>
												<tr>
													<td>Schedule Receipt</td>
													<td></td>
													<?php
													for($i = $tanggal+1; $i <= $akhir; $i++){
														if ($i < 10){
															$kode= "0".$i;
														}
														else{
															$kode = $i;
														}	

														$sr_p = 0;
														$sr_b = 0;
															
														$temp1 = 0;
														$temp2 = 0;
														
														//Cek jumlah Schedule Bahan Baku
														$sql3 = mysqli_query($con, "SELECT * FROM bom_temp2 WHERE tanggal = '$kode' AND bulan = '$bulan' and ID_bahanbaku = '$ID_bahanbaku'");
														while($g = mysqli_fetch_array($sql3))
														{
															$sr_b = $g['jumlah'];
															$sr_b += $temp2; 
														}
													?>
													<td><center><?php echo $sr_b;?></center></td>
													<?php } ?>
													<td></td>
												</tr>
												<tr>
													<td>Project on Hands</td>
													<?php
													$sql4 = mysqli_query($con, "SELECT qty from bahanbaku WHERE ID_bahanbaku = '$ID_bahanbaku'");
													while($d = mysqli_fetch_array($sql4))
													{ 
														$qty = $d['qty'];
													?>
													<td><center><?php echo $qty;?></center></td>
													<?php } ?>
											
													<?php
													$gr = 0;
													$query1 = mysqli_query($con, "SELECT * from produk");
													while($n = mysqli_fetch_array($query1))
													{ 
														$ID_produk = $n['ID_produk'];
														
														$ambil =0;
														$query3 = mysqli_query($con, "SELECT * from peramalan  WHERE tahun = '$peramalan1' AND bulan = '$bulan' AND ID_produk='$ID_produk'");
														while($p = mysqli_fetch_array($query3))
														{ 
															if ($p['forecast'] == null){
																$ambil = 0;
															}
															else{
																$ambil = $p['forecast'];
															}
															$ambil = $p['forecast'];
														}
														$temp = 0;
														$bom = 0;
														$query2 = mysqli_query($con, "SELECT * from bom INNER JOIN bahanbaku ON bom.ID_bahanbaku = bahanbaku.ID_bahanbaku WHERE bom.ID_bahanbaku = '$ID_bahanbaku' AND bom.ID_produk = '$ID_produk'");
														while($o = mysqli_fetch_array($query2))
														{
															$bom = $o['bom'];
															$ph = $o['qty'];
															$lotsize = $o['lotsize'];
														}
														$coba = round(((ceil($ambil/$akhir))*$bom), 1);
														$temp = $coba;
														$gr += $temp;
													}
			
													//Ambil tanggal
													for($i = $tanggal+1; $i <= $akhir; $i++)
													{
														if ($i < 10){
															$kode= "0".$i;
														}
														else{
															$kode = $i;
														}
														$sr_p = 0;
														$sr_b = 0;
															
														$temp1 = 0;
														$temp2 = 0;
				
														//Cek jumlah Schedule Receipt Produk
														$sql2 = mysqli_query($con, "SELECT * FROM bom_temp1 WHERE tanggal = '$kode' AND bulan = '$bulan'");
														while($w = mysqli_fetch_array($sql2))
														{
															$ID_produk = $w['ID_produk'];
															$n = round(($w['jumlah']*$bom), 1); 
															$temp1 = $n;
															$sr_p += $temp1;
														}
				
														//Cek jumlah Schedule Bahan Baku
														$sql3 = mysqli_query($con, "SELECT * FROM bom_temp2 WHERE tanggal = '$kode' AND bulan = '$bulan' and ID_bahanbaku = '$ID_bahanbaku'");
														while($g = mysqli_fetch_array($sql3))
														{
															$sr_b = $g['jumlah'];
															$sr_b += $temp2; 
														}

														//Proses Pengurangan
														$sr = abs($sr_b - $sr_p);
														if ($ph >= $gr){
															$ph = round(($ph - $gr + $sr_b - $sr_p), 1);
														}
														else {
															$ph = $ph + $lotsize - $gr;
														}
													?>
													<td><center><?php echo $ph;?></center></td>
													<?php } ?>
													<td></td>
												</tr>
												<tr>
													<td>Net Requirement</td>
													<td></td>
													<?php
													$gr = 0;
													$query1 = mysqli_query($con, "SELECT * from produk");
													while($n = mysqli_fetch_array($query1))
													{ 
														$ID_produk = $n['ID_produk'];
					
														$ambil =0;
														$query3 = mysqli_query($con, "SELECT * from peramalan  WHERE tahun = '$peramalan1' AND bulan = '$bulan' AND ID_produk='$ID_produk'");
														while($p = mysqli_fetch_array($query3))
														{ 
															if ($p['forecast'] == null){
																$ambil = 0;
															}
															else{
																$ambil = $p['forecast'];
															}
															$ambil = $p['forecast'];
														}
				
														$temp = 0;
														$bom = 0;
														$query2 = mysqli_query($con, "SELECT * from bom INNER JOIN bahanbaku ON bom.ID_bahanbaku = bahanbaku.ID_bahanbaku WHERE bom.ID_bahanbaku = '$ID_bahanbaku' AND bom.ID_produk = '$ID_produk'");
														while($o = mysqli_fetch_array($query2))
														{
															$bom = $o['bom'];
															$ph = $o['qty'];
															$lotsize = $o['lotsize'];
														}
														$coba = round(((ceil($ambil/$akhir))*$bom), 1);
														$temp = $coba;
														$gr += $temp;
													}	
													
													if ($i < 10){
														$kode= "0".$i;
													}
													else{
														$kode = $i;
													}
													
													$sr_p = 0;
													$sr_b = 0;
													$temp1 = 0;
													$temp2 = 0;
					
													//Cek jumlah Schedule Receipt Produk
													$sql2 = mysqli_query($con, "SELECT * FROM bom_temp1 WHERE tanggal = '$kode' AND bulan = '$bulan'");
													while($w = mysqli_fetch_array($sql2))
													{
														$ID_produk = $w['ID_produk'];
														$n = round(($w['jumlah']*$bom), 1); 
														$temp1 = $n;
														$sr_p += $temp1;
													}
				
													//Cek jumlah Schedule Bahan Baku
													$sql3 = mysqli_query($con, "SELECT * FROM bom_temp2 WHERE tanggal = '$kode' AND bulan = '$bulan' and ID_bahanbaku = '$ID_bahanbaku'");
													while($g = mysqli_fetch_array($sql3))
													{
														$sr_b = $g['jumlah'];
														$sr_b += $temp2; 
													}

													//Proses Pengurangan
													$sr = abs($sr_b - $sr_p);
													if ($ph >= $gr){
														$net1= "";
													}
													else {
														$net1 = $gr - $ph;
													}
													?>
													<td><center><?php echo $net1; ?></center></td>
													
													<?php
													$gr = 0;
													$query1 = mysqli_query($con, "SELECT * from produk");
													while($n = mysqli_fetch_array($query1))
													{ 
														$ID_produk = $n['ID_produk'];
														
														$ambil =0;
														$query3 = mysqli_query($con, "SELECT * from peramalan  WHERE tahun = '$peramalan1' AND bulan = '$bulan' AND ID_produk='$ID_produk'");
														while($p = mysqli_fetch_array($query3))
														{ 
															if ($p['forecast'] == null){
																$ambil = 0;
															}
															else{
																$ambil = $p['forecast'];
															}
															$ambil = $p['forecast'];
														}
													
														$temp = 0;
														$bom = 0;
														$query2 = mysqli_query($con, "SELECT * from bom INNER JOIN bahanbaku ON bom.ID_bahanbaku = bahanbaku.ID_bahanbaku WHERE bom.ID_bahanbaku = '$ID_bahanbaku' AND bom.ID_produk = '$ID_produk'");
														while($o = mysqli_fetch_array($query2))
														{
															$bom = $o['bom'];
															$ph = $o['qty'];
															$lotsize = $o['lotsize'];
															
														}
														$coba = round(((ceil($ambil/$akhir))*$bom), 1);
														$temp = $coba;
														$gr += $temp;
													}
												
													//Ambil tanggal
													for($i = $tanggal+2; $i <= $akhir; $i++)
													{
														if ($i < 10){
															$kode= "0".$i;
														}
														else{
															$kode = $i;
														}
														
														$sr_p = 0;
														$sr_b = 0;
															
														$temp1 = 0;
														$temp2 = 0;
													
														//Cek jumlah Schedule Receipt Produk
														$sql2 = mysqli_query($con, "SELECT * FROM bom_temp1 WHERE tanggal = '$tgl_sr' AND bulan = '$bln_sr'");
														while($w = mysqli_fetch_array($sql2))
														{
															$ID_produk = $w['ID_produk'];
															$n = round(($w['jumlah']*$bom), 1); 
															$temp1 = $n;
															$sr_p += $temp1;
														}
													
														//Cek jumlah Schedule Bahan Baku
														$sql3 = mysqli_query($con, "SELECT * FROM bom_temp2 WHERE tanggal = '$kode' AND bulan  = '$bulan' and ID_bahanbaku = '$ID_bahanbaku'");
														while($g = mysqli_fetch_array($sql3))
														{
															//Schedule Receipt
															$sr_b = $g['jumlah'];
															$sr_b += $temp2; 
														}

														//Proses Pengurangan
														$sr = abs($sr_b - $sr_p);
														if ($ph >= $gr){
															$ambilTgl = $i+1;
															$ph = round(($ph - $gr + $sr_b - $sr_p), 1);
														}
														else {
															$ph = $ph + $lotsize - $gr;
														}
														
														if ($ph < $gr){
															$net =  $gr - $ph + $sr_p  ;
														}
														else {
															$net =  ""  ;
														}
													?>
													<td><center> <?php echo $net; ?> </center></td>
													<?php } ?>
													<td></td>
												</tr>
												<tr>
													<td>Point Order Receipt</td>
													<td></td>
													<?php
													$gr = 0;
													$query1 = mysqli_query($con, "SELECT * from produk");
													while($n = mysqli_fetch_array($query1))
													{ 
														$ID_produk = $n['ID_produk'];
														$ambil =0;
														$query3 = mysqli_query($con, "SELECT * from peramalan  WHERE tahun = '$peramalan1' AND bulan = '$bulan' AND ID_produk='$ID_produk'");
														while($p = mysqli_fetch_array($query3))
														{ 
															if ($p['forecast'] == null){
																$ambil = 0;
															}
															else{
																$ambil = $p['forecast'];
															}
															$ambil = $p['forecast'];
														}
					
														$temp = 0;
														$bom = 0;
														$query2 = mysqli_query($con, "SELECT * from bom INNER JOIN bahanbaku ON bom.ID_bahanbaku = bahanbaku.ID_bahanbaku WHERE bom.ID_bahanbaku = '$ID_bahanbaku' AND bom.ID_produk = '$ID_produk'");
														while($o = mysqli_fetch_array($query2))
														{
															$bom = $o['bom'];
															$ph = $o['qty'];
															$lotsize = $o['lotsize'];
														}
														$coba = round(((ceil($ambil/$akhir))*$bom), 1);
														$temp = $coba;
														$gr += $temp;
													}
													if ($i < 10){
														$kode= "0".$i;
													}
													else{
														$kode = $i;
													}
					
													$sr_p = 0;
													$sr_b = 0;
														
													$temp1 = 0;
													$temp2 = 0;
													
													//Cek jumlah Schedule Receipt Produk
													$sql2 = mysqli_query($con, "SELECT * FROM bom_temp1 WHERE tanggal = '$kode' AND bulan = '$bulan'");
													while($w = mysqli_fetch_array($sql2))
													{
														$ID_produk = $w['ID_produk'];
														$n = round(($w['jumlah']*$bom), 1); 
														$temp1 = $n;
														$sr_p += $temp1;
													}
					
													//Cek jumlah Schedule Bahan Baku
													$sql3 = mysqli_query($con, "SELECT * FROM bom_temp2 WHERE tanggal = '$kode' AND bulan = '$bulan' and ID_bahanbaku = '$ID_bahanbaku'");
													while($g = mysqli_fetch_array($sql3))
													{
														$sr_b = $g['jumlah'];
														$sr_b += $temp2; 
													}
													//Proses Pengurangan
													$sr = abs($sr_b - $sr_p);
													if ($ph >= $gr){
														$lotsize2= "";
													}
													else {
														$lotsize2 = $lotsize;
													}
													?>
													<td><?php echo $lotsize2;?></td>
													
													<?php
													$gr = 0;
													$query1 = mysqli_query($con, "SELECT * from produk");
													while($n = mysqli_fetch_array($query1))
													{ 
														$ID_produk = $n['ID_produk'];
														
														$ambil =0;
														$query3 = mysqli_query($con, "SELECT * from peramalan  WHERE tahun = '$peramalan1' AND bulan = '$bulan' AND ID_produk='$ID_produk'");
														while($p = mysqli_fetch_array($query3))
														{ 
															if ($p['forecast'] == null){
																$ambil = 0;
															}
															else{
																$ambil = $p['forecast'];
															}
															$ambil = $p['forecast'];
														}
				
														$temp = 0;
														$bom = 0;
														$query2 = mysqli_query($con, "SELECT * from bom INNER JOIN bahanbaku ON bom.ID_bahanbaku = bahanbaku.ID_bahanbaku WHERE bom.ID_bahanbaku = '$ID_bahanbaku' AND bom.ID_produk = '$ID_produk'");
														while($o = mysqli_fetch_array($query2))
														{
															$bom = $o['bom'];
															$ph = $o['qty'];
															$lotsize = $o['lotsize'];
														}
														$coba = round(((ceil($ambil/$akhir))*$bom), 1);
														$temp = $coba;
														$gr += $temp;
													}
												
													for($i = $tanggal+1; $i <= $akhir; $i++){
														if ($i < 10){
															$kode= "0".$i;
														}
														else{
															$kode = $i;
														}
														$sr_p = 0;
														$sr_b = 0;
															
														$temp1 = 0;
														$temp2 = 0;
					
														//Cek jumlah Schedule Receipt Produk
														$sql2 = mysqli_query($con, "SELECT * FROM bom_temp1 WHERE tanggal = '$kode' AND bulan = '$bulan'");
														while($w = mysqli_fetch_array($sql2))
														{
															$ID_produk = $w['ID_produk'];
															$n = round(($w['jumlah']*$bom), 1); 
															$temp1 = $n;
															$sr_p += $temp1;
														}
				
														//Cek jumlah Schedule Bahan Baku
														$sql3 = mysqli_query($con, "SELECT * FROM bom_temp2 WHERE tanggal = '$kode' AND bulan = '$bulan' and ID_bahanbaku = '$ID_bahanbaku'");
														while($g = mysqli_fetch_array($sql3))
														{
															$sr_b = $g['jumlah'];
															$sr_b += $temp2; 
														}

														//Proses Pengurangan
														$sr = abs($sr_b - $sr_p);
														
														if ($ph >= $gr){
															$ambilTgl = $i+1;
															$ph = round(($ph - $gr + $sr_b - $sr_p), 1);
														}
														else {
															$ph = $ph + $lotsize - $gr;
														}
														
														if ($ph < $gr){
															$lotsize1 = $lotsize ;
														}
														else {
															$lotsize1 =  ""  ;
														}
													?>
													<td><center><?php echo  $lotsize1;?></center></td>
													<?php } ?>
												</tr>
												<tr>
													<td>Point Order Release</td>
													<td></td>
													<?php				
													for($i = $tanggal+1; $i <= $akhir; $i++){
													if ($i < 10){
														$kode= "0".$i;
													}
													else{
														$kode = $i;
													}
			
													$final = "";
													$sql3 = mysqli_query($con, "SELECT tgl from mrp WHERE ID_bahanbaku = '$ID_bahanbaku'");
													while($c = mysqli_fetch_array($sql3))
													{ 
														$tgl = $c['tgl'];
														$net = 0;
															
														$sql8 = mysqli_query($con, "SELECT ID_bahanbaku from mrp WHERE ID_bahanbaku = '$ID_bahanbaku' AND tgl = '$kode'");
														while($h = mysqli_fetch_array($sql8))
														{ 
															$ID_bahanbaku = $h['ID_bahanbaku'];
															
															$sql9 = mysqli_query($con, "SELECT lotsize from bahanbaku WHERE ID_bahanbaku = '$ID_bahanbaku'");
															while($h = mysqli_fetch_array($sql9))
															{ 
																$lotsize= $h['lotsize'];
															}
															
															if($lotsize == NULL){
																$final = "";
															}
															else{
																$final = $lotsize;
															}
														}
													}
													?>
													<td><center><?php echo $final;?></center></td>
													<?php } ?>
												
													<td></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							<?php	
							}
							?>
							</div>
						</div> 
					</div>
				</div>
			</div>
		</div>
	<?php  include "_table.php";?>
</body>
</html>
