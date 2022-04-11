<?php 
session_start();
$succcess = mysqli_connect("localhost","root","", "ollanda");
$username=$_POST['username'];
$password=$_POST['password'];

$query1=mysqli_query($succcess, "SELECT * FROM pegawai WHERE username='$username' AND password='$password'")or die(mysql_error());

if(mysqli_num_rows($query1)==1){
	$b=mysqli_fetch_array($query1);
	$id=$b['id'];
	$_SESSION['nama']=$b['nama'];	
	$_SESSION['role']=$b['jabatan'];
	$_SESSION['id']=$id;
		
	if($b['jabatan']=="Admin"){
			header("location:_Pemilik/index.php");			
	}
	elseif ($b['jabatan']=="Pegawai") {
			header("location:_Kepala Gudang/index.php");		
		}		
	}
	else{
	header("location:index.php?pesan=gagal");
}
// echo $pas;
 ?>