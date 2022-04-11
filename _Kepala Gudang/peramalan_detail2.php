<!doctype html>
<html class="no-js" lang="">
<?php 
include "_head.php"; 
include "model/class_peramalan.php";
$db = new peramalan();

include "model/class_produk.php";
$pr = new produk();
?>

<body>
    <div id="right-panel" class="right-panel">
	<?php include "_header.php"; ?>
        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-5">
						<div class="card">
						<?php
							include 'model/koneksi.php';
							$tahun= $_GET['ID'];
							$ID_produk = $_POST['ID_produk'];
							$bulan = $_POST['bulan'];
							$tahun_depan = $tahun + 1;
							$nama_produk = $pr->tampil_nama_produk($ID_produk);
						?>
                            <div class="card-header">
                                <strong class="card-title">Filter Hasil Peramalan Tahun <?php print $tahun_depan;?></strong>
                            </div>
                            <div class="card-body">
                               <div class="col-md-12">
									<div class="card">
										<div class="card-header bg-info">
											<strong class="card-title text-light">Pilih Bulan: </strong>
										</div>
										<form method="POST" action="peramalan_detail2.php?ID=<?php print $tahun;?>">
											<div class="card-body text-white bg-info">
												<p class="card-text text-light">
													<select name="ID_produk" class="form-control">
														<option value="P-001"><center> Pilih Produk </center></option>
															<?php
															foreach($pr->tampil_produk() as $m)
															{ 
															?>	
															<option value="<?php print $m['ID_produk'];?>"> <?php print $m['nama_produk'];?></option>
															<?php
															}
															?>
													</select>
												</p>
												<p class="card-text text-light">
													<select name="bulan" class="form-control">
														<option value="01"><center> Pilih Bulan </center></option>
															<?php
															foreach($db->daftar_hasil_peramalan($tahun) as $m)
															{ 
															?>	
															<option value="<?php print $m['bulan'];?>"> <?php print $m['bulan'];?></option>
															<?php
															}
															?>
													</select>
												</p>
												<p class="card-text text-light">
													<button class="btn btn-outline-link btn-sm">Tampilkan</button>
												</p>
											</div>
										</form>
									</div>
								</div>
                            </div>
                        </div>
                    </div>
					<div class="col-md-7">
						<div class="card">
                            <div class="card-header">
                                <strong class="card-title"><small><b>Grafik Perbandingan: <?php print $pr->tampil_nama_produk($ID_produk);?> <?php print $db->tampil_namabulan($bulan);?> <?php print $tahun_depan;?></b></small></strong>
                            </div>
                            <div class="card-body">
								<div class="col-md-12">
									<canvas id="TrafficChart"></canvas>
								</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .animated -->
			<div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
						<div class="card">
                            <div class="card-header">
                                <strong class="card-title">Detail Hasil Peramalan Bulan <?php print $db->tampil_namabulan($bulan);?> <?php print $tahun_depan;?></strong>
                            </div>
                            <div class="card-body">
                               <div class="col-md-12">
									<div class="card">
										 <table id="bootstrap-data-table" class="table table-striped table-bordered">
											<thead>
												<tr>
													<th class="serial"><center>&nbsp;</th>
													<th>Item</th>
													<th><?php print $nama_produk;?> <br> <?php print $tahun_depan;?></th>
													</tr>
											</thead>
											<tbody>
											<?php
												$query = mysqli_query($con, "SELECT * FROM peramalan WHERE tahun='$tahun' AND bulan='$bulan' AND ID_produk = '$ID_produk';");
												while($m = mysqli_fetch_array($query))
												{
													$forecast = $m['forecast'];
													$jumlah = $m['jumlah'];
											?>
												<tr>
													<td>#</center></td>
													<td><?php print  $nama_produk;?></td>
													<td><?php print $m['forecast']. " <small>pcs</small>";?></td>
												</tr>
												<?php 
												} 
												?>
												
												<?php
												$i = 0;
												$no = 0;
												$unit ="";
												$kode = "";
												$tampil = "";
												$query = mysqli_query($con, "SELECT * FROM bom INNER JOIN bahanbaku on bom.ID_bahanbaku = bahanbaku.ID_bahanbaku WHERE ID_produk = '$ID_produk'");	
												while ($m=mysqli_fetch_array($query))
												{		
													
													$i++;
													if ($i < 10){
														$char = "00";
														$no = $char . $i;
													}
													else{
														$char = "0";
														$no = $char . $i;
													}
													$bom = $m['bom'];
													$final = $forecast*$bom;
												?>
												<tr>
													<td><?php print $no;?></td>
													<td><?php print $m['deskripsi'];?></td>
													<td><?php print $final;?>&nbsp;<?php print $m['unit'];?></td>
												</tr>
												<?php 
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
            </div><!-- .animated -->
        </div><!-- .content -->
		<div class="clearfix"></div>
	</div>
		
		<!-- Scripts -->
		<script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
		<script src="assets/js/main.js"></script>
		<!--  Chart js -->
		<script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.bundle.min.js"></script>
		<!--Chartist Chart-->
		<script src="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/chartist-plugin-legend@0.6.2/chartist-plugin-legend.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/flot-pie@1.0.0/src/jquery.flot.pie.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/flot-spline@0.0.1/js/jquery.flot.spline.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/simpleweather@3.1.0/jquery.simpleWeather.min.js"></script>
		<script src="assets/js/init/weather-init.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/moment@2.22.2/moment.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>
		<script src="assets/js/init/fullcalendar-init.js"></script>
		<script>
        jQuery(document).ready(function($) {
            "use strict";
            //Traffic chart chart-js
            if ($('#TrafficChart').length) {
                var ctx = document.getElementById( "TrafficChart" );
                ctx.height = 150;
                var myChart = new Chart( ctx, {
                    type: 'line',
                    data: {
                        labels: ['#', <?php print "'".$bulan."'";?>, '#'],
                        datasets: [
                        {
                            label: "Hasil Peramalan",
                            borderColor: "rgba(245, 23, 66, 0.9)",
                            borderWidth: "1",
                            backgroundColor: "rgba(245, 23, 66,.5)",
                            pointHighlightStroke: "rgba(245, 23, 66,.5)",
                            data: [0,<?php print $forecast;?>,0]
                        },
						{
                            label: "Data Penjualan",
                            borderColor: "rgba(4, 73, 203,.09)",
                            borderWidth: "1",
                            backgroundColor: "rgba(4, 73, 203,.5)",
                            data: [0,<?php print $jumlah;?>,0]
                        }
                        ]
                    },
                    options: {
                        responsive: true,
                        tooltips: {
                            mode: 'index',
                            intersect: false
                        },
                        hover: {
                            mode: 'nearest',
                            intersect: true
                        }

                    }
                } );
            }
            //Traffic chart chart-js  End
        });
		</script>
</body>
</html>
