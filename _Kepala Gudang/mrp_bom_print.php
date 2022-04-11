<?php

//PRINT HALAMAN BILL OF MATERIAL
include "../laporan/fpdf.php";
include "Controller/koneksi.php";

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
$pdf->Cell(50,5,'Laporan Data Resep','0','1','L',false);
$pdf->Ln(3);

$pdf->SetFont('Arial','B',8);
$pdf->Cell(30,6,'Kode BOM',1,0,'C');
$pdf->Cell(30,6,'Kode Bahan Baku',1,0,'C');
$pdf->Cell(30,6,'Bahan Baku',1,0,'C');
$pdf->Cell(30,6,'Persediaan',1,0,'C');
$pdf->Cell(30,6,'Lead Time',1,0,'C');
$pdf->Cell(30,6,'BOM/produk',1,0,'C');
$pdf->Ln(1);

$query = mysqli_query($con, "SELECT * from bom INNER JOIN bahanbaku ON bom.ID_bahanbaku = bahanbaku.ID_bahanbaku;");
while($data = mysqli_fetch_array($query)){ 
	$pdf->Ln(5);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(30,5,$data['ID_bom'],1,0,'L');
	$pdf->Cell(30,5,$data['ID_bahanbaku'],1,0,'L');
	$pdf->Cell(30,5,$data['deskripsi'],1,0,'L');
	$pdf->Cell(30,5,$data['qty'],1,0,'L');
	$pdf->Cell(30,5,$data['leadtime']." hari",1,0,'L');
	$pdf->Cell(30,5,$data['bom']." ".$data['unit'],1,0,'L');
}

$pdf->Output();

?>



















