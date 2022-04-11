<!doctype html>
<html class="no-js" lang="">
<!-- Header-->
<?php include "_head.php"; ?>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script>
function myFunction() {
  var x = document.getElementById("mypassword");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
<body>
	<?php 
		include "model/koneksi.php";
		$query = mysqli_query($con, "SELECT * FROM pegawai WHERE jabatan = 'Pegawai'");
		$m = mysqli_fetch_object($query);
			$id = $m->id;
			$password = $m->password;
			
	?>
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <?php include "_header.php"; ?>
        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header alert alert-info">
                                <i class="fa fa-edit"></i><strong>&nbsp;Profil Kepala Gudang</strong>
                            </div>
								<div class="card-body">
									<div class="col col-sm-8">
										<div class="form-group">
											<label>Nama</label>
											<input name="nama" type="text" class="form-control" readonly="" value="<?php echo $m->nama;?>">
										</div>
										<div class="form-group">
											<label>Username</label>
											<input name="username" type="text" class="form-control" readonly="" value="<?php echo $m->username;?>">
										</div>
										<div class="form-group">
											<label>Password</label>
											<input name="password" type="password" id="mypassword" class="form-control" readonly="" value="<?php echo $m->password;?>">
											<input type="checkbox" onclick="myFunction()"><small>Show Password</small>
										</div>
										<a href="user_gudang_edit.php"><button type="submit" class="btn btn-info btn-sm btn-block">Ubah Profil</button></a>  
										<br>
									</div>
									<hr>
								</div>
                        </div>
                    </div>
                </div><!-- .row -->
            </div><!-- .animated -->
        </div><!-- .content -->
        <?php
		include "_table.php.";
		?>
</body>
</html>
