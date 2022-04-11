<?php
include 'Controller/koneksi.php';
require('../laporan/fpdf.php');

$pdf = new FPDF("L","cm","A4");

$pdf->SetMargins(2,1,1);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',11);

$pdf->SetX(4);            
$pdf->MultiCell(19.5,0.5,'PRIMA SARI',0,'L');
$pdf->SetX(4);
$pdf->MultiCell(19.5,0.5,'Telpon : 0038XXXXXXX',0,'L');    
$pdf->SetFont('Arial','B',10);
$pdf->SetX(4);
$pdf->MultiCell(19.5,0.5,'JL. Limbungan',0,'L');
$pdf->SetX(4);

$pdf->Line(1,3.1,28.5,3.1);
$pdf->SetLineWidth(0.1);      
$pdf->Line(1,3.2,28.5,3.2);   
$pdf->SetLineWidth(0);
$pdf->ln(1);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(25.5,0.7,"Laporan Penjualan",0,10,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,0.7,"Di cetak pada : ".date("D-d/m/Y"),0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(1, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(7, 0.8, 'Kode Penjualan', 1, 0, 'C');
$pdf->Cell(7, 0.8, 'Nama Produk', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Terjual', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Tanggal', 1, 1, 'C');
$pdf->SetFont('Arial','',10);
$no=1;
$query=mysqli_query($con, "select * from penjualan");
while($lihat=mysqli_fetch_array($query)){
	$pdf->Cell(1, 0.8, $no , 1, 0, 'C');
	$pdf->Cell(7, 0.8, $lihat['kode_penjualan'],1, 0, 'C');
	$pdf->Cell(7, 0.8, $lihat['nama_produk'],1, 0, 'C');
	$pdf->Cell(3, 0.8, $lihat['jumlah_penjualan'], 1, 0,'C');
	$pdf->Cell(2, 0.8, $lihat['date'], 1, 1,'C');

	$no++;
}

$pdf->Output("laporan_buku.pdf","I");

?>

