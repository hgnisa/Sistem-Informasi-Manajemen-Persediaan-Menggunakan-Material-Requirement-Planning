<?php

//PRINT HALAMAN BAHANBAKU
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
$pdf->Cell(50,5,'Laporan Data Bahan Baku','0','1','L',false);
$pdf->Ln(3);

$pdf->SetFont('Arial','B',8);
$pdf->Cell(20,6,'Kode',1,0,'C');
$pdf->Cell(30,6,'Bahan Baku',1,0,'C');
$pdf->Cell(25,6,'Stock',1,0,'C');
$pdf->Cell(22,6,'Reorder Point',1,0,'C');
$pdf->Cell(20,6,'Harga',1,0,'C');
$pdf->Cell(22,6,'Safety Stock',1,0,'C');
$pdf->Cell(22,6,'Lot Size',1,0,'C');
$pdf->Cell(30,6,'Supplier',1,0,'C');
$pdf->Ln(1);

$query = mysqli_query($con, "SELECT * from bahanbaku INNER JOIN supplier ON bahanbaku.ID_supplier = supplier.ID_supplier;");
while($data = mysqli_fetch_array($query)){ 
	$pdf->Ln(5);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(20,5,$data['ID_bahanbaku'],1,0,'L');
	$pdf->Cell(30,5,$data['deskripsi'],1,0,'L');
	$pdf->Cell(25,5,$data['qty']." ".$data['unit'],1,0,'L');
	$pdf->Cell(22,5,$data['rop']." ".$data['unit'],1,0,'L');
	$pdf->Cell(20,5,"Rp. ".$data['harga'],1,0,'L');
	$pdf->Cell(22,5,$data['safetystock']." ".$data['unit'],1,0,'L');
	$pdf->Cell(22,5,$data['lotsize']." ".$data['unit'],1,0,'L');
	$pdf->Cell(30,5,$data['nama_supplier'],1,0,'L');
}

$pdf->Output("Bahanbaku.pdf","I");

?>



















