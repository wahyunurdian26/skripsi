<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_tanahbaru");
require_once '../../pdf/fpdf.php';
$pdf = new FPDF('P', 'mm', 'Letter');
$pdf->AddPage();

$pdf->SetTitle('Cetak Laporan');
$pdf->Cell(35);
$pdf->Image('../../assets/img/krw.png', 25, 15, 25, 30);
$pdf->Cell(50);
$pdf->SetFont('Times', '', 17);
$pdf->Cell(30, 6, '', 0, 1, 'C');
$pdf->Cell(90);
$pdf->Cell(30, 6, 'PEMERINTAH KABUPATEN KARAWANG', 0, 1, 'C');
$pdf->SetFont('Times', '', 17);
$pdf->Cell(90);
$pdf->Cell(30, 7, 'DINAS PERTANIAN', 0, 1, 'C');

$pdf->SetFont('Times', '', 12);
$pdf->Cell(90);
$pdf->Cell(30, 7, '(BALAI PENYULUHAN PERTANIAN KEC.PAKISJAYA)', 0, 1, 'C');
$pdf->SetFont('Times', '', 10);
$pdf->Cell(90);
$pdf->Cell(30, 4, 'Telukbuyung, Kec. Pakisjaya, Karawang, Jawa Barat 41355, Indonesia', 0, 1, 'C');
$pdf->SetFont('Times', '', 10);
$pdf->Cell(90);
$pdf->Cell(30, 4, 'Email : aripkrn88@gmail.com', 0, 1, 'C');

$pdf->Cell(120);
$pdf->Cell(10);
$pdf->Cell(250, 80, '', 0, 0, '');

$pdf->Cell(30, 7, '', 0, 1, 'C');

$pdf->SetLineWidth(1);
$pdf->Line(25, 47, 195, 47);
$pdf->SetLineWidth(0);
$pdf->Line(25, 48, 195, 48);

$pdf->Cell(10, 40, '', 0, 1, 'C');
$pdf->SetY(47);
$pdf->SetX(24);

$pdf->SetFont('Times', 'B', 17);
$pdf->Cell(30, 0, '', 0, 1, 'C');
$pdf->Cell(90);
$pdf->Cell(30, 20, 'Varietas Padi', 0, 1, 'C');

$pdf->Ln();

$pdf->Cell(10, 40, '', 0, 1, 'C');
$pdf->SetY(65);
$pdf->SetX(30);
$pdf->SetFont('Times', 'B', 11);
$pdf->Cell(10, 6, 'No', 1, 0, 'C');
$pdf->Cell(20, 6, 'Kode', 1, 0, 'C');
$pdf->Cell(90, 6, 'Nama Varietas Padi', 1, 0, 'C');
$pdf->Cell(20, 6, 'Nilai', 1, 0, 'C');
$pdf->Cell(20, 6, 'Ranking', 1, 0, 'C');
// $this->koneksi = new Database();
// $this->koneksi->BukaDB();
$time = date('F j, Y | H:i:s');
$qlihat = mysqli_query($koneksi, "SELECT *FROM hasil INNER JOIN alternatif ON hasil.id_alternatif = alternatif.id_alternatif ORDER by hasil DESC");
//$data = mysqli_fetch_array($qlihat);
//$num=mysqli_num_rows($qlihat)+1;
$no = 1;
while ($data = mysqli_fetch_array($qlihat)) {

    $pdf->Ln();
    $pdf->SetX(30);
    $pdf->SetFont('Times', '', 11);
    $pdf->Cell(10, 6, $no, 1, 0, 'C');
    $pdf->Cell(20, 6, $data['id_alternatif'], 1, 0, 'C');
    $pdf->Cell(90, 6, $data['nama_alternatif'], 1, 0, '');
    $pdf->Cell(20, 6, "" . number_format($data['hasil'], 3, ".", ".") . "", 1, 0, 'C');
    $pdf->Cell(20, 6, $no, 1, 0, 'C');
    $no++;
}



$pdf->Ln();
$pdf->SetFont('Times', 'B', 17);
$pdf->Cell(210, 14, 'Hasil Keputusan', 0, 1, 'C');
$pdf->Cell(10, 40, '', 0, 1, 'C');
$pdf->SetY(175);
$pdf->SetX(30);
$pdf->SetFont('Times', 'B', 11);
$pdf->Cell(10, 6, 'No', 1, 0, 'C');
$pdf->Cell(20, 6, 'Kode', 1, 0, 'C');
$pdf->Cell(50, 6, 'Nama Varietas Padi', 1, 0, 'C');
$pdf->Cell(20, 6, 'Nilai', 1, 0, 'C');
$pdf->Cell(20, 6, 'Ranking', 1, 0, 'C');
$pdf->Cell(40, 6, 'Keterangan', 1, 0, 'C');
// $this->koneksi = new Database();
// $this->koneksi->BukaDB();
$time = date('F j, Y | H:i:s');
$lihat1 = mysqli_query($koneksi, "SELECT *FROM hasil INNER JOIN alternatif ON hasil.id_alternatif = alternatif.id_alternatif ORDER by hasil DESC LIMIT 0,3");
//$data = mysqli_fetch_array($qlihat);
//$num=mysqli_num_rows($qlihat)+1;
$no = 1;
while ($data1 = mysqli_fetch_array($lihat1)) {

    $pdf->Ln();
    $pdf->SetX(30);
    $pdf->SetFont('Times', '', 11);
    $pdf->Cell(10, 6, $no, 1, 0, 'C');
    $pdf->Cell(20, 6, $data1['id_alternatif'], 1, 0, 'C');
    $pdf->Cell(50, 6, $data1['nama_alternatif'], 1, 0, '');
    $pdf->Cell(20, 6, "" . number_format($data1['hasil'], 3, ".", ".") . "", 1, 0, 'C');
    $pdf->Cell(20, 6, $no, 1, 0, 'C');
    $pdf->SetFont('Times', 'I', 11);
    $pdf->Cell(40, 6, 'Rekomendasi', 1, 0, 'C');
    $no++;
}



ob_end_clean();
$pdf->Output();
