<?php

//PRINT HALAMAN BAHANBAKU
include "../laporan/fpdf.php";
include "model/koneksi.php";
$ID_produksi = $_GET['ID_produksi'];
$result = mysqli_query($con, "SELECT * FROM produksi WHERE ID_produksi = '$ID_produksi'");
while($m = mysqli_fetch_array($result)){
	$total_produksi = $m['pr_total'];
}

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
$pdf->Cell(50,5,'Detail Produksi Tanggal'.date("d/m/Y"),'0','1','L',false);
$pdf->Ln(3);

$pdf->SetFont('Arial','B',8);
$pdf->Cell(47,6,'Kode Bahan Baku',1,0,'C');
$pdf->Cell(47,6,'Bahan Baku',1,0,'C');
$pdf->Cell(47,6,'Jumlah Dibutuhkan',1,0,'C');
$pdf->Cell(47,6,'Satuan',1,0,'C');
$pdf->Ln(1);

$query = mysqli_query($con, "SELECT * FROM bom INNER JOIN bahanbaku ON bom.ID_bahanbaku = bahanbaku.ID_bahanbaku");
while($data = mysqli_fetch_array($query)){ 
	$pdf->Ln(5);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(47,5,$data['ID_bahanbaku'],1,0,'L');
	$pdf->Cell(47,5,$data['deskripsi'],1,0,'L');
	$pdf->Cell(47,5,$data['bom']*$total_produksi,1,0,'L');
	$pdf->Cell(47,5,$data['unit'],1,0,'L');
}

$pdf->Output("Detail_Produksi.pdf","I");

?>



















