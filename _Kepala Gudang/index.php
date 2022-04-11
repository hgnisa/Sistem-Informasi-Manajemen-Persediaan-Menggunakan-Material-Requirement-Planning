<!doctype html>
<html class="no-js" lang="">
<!-- Header-->
<?php 
include "_head.php"; 
include '_chart.php';
include '_script.php';
include 'model/koneksi.php';
include 'model/class_grafik.php';
include 'model/class_produk.php';
include 'model/class_notifikasi.php';
include 'model/class_peramalan.php';
$db = new grafik(); 
$pr = new produk(); 
$nf = new notifikasi(); 
$rm = new peramalan(); 

$ID_produk = $_POST['ID_produk'];
$tahun = $_POST['tahun'];
if(($ID_produk == NULL) && ($tahun == NULL)){
	$ID_produk = 'P-001';
	$tahun = $rm->tampil_tahun_inputperamalan();
}
?>
<body>
    <div id="right-panel" class="right-panel">
        <?php include "_header.php"; ?>
		 <div class="content">
			<div class="animated fadeIn">
				<p><strong> Aktivitas <?php echo date('M d, Y');?> </strong></p>
			</div>
			
			<!-- Tampil Notif ROP-->
			<div class="animated fadeIn">
				<script>
				$(document).ready(function(){
				$('#pesan_sedia').css("color","red");
				$('#pesan_sedia').append("<span class='glyphicon glyphicon-asterisk'></span>");
				});
				</script>
				<!-- Tampil Notif Porel-->
				<?php $nf->tampil_notifikasi_rop(); ?>
				
				<!-- Tampil Notif Porel-->
				<?php $nf->tampil_notifikasi_mrp(); ?>
			
				<!-- Notifikasi Pembelian Bahan Baku -->
				<?php $nf->tampil_notifikasi_pembelian(); ?>
			</div>
			
			<!-- Tampil Card-->
			<div class="animated fadeIn">
                <div class="row">
                    <div class="col-sm-6 col-lg-3">
						<div class="card text-white bg-flat-color-6">
							<div class="card-body">
								<div class="card-left pt-1 float-left">
									<h3 class="mb-0 fw-r">
										<span class="count"><?php echo $nf->tampil_card1();?></span>  <small><small>pcs</small></small>
									</h3>
									<p class="text-light mt-1 m-0"><small>Terjual hari ini</small></p>
								</div>
								<div class="card-right float-right text-right">
									<i class="icon fade-5 icon-lg pe-7s-cart"></i>
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="col-sm-6 col-lg-3">
						<div class="card text-white bg-flat-color-2">
							<div class="card-body">
								<div class="card-left pt-1 float-left">
									<h3 class="mb-0 fw-r">
										<span class="count"><?php echo $nf->tampil_card2();?></span>
									</h3>
									<p class="text-light mt-1 m-0"><small>Pendapatan</small> <small><small>(Rp.)</small></small></p>
								</div>
								<div class="card-right float-right text-right">
									<i class="icon fade-5 icon-lg pe-7s-cash"></i>
                                </div>
                            </div>
                        </div>
                    </div>
					
					<div class="col-sm-6 col-lg-3">
						<div class="card text-white bg-flat-color-3">
							<div class="card-body">
								<div class="card-left pt-1 float-left">
									<h3 class="mb-0 fw-r">
										<span class="count"><?php echo $nf->tampil_card3();?></span> <small><small>pcs</small></small>
									</h3>
									<p class="text-light mt-1 m-0"><small>Produk tersisa</small></p>
								</div>
								<div class="card-right float-right text-right">
									<i class="icon fade-5 icon-lg pe-7s-box1"></i>
                                </div>
                            </div>
                        </div>
                    </div>
					
                    <div class="col-sm-6 col-lg-3">
						<div class="card text-white bg-flat-color-4">
							<div class="card-body">
								<div class="card-left pt-1 float-left">
									<h3 class="mb-0 fw-r">
										<span class="count"><?php echo $nf->tampil_card4();?> <small><small>pcs</small></small></span>
									</h3>
									<small><span class="count">Terjual bulan ini</span> </small>
								</div>
								<div class="card-right float-right text-right">
									<i class="icon fade-5 icon-lg pe-7s-display1"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /Widgets -->
				
                <!--  Traffic  -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header alert alert-info">
                                <h4 class="box-title">Perbandingan Data Histori Penjualan, Hasil Peramalan dan Data Aktual Penjualan</h4>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
									<div class="card-body">
									<form method="POST" action="index.php">
                                        <table> 
											<tr> 
												<td>
													<select name="ID_produk" class="form-control">
														<small><option value="P-001"> Pilih Produk </option>
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
												<td>
													<select name="tahun" class="form-control">
														<option> Pilih Tahun </option>
														<?php
														for($i = 2018; $i <= $rm->tampil_tahun_inputperamalan(); $i++){
														?>
														<option value="<?php echo $i; ?>"> <?php echo $i; ?> </option>
														<?php } ?>
													</select>
												</td>	
												<td width="70px" align="center"><button class="btn btn-md btn-info">Tampilkan</button></center></td> 
											</tr>
										</table>
										</form>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="TrafficChart"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body"></div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
        <div class="clearfix"></div>
        <footer class="site-footer">
            <div class="footer-inner bg-white">
                <div class="row">
                    <div class="col-sm-6">
                        Ollanda Brownies
                    </div>
                    <div class="col-sm-6 text-right">
                        Designed by <a href="https://colorlib.com">Colorlib</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
	
	<!--Local Stuff--> 
    <script>
        jQuery(document).ready(function($) {
            "use strict";
            //Traffic chart chart-js
            if ($('#TrafficChart').length) {
                var ctx = document.getElementById( "TrafficChart" );
                ctx.height = 100;
                var myChart = new Chart( ctx, {
                    type: 'line',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'],
                        datasets: [
						{
                            label: "Data Histori Penjualan <?php echo $tahun;?>",
                            borderColor: "rgba(4, 73, 203,.09)",
                            borderWidth: "1",
                            backgroundColor: "rgba(4, 73, 203,.5)",
                            data: [<?php $db->dt_jan($ID_produk, $tahun);?>, <?php $db->dt_feb($ID_produk, $tahun);?>, <?php $db->dt_mar($ID_produk, $tahun);?>, <?php $db->dt_apr($ID_produk, $tahun);?>, <?php $db->dt_mei($ID_produk, $tahun);?>, <?php $db->dt_jun($ID_produk, $tahun);?>, <?php $db->dt_jul($ID_produk, $tahun);?>, <?php $db->dt_agt($ID_produk, $tahun);?>,  <?php $db->dt_sep($ID_produk, $tahun);?>, <?php $db->dt_okt($ID_produk, $tahun);?>, <?php $db->dt_nov($ID_produk, $tahun);?>, <?php $db->dt_des($ID_produk, $tahun);?> ]
                        },
						{
                            label: "Hasil Peramalan Penjualan <?php echo $tahun + 1;?> ",
                            borderColor: "rgba(245, 23, 66, 0.9)",
                            borderWidth: "1",
                            backgroundColor: "rgba(245, 23, 66,.5)",
                            pointHighlightStroke: "rgba(245, 23, 66,.5)",
                            data: [<?php $db->fr_jan($ID_produk, $tahun);?>, <?php $db->fr_feb($ID_produk, $tahun);?>, <?php $db->fr_mar($ID_produk, $tahun);?>, <?php $db->fr_apr($ID_produk, $tahun);?>, <?php $db->fr_mei($ID_produk, $tahun);?>, <?php $db->fr_jun($ID_produk, $tahun);?>, <?php $db->fr_jul($ID_produk, $tahun);?>, <?php $db->fr_agt($ID_produk, $tahun);?>,  <?php $db->fr_sep($ID_produk, $tahun);?>, <?php $db->fr_okt($ID_produk, $tahun);?>, <?php $db->fr_nov($ID_produk, $tahun);?>, <?php $db->fr_des($ID_produk, $tahun);?> ]
                        },
						{
                            label: "Data Penjualan Aktual <?php echo $tahun + 1;?>",
                            borderColor: "rgba(40, 169, 46, 0.9)",
                            borderWidth: "1",
                            backgroundColor: "rgba(40, 169, 46, .5)",
                            pointHighlightStroke: "rgba(40, 169, 46,.5)",
                            data: [<?php $db->pj_jan($ID_produk, $tahun);?>, <?php $db->pj_feb($ID_produk, $tahun);?>, <?php $db->pj_mar($ID_produk, $tahun);?>, <?php $db->pj_apr($ID_produk, $tahun);?>, <?php $db->pj_mei($ID_produk, $tahun);?>, <?php $db->pj_jun($ID_produk, $tahun);?>, <?php $db->pj_jul($ID_produk, $tahun);?>, <?php $db->pj_agt($ID_produk, $tahun);?>, <?php $db->pj_sep($ID_produk, $tahun);?>, <?php $db->pj_okt($ID_produk, $tahun);?>, <?php $db->pj_nov($ID_produk, $tahun);?>, <?php $db->pj_des($ID_produk, $tahun);?> ]
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

