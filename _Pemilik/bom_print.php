<?php

//PRINT HALAMAN SUPPLIER
include "../laporan/fpdf.php";
include "model/koneksi.php";
include "model/class_produk.php";
$db = new produk();
$ID_produk = $_GET['id'];

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
$pdf->Cell(50,5,'Data Bill of Material (BOM) '.$db->tampil_nama_produk($ID_produk),'0','1','L',false);
$pdf->Ln(3);

$pdf->SetFont('Arial','B',8);
$pdf->Cell(35,6,'Kode Bahan Baku',1,0,'C');
$pdf->Cell(35,6,'Nama Bahan Baku',1,0,'C');
$pdf->Cell(35,6,'Bill of Material',1,0,'C');
$pdf->Ln(1);

$query = mysqli_query($con, "SELECT * from bom INNER JOIN bahanbaku ON bom.ID_bahanbaku = bahanbaku.ID_bahanbaku WHERE bom.ID_produk = '$ID_produk';");
while($data = mysqli_fetch_array($query)){ 
	$pdf->Ln(5);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(35,5,$data['ID_bahanbaku'],1,0,'L');
	$pdf->Cell(35,5,$data['deskripsi'],1,0,'L');
	$pdf->Cell(35,5,$data['bom'].' '.$data['unit'],1,0,'L');
}

$pdf->Output("Bom.pdf","I");

?>



















