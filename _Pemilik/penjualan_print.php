<?php

//PRINT HALAMAN SUPPLIER
include "../laporan/fpdf.php";
include "model/koneksi.php";
include "model/class_produk.php";
$db = new produk();

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
$pdf->Cell(50,5,'Laporan Data Penjualan','0','1','L',false);
$pdf->Ln(1);

$tanggal = $_GET['tanggal'];
$tgl_awal = substr($tanggal, 0, 10);
$tgl_akhir = substr($tanggal, 10, 20);
$awal = date('d-m-Y', strtotime($tgl_awal)); 
$akhir = date('d-m-Y', strtotime($tgl_akhir)); 
//echo $tanggal; echo "<br>";
//echo $tgl_awal; echo "<br>";
//echo $tgl_akhir;

$pdf->SetFont('Arial','B',7);
$pdf->Cell(50,5,'*berdasarkan catatan produksi dari '.$awal.' sampai '.$akhir,'0','1','L',false);
$pdf->Ln(3);

$pdf->SetFont('Arial','B',8);
$pdf->Cell(33,6,'Kode Penjualan',1,0,'C');
$pdf->Cell(33,6,'Produk',1,0,'C');
$pdf->Cell(33,6,'Tanggal',1,0,'C');
$pdf->Cell(33,6,'Total Terjual (pcs)',1,0,'C');
$pdf->Cell(33,6,'Pendapatan',1,0,'C');
$pdf->Ln(1);

$query = mysqli_query($con, "SELECT * FROM penjualan WHERE pj_laporan BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."'");
while($data = mysqli_fetch_array($query)){
	$pdf->Ln(5);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(33,5,$data['ID_penjualan'],1,0,'L');
	$pdf->Cell(33,5,$db->tampil_nama_produk($data['ID_produk']),1,0,'L');
	$pdf->Cell(33,5,$data['pj_date'],1,0,'L');
	$pdf->Cell(33,5,$data['pj_jumlah'],1,0,'L');
	$pdf->Cell(33,5,"Rp. ".$data['pj_harga'],1,0,'L');
}

$pdf->Output("Penjualan.pdf","I");

?>



















