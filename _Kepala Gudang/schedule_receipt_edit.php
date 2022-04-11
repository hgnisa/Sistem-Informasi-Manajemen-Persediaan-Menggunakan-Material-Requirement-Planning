<!doctype html>
<html class="no-js" lang="">
<!-- Header-->
<?php include "_head.php"; ?>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<?php
include 'model/class_schedulereceipt.php';
include 'model/class_produk.php';
$db = new schedulereceipt();
$pr = new produk();
?>
<body>	
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <?php include "_header.php"; ?>
        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header alert alert-info">
                                <i class="fa fa-edit"></i><strong>&nbsp;Ubah Data Pre Order</strong>
                            </div>
							<form action="controller/proses_schedulereceipt.php?ID_sr=<?php echo $_GET['ID_sr'];?>&aksi=update" method="post" class="form-horizontal">
							<?php 
								foreach ($db->edit($_GET['ID_sr']) as $m){
							?>
								<div class="card-body">
									<div class="col col-sm-8">
										<div class="form-group">
											<label>Menu</label>
											<input name="ID_sr" type="hidden" class="form-control" readonly="" value="<?php echo $m['ID_sr'];?>">
											<input name="ID_produk" type="hidden" class="form-control" readonly="" value="<?php echo $m['ID_produk'];?>">
											<input type="text" class="form-control" readonly="" value="<?php echo $pr->tampil_nama_produk($m['ID_produk']);?>">
										</div>
										<div class="form-group">
											<label>Tanggal</label>
											<input name="tanggal" type="text" class="form-control" readonly="" value="<?php echo $m['tanggal'];?>">
										</div>
										<div class="form-group">
											<label>Bulan</label>
											<input name="bulan" type="text" class="form-control" readonly="" value="<?php echo $m['bulan'];?>">
										</div>
										<div class="form-group">
											<label>Jumlah (pcs)</label>
											<input name="jumlah" type="number" class="form-control" value="<?php echo $m['jumlah'];?>"  Onkeypress="return event.charCode >= 48 && event.charCode <=57" required oninvalid="this.setCustomValidity('Jumlah tidak boleh kosong')" oninput="setCustomValidity('')" class="form-control jmlh_list" min=1>
										</div>
										<a href=""><button type="submit" class="btn btn-info btn-sm btn-block">Ubah Pre Order</button></a>  
										<br>
										<a href="schedule_receipt_input.php"><button type="button" class="btn btn-outline-link btn-md btn-block">Batal</button></a>
									</div>
									<hr>
								</div>
								<?php
								}
								?>
							</form>
                        </div>
                    </div>
                </div><!-- .row -->
            </div><!-- .animated -->
			
			<script>
			$(document).ready(function(){  
				  var i=1;  
				  $('#add').click(function(){  
					   i++;  
					   $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="number" name="name[]" placeholder="Tgl" class="form-control name_list" min=1 max='' /></td><td><input type="number" name="jmlh[]" placeholder="Jumlah" class="form-control jmlh_list" min=1 /></td><td><button type="button" name="remove" id="'+i+'" class="btn-sm btn-danger btn_remove">X</button></td></tr>');  
				  });  
				  $(document).on('click', '.btn_remove', function(){  
					   var button_id = $(this).attr("id");   
					   $('#row'+button_id+'').remove();  
				  });  
			 });  
			 </script>
				
        </div><!-- .content -->
        <div class="clearfix"></div>
</body>
</html>
