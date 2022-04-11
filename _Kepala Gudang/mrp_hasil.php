<!doctype html>
<html class="no-js" lang="">
<?php 
include "_head.php"; 
include "model/koneksi.php";
include 'model/class_mrp.php';
$db = new mrp(); 
include 'model/class_bahanbaku.php';
$bb = new bahanbaku(); 
include 'model/class_notifikasi.php';
$nf = new notifikasi(); 
?>
<body>
    <div id="right-panel" class="right-panel">
	<?php include "_header.php"; ?>
        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-8">
						<a href="mrp_perhitungan.php" style="color:white"><button type="button" class="btn btn-md btn-info">Tabel Perhitungan MRP&nbsp;&nbsp;<i class="fa fa-search"></i></button></a>      
						<br><br>
					</div>
				</div>
                <div class="row">
                    <div class="col-md-8">
						<div class="card">
							<div class="card-header alert alert-info">
								<?php
									$bulan_angka = date('m');
								?>	
                                <strong class="card-title">HASIL MRP (PORel):&nbsp;<?php print $db->tampil_bulan($bulan_angka);?>&nbsp;<?php print date('Y');?></strong>
                            </div>
							<div class="col col-sm-4">
								&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="myInput" onkeyup="myFunction()" class="form-control" placeholder="Cari Bahan Baku">
                            </div>
                            <div class="card-body">
                                <table id="myTable" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th><center>Bahan Baku</center></th>
                                            <th><center>Jatuh tempo pemesanan (<i>PORel</i>)</center></th>
                                            <th><center>Jumlah Pesan</center></th>
                                            <th><center>Status</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									$data = $db->tampil_mrp_hasil();
										if($data!=0){
											foreach($data as $m){
									?>
										<tr>
											<td><center><?php print $m['deskripsi'];?></center></td> 
                                            <td><center><?php print $m['tanggal'].' - '.$m['bulan'];?> </center></td>
                                            <td><center><?php print $m['lotsize']." <small>".$m['unit']."</small>"; ?></center></td> 
											<td><center><?php print $m['status']; ?></center></td> 
										</tr>
										<?php }
										}  ?>
									</tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
						<div class="card">
                            <div class="card-body"><!-- Tampil Notif Porel-->
								<div class="animated fadeIn">
									<script>
									$(document).ready(function(){
									$('#pesan_sedia').css("color","red");
									$('#pesan_sedia').append("<span class='glyphicon glyphicon-asterisk'></span>");
									});
									</script>
									<!-- Tampil Notif Porel-->
									<?php $nf->tampil_notifikasi_mrp(); ?>
								</div>
							</div>
						</div>
                    </div>
                </div>
            </div>
        </div>
		
		<script>
		function myFunction() {
		  // Declare variables
		  var input, filter, table, tr, td, i, txtValue;
		  input = document.getElementById("myInput");
		  filter = input.value.toUpperCase();
		  table = document.getElementById("myTable");
		  tr = table.getElementsByTagName("tr");

		  // Loop through all table rows, and hide those who don't match the search query
		  for (i = 0; i < tr.length; i++) {
			td = tr[i].getElementsByTagName("td")[0];
			if (td) {
			  txtValue = td.textContent || td.innerText;
			  if (txtValue.toUpperCase().indexOf(filter) > -1) {
				tr[i].style.display = "";
			  } else {
				tr[i].style.display = "none";
			  }
			}
		  }
		}
		</script>
		
		<!--footer -->
		<?php  include "_table.php";?>
</body>
</html>
