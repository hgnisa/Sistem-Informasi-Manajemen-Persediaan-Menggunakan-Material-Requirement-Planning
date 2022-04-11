<?php

//PRINT HALAMAN SUPPLIER
include "../laporan/fpdf.php";
include "model/koneksi.php";

$pdf = new FPDF();
$pdf->AddPage();

$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,5,'OLLANDA BROWNIES','0','1','C',false);
$pdf->SetFont('Arial','',8);
$pdf->Cell(0,5,'Jl. Limbungan No 154, Rumbai','0','1','C',false);
$pdf->Cell(0,2,'Kota Pekanbaru','0','1','C',false);
$pdf->Ln(3);
$pdf->Cell(190,0.6,'','0','1','C',true);
$pdf->Ln(5);

$pdf->SetFont('Arial','B',9);
$pdf->Cell(50,5,'Data Menu Ollanda Brownies','0','1','L',false);
$pdf->Ln(3);

$pdf->SetFont('Arial','B',8);
$pdf->Cell(35,6,'Kode Produk',1,0,'C');
$pdf->Cell(35,6,'Nama Produk',1,0,'C');
$pdf->Ln(1);

$query = mysqli_query($con, "SELECT * from produk;");
while($data = mysqli_fetch_array($query)){ 
	$pdf->Ln(5);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(35,5,$data['ID_produk'],1,0,'L');
	$pdf->Cell(35,5,$data['nama_produk'],1,0,'L');
}

$pdf->Output("Menu.pdf","I");

?>



















