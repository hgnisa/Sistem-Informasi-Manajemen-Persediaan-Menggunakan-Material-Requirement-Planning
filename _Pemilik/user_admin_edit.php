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
<script>
function myFunction2() {
  var x = document.getElementById("mypassword2");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
<body>
<body>
	<?php 
		include "model/koneksi.php";
		$query = mysqli_query($con, "SELECT * FROM pegawai WHERE jabatan = 'Admin'");
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
                                <i class="fa fa-edit"></i><strong>&nbsp;Profil Pemilik</strong>
                            </div>
							<form action="controller/user_admin_edit.php" method="post" class="form-horizontal">
								<div class="card-body">
									<div class="col col-sm-8">
										<div class="form-group">
											<label>Nama</label>
											<input name="nama" type="text" class="form-control" value="<?php echo $m->nama;?>">
										</div>
										<div class="form-group">
											<label>Username</label>
											<input name="username" type="text" class="form-control" value="<?php echo $m->username;?>">
										</div>
										<div class="form-group">
											<label>Password Lama</label>
											<input name="password" type="password" id="mypassword" class="form-control" readonly="" value="<?php echo $m->password;?>">
											<input type="checkbox" onclick="myFunction()"><small>Show Password</small>
										</div>
										<div class="form-group">
											<label>Password Baru</label>
											<input name="password" type="password" id="mypassword2" type="password_baru" class="form-control">
											<input type="checkbox" onclick="myFunction2()"><small>Show Password</small>
										</div>
										<button type="submit" class="btn btn-info btn-sm btn-block">Ubah Profil</button> <br>
										<a href="user_admin_profil.php"><button type="button" class="btn btn-outline-link btn-md btn-block">Batal</button></a>
									</div>
									<hr>
								</div>
							</form>
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
