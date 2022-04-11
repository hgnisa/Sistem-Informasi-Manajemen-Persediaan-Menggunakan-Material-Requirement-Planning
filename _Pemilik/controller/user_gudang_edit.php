<?php
include "../model/koneksi.php";


$nama = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];
	 	
$query = mysqli_query($con, "UPDATE pegawai SET nama = '$nama', username = '$username', password = '$password' WHERE kode_user = 'PGW-001'");

						
						?>
						<script type="text/javascript">
							alert("Update Berhasil!");
							window.location = "../user_gudang.php";						
						</script> 
						<?php

