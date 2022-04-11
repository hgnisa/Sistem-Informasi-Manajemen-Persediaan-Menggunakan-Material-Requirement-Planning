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
$pdf->Cell(50,5,'Laporan Data Supplier','0','1','L',false);
$pdf->Ln(3);

$pdf->SetFont('Arial','B',8);
$pdf->Cell(35,6,'Kode',1,0,'C');
$pdf->Cell(35,6,'Nama Supplier',1,0,'C');
$pdf->Cell(37,6,'Alamat',1,0,'C');
$pdf->Cell(37,6,'No Telp',1,0,'C');
$pdf->Cell(45,6,'Email',1,0,'C');
$pdf->Ln(1);

$query = mysqli_query($con, "SELECT * from supplier;");
while($data = mysqli_fetch_array($query)){ 
	$pdf->Ln(5);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(35,5,$data['ID_supplier'],1,0,'L');
	$pdf->Cell(35,5,$data['nama_supplier'],1,0,'L');
	$pdf->Cell(37,5,$data['alamat_supplier'],1,0,'L');
	$pdf->Cell(37,5,$data['telp_supplier'],1,0,'L');
	$pdf->Cell(45,5,$data['email_supplier'],1,0,'L');
}

$pdf->Output("Supplier.pdf","I");

?>



















