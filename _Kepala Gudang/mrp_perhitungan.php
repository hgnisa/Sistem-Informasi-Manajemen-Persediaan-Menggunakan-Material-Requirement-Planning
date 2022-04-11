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
$peramalan1 = 2019;

mysqli_query($con, "TRUNCATE TABLE mrp");
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
													$ambil = 0;
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
													$gr = round(ceil($ambil/$akhir)) ;			
													for($i = $tanggal+1; $i <= $akhir; $i++){
													?>
													<td><center><?php echo $gr; }?></center></td>
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
							
														$temp = 0;
														$sql5 = mysqli_query($con, "SELECT * FROM bom_temp1 WHERE tanggal = '$kode' AND bulan = '$bulan' and ID_produk='$ID_produk'");
														while($e = mysqli_fetch_array($sql5))
														{
															$temp  = $e['jumlah'];
														}
														$sr = $temp;
													?>
													<td><center><?php echo  $sr;}?></center></td>
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
														$temp = 0;
														$sql5 = mysqli_query($con, "SELECT * FROM bom_temp1 WHERE tanggal = '$kode' AND bulan = '$bulan' and ID_produk='$ID_produk'");
														while($e = mysqli_fetch_array($sql5))
														{
															$temp  = $e['jumlah'];
														}
														$sr = $temp;
													?>
													<td><center><?php echo $gr+$sr;}?></center></td>
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

														$temp = 0;
														$sql5 = mysqli_query($con, "SELECT * FROM bom_temp1 WHERE tanggal = '$kode' AND bulan = '$bulan' and ID_produk='$ID_produk'");
														while($e = mysqli_fetch_array($sql5))
														{
															$temp  = $e['jumlah'];
														}
														$sr = $temp;
													?>
													<td><center><?php echo $gr+$sr;}?></center></td>
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
							
														$temp = 0;
														$sql5 = mysqli_query($con, "SELECT * FROM bom_temp1 WHERE tanggal = '$kode' AND bulan = '$bulan' and ID_produk='$ID_produk'");
														while($e = mysqli_fetch_array($sql5))
														{
															$temp  = $e['jumlah'];
														}
														$sr = $temp;
													?>
													<td><center><?php echo $gr+$sr;}?></center></td>
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
														$lotsize = $l['lotsize'];
														$unit = $l['unit'];
														$leadtime = $l['leadtime'];
													?>
													<th><b><?php echo $deskripsi;?></b></th>
													<?php } ?>
												</tr>
												<tr>
													<th>Lot Size</th>
													<th>:</th>
													<th><b><?php echo $lotsize." ".$unit;?></b></th>
												</tr>
												<tr>
													<th>Lead Time</th>
													<th>:</th>
													<th><b><?php echo $leadtime." hari";?></b></th>
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
															$query2 = mysqli_query($con, "SELECT * from bom INNER JOIN bahanbaku ON bom.ID_bahanbaku = bahanbaku.ID_bahanbaku WHERE bom.ID_bahanbaku = '$ID_bahanbaku' AND bom.ID_produk = '$ID_produk'");
															while($o = mysqli_fetch_array($query2))
															{
																$bom = $o['bom'];
																$ph = $o['qty'];
																$lotsize = $o['lotsize'];
															}
															
															$temp = round(((ceil($ambil/$akhir))*$bom), 1);
															$gr += $temp;	
														}
														 
													?>
													<td><center><?php echo $gr;?></center></td>
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
														
														$sr = 0;
														$query1 = mysqli_query($con, "SELECT DISTINCT ID_produk from produk");
														while($n = mysqli_fetch_array($query1))
														{ 
															$ID_produk = $n['ID_produk'];

															$temp = 0;
															$query2 = mysqli_query($con, "SELECT * from bom INNER JOIN bahanbaku ON bom.ID_bahanbaku = bahanbaku.ID_bahanbaku WHERE bom.ID_bahanbaku = '$ID_bahanbaku' AND bom.ID_produk = '$ID_produk'");
															while($o = mysqli_fetch_array($query2))
															{
																$bom = $o['bom'];

																$sql2 = mysqli_query($con, "SELECT * FROM bom_temp1 WHERE tanggal = '$kode' AND bulan = '$bulan' AND ID_produk = '$ID_produk'");
																while($w = mysqli_fetch_array($sql2))
																{
																	$temp = round(($w['jumlah']*$bom), 1); 
																	$sr += $temp;
																}
															}
														}
													?>
													<td><center><?php echo $sr;?></center></td>
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
													for($i = $tanggal+1; $i <= $akhir; $i++)
													{
														if ($i < 10){
															$kode= "0".$i;
														}
														else{
															$kode = $i;
														}
														
														$sr = 0;
														$sr_b = 0;
														$temp1 = 0;
														$temp2 = 0;

														$sr = 0;
														$query1 = mysqli_query($con, "SELECT DISTINCT ID_produk from produk");
														while($n = mysqli_fetch_array($query1))
														{ 
															$ID_produk = $n['ID_produk'];

															$temp = 0;
															$query2 = mysqli_query($con, "SELECT * from bom INNER JOIN bahanbaku ON bom.ID_bahanbaku = bahanbaku.ID_bahanbaku WHERE bom.ID_bahanbaku = '$ID_bahanbaku' AND bom.ID_produk = '$ID_produk'");
															while($o = mysqli_fetch_array($query2))
															{
																$bom = $o['bom'];

																$sql2 = mysqli_query($con, "SELECT * FROM bom_temp1 WHERE tanggal = '$kode' AND bulan = '$bulan' AND ID_produk = '$ID_produk'");
																while($w = mysqli_fetch_array($sql2))
																{
																	$temp = round(($w['jumlah']*$bom), 1); 
																	$sr += $temp;
																}
															}
														}
				
				
														$sql3 = mysqli_query($con, "SELECT * FROM bom_temp2 WHERE tanggal = '$kode' AND bulan = '$bulan' and ID_bahanbaku = '$ID_bahanbaku'");
														while($g = mysqli_fetch_array($sql3))
														{
															$sr_b = $g['jumlah'];
															$sr_b += $temp2; 
														}

														//Proses Pengurangan
														if ($ph >= ($gr + $sr + $sr_b)){
															$ph = round(($ph - $gr + $sr_b - $sr), 1);
														}
														else {
															$ph = $ph + $lotsize - $gr - $sr - $sr_b;
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
													$sql4 = mysqli_query($con, "SELECT qty from bahanbaku WHERE ID_bahanbaku = '$ID_bahanbaku'");
													while($d = mysqli_fetch_array($sql4))
													{ 
														$ph = $d['qty'];
													}
													
													for($i = $tanggal+1; $i <= $akhir; $i++)
													{
														if ($i < 10){
															$kode= "0".$i;
														}
														else{
															$kode = $i;
														}
														
														
														$sr = 0;
														$query1 = mysqli_query($con, "SELECT DISTINCT ID_produk from produk");
														while($n = mysqli_fetch_array($query1))
														{ 
															$ID_produk = $n['ID_produk'];

															$temp = 0;
															$query2 = mysqli_query($con, "SELECT * from bom INNER JOIN bahanbaku ON bom.ID_bahanbaku = bahanbaku.ID_bahanbaku WHERE bom.ID_bahanbaku = '$ID_bahanbaku' AND bom.ID_produk = '$ID_produk'");
															while($o = mysqli_fetch_array($query2))
															{
																$bom = $o['bom'];

																$sql2 = mysqli_query($con, "SELECT * FROM bom_temp1 WHERE tanggal = '$kode' AND bulan = '$bulan' AND ID_produk = '$ID_produk'");
																while($w = mysqli_fetch_array($sql2))
																{
																	$temp = round(($w['jumlah']*$bom), 1); 
																	$sr += $temp;
																}
															}

															$sql3 = mysqli_query($con, "SELECT * FROM bom_temp2 WHERE tanggal = '$kode' AND bulan = '$bulan' and ID_bahanbaku = '$ID_bahanbaku'");
															while($g = mysqli_fetch_array($sql3))
															{
																$sr_b = $g['jumlah'];
																$sr_b += $temp2; 
															}												
															
														}
														//Proses Pengurangan
														if ($ph >= ($gr + $sr + $sr_b)){
															$ph = round(($ph - $gr - $sr), 1);
															$net = '';
														}
														else {
															$ph = $ph + $lotsize - $gr - $sr;
															$net = abs($ph - $lotsize);
														}

													?>
													<td><center><?php echo $net;?> </center></td>
													<?php } ?>
													<td></td>
												</tr>
												<tr>
													<td>Point Order Receipt</td>
													<td></td>
													<?php
													$sql4 = mysqli_query($con, "SELECT qty from bahanbaku WHERE ID_bahanbaku = '$ID_bahanbaku'");
													while($d = mysqli_fetch_array($sql4))
													{ 
														$ph = $d['qty'];
													}
													
													for($i = $tanggal+1; $i <= $akhir; $i++)
													{
														if ($i < 10){
															$kode= "0".$i;
														}
														else{
															$kode = $i;
														}
														
														
														$sr = 0;
														$query1 = mysqli_query($con, "SELECT DISTINCT ID_produk from produk");
														while($n = mysqli_fetch_array($query1))
														{ 
															$ID_produk = $n['ID_produk'];

															$temp = 0;
															$query2 = mysqli_query($con, "SELECT * from bom INNER JOIN bahanbaku ON bom.ID_bahanbaku = bahanbaku.ID_bahanbaku WHERE bom.ID_bahanbaku = '$ID_bahanbaku' AND bom.ID_produk = '$ID_produk'");
															while($o = mysqli_fetch_array($query2))
															{
																$bom = $o['bom'];
																$rop = $o['rop'];
																$leadtime = $o['leadtime'];

																$sql2 = mysqli_query($con, "SELECT * FROM bom_temp1 WHERE tanggal = '$kode' AND bulan = '$bulan' AND ID_produk = '$ID_produk'");
																while($w = mysqli_fetch_array($sql2))
																{
																	$temp = round(($w['jumlah']*$bom), 1); 
																	$sr += $temp;
																}
															}

															$sql3 = mysqli_query($con, "SELECT * FROM bom_temp2 WHERE tanggal = '$kode' AND bulan = '$bulan' and ID_bahanbaku = '$ID_bahanbaku'");
															while($g = mysqli_fetch_array($sql3))
															{
																$sr_b = $g['jumlah'];
																$sr_b += $temp2; 
															}												
															
														}
														//Proses Pengurangan
														if ($ph >= ($gr + $sr + $sr_b)){
															$ph = round(($ph - $gr - $sr), 1);
															$net = '';
															$porec = '';
														}
														else {
															$ph = $ph + $lotsize - $gr - $sr;
															$net = abs($ph - $lotsize);
															$porec = $lotsize;

															$sisa_hari = $kode - $leadtime;
															mysqli_query($con, "INSERT INTO mrp (ID_bahanbaku,tanggal,bulan,status)VALUES('$ID_bahanbaku','$sisa_hari','$bulan', 0)");

														}
													?>
													<td><center><?php echo $porec;?></center></td>
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

														$sql3 = mysqli_query($con, "SELECT * from mrp WHERE tanggal = '$kode' AND bulan = '$bulan' AND ID_bahanbaku = '$ID_bahanbaku'");
														while($c = mysqli_fetch_array($sql3))
														{ 
															$tgl_mrp = $c['tanggal'];
															$final =0;
															
															$sql9 = mysqli_query($con, "SELECT lotsize from bahanbaku WHERE ID_bahanbaku = '$ID_bahanbaku'");
															while($h = mysqli_fetch_array($sql9))
															{ 
																$lotsize= $h['lotsize'];
															}
														}
																								
														if($tgl_mrp == $kode){
															$final = $lotsize;
														}
														else{
															$final = ''; 
														}
													?>
													<td style="color:red"><center><?php echo $final;?></center></td>
													<?php  }?>
												
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
