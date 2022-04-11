<?php
ob_start();
include "../laporan/fpdf.php";
include "model/koneksi.php";

$ID_faktur = $_GET['ID_faktur'];
//--------------------------------------------------------------------------------------PRINT HALAMAN PEMBELIAN BAHAN BAKU
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
$pdf->Cell(50,5,'Detail Faktur Pembelian Bahan Baku','0','1','L',false);
$pdf->Ln(3);

$query1 = mysqli_query($con, "SELECT * FROM pembelian INNER JOIN supplier ON pembelian.ID_supplier = supplier.ID_supplier WHERE ID_faktur = '$ID_faktur'");
while($data1 = mysqli_fetch_array($query1)){
	$pdf->SetFont('Arial','',9);
	$pdf->Cell(0,5,'Supplier : '.$data1['nama_supplier'],'0','1','L',false);
	$pdf->Cell(0,5,'Alamat   : '.$data1['alamat_supplier'],'0','1','L',false);
	$pdf->Cell(0,5,'Telp       : '.$data1['telp_supplier'],'0','1','L',false);
	$pdf->Cell(0,5,'Email     : '.$data1['email_supplier'],'0','1','L',false);
	$pdf->Ln(1);
}

$query1 = mysqli_query($con, "SELECT * FROM pembelian WHERE ID_faktur = '$ID_faktur'");
while($data1 = mysqli_fetch_array($query1)){
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(0,5,'NO. Faktur : '.$data1['ID_faktur'],'0','1','R',false);
	$pdf->Cell(0,5,'Tanggal   : '.$data1['pb_date'],'0','1','R',false);
	$pdf->Ln(1);
}

$pdf->SetFont('Arial','B',8);
$pdf->Cell(10,6,'No',1,0,'C');
$pdf->Cell(45,6,'Bahan Baku',1,0,'C');
$pdf->Cell(45,6,'Status',1,0,'C');
$pdf->Cell(45,6,'Harga Satuan',1,0,'C');
$pdf->Cell(45,6,'Harga Total',1,0,'C');
$pdf->Ln(1);

$i = 0;
$harga_total = 0;
$query = mysqli_query($con, "SELECT * FROM pembelian INNER JOIN bahanbaku ON pembelian.ID_bahanbaku = bahanbaku.ID_bahanbaku WHERE pembelian.ID_faktur = '$ID_faktur'");
while($data = mysqli_fetch_array($query)){
	$i++;
	$pdf->Ln(5);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(10,5,$i,1,0,'L');
	$pdf->Cell(45,5,$data['deskripsi'],1,0,'L');
	$pdf->Cell(45,5,$data['pb_status'],1,0,'L');
	$pdf->Cell(45,5,$data['pb_jumlah'],1,0,'L');
	$pdf->Cell(45,5,$total = $data['harga']*$data['pb_jumlah'],1,0,'L');
}
	$harga_total += $total;
	$pdf->Ln(5);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(10,5,"",0,0,'L');
	$pdf->Cell(45,5,"",0,0,'L');
	$pdf->Cell(45,5,"",0,0,'L');
	$pdf->Cell(45,5,"TOTAL :  ",0,0,'R');
	$pdf->Cell(45,5,$harga_total,0,0,'L');

$pdf->Output("Detail_Faktur_Pembelian.pdf","I");

?>



















