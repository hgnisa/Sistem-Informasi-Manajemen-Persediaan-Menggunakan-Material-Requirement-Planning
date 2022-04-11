<!doctype html>
<html class="no-js" lang="">
<!-- Header-->
<?php include "_head.php"; ?>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

<body>
	<?php 
		include "Controller/koneksi.php";
		$ID_bom = $_GET['ID_bom'];
		$query = mysqli_query($con, "SELECT * FROM bom WHERE ID_bom = '$ID_bom'");
		$m = mysqli_fetch_object($query);
			$ID_bahanbaku = $m->ID_bahanbaku;
			
		$sql = mysqli_query($con,"SELECT * from bahanbaku WHERE ID_bahanbaku = '$ID_bahanbaku'");
		while ($n=mysqli_fetch_array($sql))
		{
			$deskripsi = $n['deskripsi'];
		}
	?>
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <?php include "_header.php"; ?>
        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-edit"></i><strong>&nbsp;Ubah Data Bill of Material</strong>
                            </div>
							<form action="Controller/mrp_bom_edit.php" method="post" class="form-horizontal">
								<div class="card-body">
									<div class="col col-sm-8">
										<div class="form-group">
											<label>Kode BOM</label>
											<input name="ID_bom" type="text" class="form-control" readonly="" value="<?php echo $m->ID_bom;?>">
										</div>
										<div class="form-group">
											<label>Bahan Baku </label>
											<input name="deskripsi" type="text" class="form-control" readonly="" value="<?php echo $deskripsi;?>">
										</div>
										<div class="form-group">
											<label>Lead Time</label>
											<input name="leadtime" type="number" class="form-control" value="<?php echo $m->leadtime;?>" Onkeypress="return event.charCode >= 48 && event.charCode <=57" maxlength=12 required oninvalid="this.setCustomValidity('Lead Time tidak boleh kosong')" oninput="setCustomValidity('')">
										</div>
										<div class="form-group">
											<label>Kuantitas dalam satu produk<small>per ukuran satuan</small></label>
											<input name="bom" type="number" class="form-control" placeholder="0.000" required min="0" value="<?php echo $m->bom;?>" step="0.001" title="Currency" pattern="^\d+(?:\.\d{1,3})?$" onblur="
											this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,3})?$/.test(this.value)?'inherit':'red'">
										</div>
										<a href=""><button type="submit" class="btn btn-info btn-sm btn-block">Ubah Bahan Baku</button></a>  
										<br>
										<a href="mrp_bom.php"><button type="button" class="btn btn-outline-link btn-md btn-block">Batal</button></a>
									</div>
									<hr>
								</div>
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
