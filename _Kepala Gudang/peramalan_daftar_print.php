<?php

//PRINT HALAMAN SUPPLIER
include "../laporan/fpdf.php";
include "Controller/koneksi.php";
$tahun = $_GET['ID'];
$tahun_ramal = $tahun + 1;

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
$pdf->Cell(50,5,'Hasil Peramalan Penjualan Tahun '.$tahun_ramal,'0','1','L',false);
$pdf->Ln(3);

$pdf->SetFont('Arial','B',8);
$pdf->Cell(65,6,'Bulan',1,0,'C');
$pdf->Cell(65,6,'Data Historis Penjualan Tahun '.$tahun,1,0,'C');
$pdf->Cell(65,6,'Hasil Peramalan Penjualan '.$tahun_ramal,1,0,'C');
$pdf->Ln(1);

$query = mysqli_query($con, "SELECT * FROM peramalan WHERE tahun = '$tahun'");
while($data = mysqli_fetch_array($query)){
	$pdf->Ln(5);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(65,5,$data['bulan'],1,0,'C');
	$pdf->Cell(65,5,$data['jumlah'],1,0,'C');
	$pdf->Cell(65,5,ROUND($data['forecast']),1,0,'C');
}
$pdf->Output("Hasil_Peramalan.pdf","I");

?>