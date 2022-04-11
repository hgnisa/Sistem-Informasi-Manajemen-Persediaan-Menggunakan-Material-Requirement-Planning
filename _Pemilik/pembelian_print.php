<?php
ob_start();
include "../laporan/fpdf.php";
include "model/koneksi.php";

$ID = $_GET['ID'];
//substr tanggal
$tgl_awal = substr($ID, 0, 10);
$tgl_akhir = substr($ID, 10, 10);

//ambil supplier
$ambil_supplier = strpos($ID, "SUP"); 
if($ambil_supplier == NULL){
	$supplier = '';
}
else{
	$supplier = substr($ID, $ambil_supplier, 7);
}

//ambil bahanbaku
$ambil_bahanbaku = strpos($ID, "A");  
if($ambil_bahanbaku == NULL){
	$bahanbaku = '';
}
else{
	$bahanbaku = substr($ID, $ambil_bahanbaku, 5);
}

//ambil status menunggu
$status='';
$ambil_menunggu = strpos($ID, "Menunggu");
$ambil_tiba = strpos($ID, "Tiba");
if($ambil_menunggu != 0){
	$status = 'Menunggu';
}
if($ambil_tiba != 0){
	$status = 'Tiba';
}

//Filtering
$bd_sup='';
if($supplier!=''){
$bd_sup= "AND pembelian.ID_supplier='".$supplier."'";
}
					
$bd_bb='';
if($bahanbaku!=''){
$bd_bb = "AND pembelian.ID_bahanbaku='".$bahanbaku."'";
}
					
$bd_status='';
if($status!=''){
$bd_status = "AND pembelian.pb_status='".$status."'";
}
					
$bd_tgl = '';
if($tgl_akhir!=null && $tgl_akhir!=null){
$bd_tgl = "AND pembelian.pb_laporan BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."'";
}

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
$pdf->Cell(50,5,'Laporan Data Pembelian Bahan Baku','0','1','L',false);
$pdf->Ln(1);


//$pdf->SetFont('Arial','B',7);
//$pdf->Cell(50,5,'*berdasarkan catatan produksi dari '.$awal.' sampai '.$akhir,'0','1','L',false);
//$pdf->Ln(3);

$pdf->SetFont('Arial','B',8);
$pdf->Cell(35,6,'No Faktur',1,0,'C');
$pdf->Cell(30,6,'Supplier',1,0,'C');
$pdf->Cell(30,6,'Bahan Baku',1,0,'C');
$pdf->Cell(30,6,'Tanggal Pesan',1,0,'C');
$pdf->Cell(30,6,'Jumlah',1,0,'C');
$pdf->Cell(30,6,'Status',1,0,'C');
$pdf->Ln(1);

$query = mysqli_query($con, "SELECT * FROM pembelian INNER JOIN supplier ON pembelian.ID_supplier = supplier.ID_supplier INNER JOIN bahanbaku ON pembelian.ID_bahanbaku = bahanbaku.ID_bahanbaku WHERE pembelian.ID_faktur = pembelian.ID_faktur ".$bd_sup." ".$bd_bb." ".$bd_tgl." ".$bd_status."");
while($data = mysqli_fetch_array($query)){
	$pdf->Ln(5);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(35,5,$data['ID_faktur'],1,0,'L');
	$pdf->Cell(30,5,$data['ID_supplier'],1,0,'L');
	$pdf->Cell(30,5,$data['ID_bahanbaku'],1,0,'L');
	$pdf->Cell(30,5,$data['pb_date'],1,0,'L');
	$pdf->Cell(30,5,$data['pb_jumlah'],1,0,'L');
	$pdf->Cell(30,5,$data['pb_status'],1,0,'L');
}

$pdf->Output("Pembelian.pdf","I");

?>



















