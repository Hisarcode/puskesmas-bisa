<?php
class MYPDF extends TCPDF
{

    //Page header
    public function Header()
    {
        // Logo
        $image_file = K_PATH_IMAGES . 'puskesmas.png';
        $this->Image($image_file, 15, 10, 15, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 15);
        // Title
        $this->Cell(0, 0, "PUSKESMAS PURNAMA", 0, 1, 'C', 0, '', 0);
        $this->Cell(0, 0, "   PEMERINTAH KOTA PONTIANAK", 0, 1, 'C', 0, '', 0);
        $this->Cell(0, 0, "    KECAMATAN PONTIANAK SELATAN", 0, 1, 'C', 0, '', 0);
        $this->SetFont('helvetica', '', 10);
        $this->Cell(0, 0, 'Jalan Kesehatan No 1', 0, 1, 'C', 0, '', 1);
        $this->writeHTML("<hr>", true, false, false, false, '');
    }
}


$director = APPPATH . '/assets/';
// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Puskesmas Bisa');
$pdf->SetTitle('Puskesmas Purnama');
$pdf->SetSubject('Surat Rujukan');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// -------------------------------------------------------------------

// add a page
$pdf->AddPage();

// set JPEG quality
$pdf->setJPEGQuality(75);

// Image method signature:
// Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
$pdf->Ln(10);
$pdf->SetFont('helvetica', 'BU', 13);
$pdf->Cell(0, 0, "Surat Rujukan", 0, 1, 'C', 0, '', 0);
$pdf->SetFont('helvetica', '', 13);
$pdf->Cell(0, 0, $suratrujukan['nomor_surat'], 0, 1, 'C', 0, '', 1);

$pdf->Ln(10);
$pdf->Cell(45, 0, 'Kepada Yang Terhormat', 0, 1, 'C', 0, '', 4);
$pdf->Cell(45, 0, $suratrujukan['tujuan'], 0, 1, 'C', 0, '', 4);

$pdf->Ln(10);
$pdf->Cell(0, 0, 'Dengan hormat,', 0, 1, 'L', 0, '', 0);
$pdf->Cell(0, 0, 'Mohon perawatan lebih lanjut pasien tersebut dibawah ini,', 0, 1, 'L', 0, '', 0);

$pdf->Ln(15);
$html = '<table style="margin-left:auto;margin-right:auto;">
<tr >
<td style="width:10%"></td>
<td><strong>NAMA</strong></td>
<td colspan="2">' . $suratrujukan['nama'] . '</td>
</tr>
<tr>
<td style="width:10%"></td>
<td><strong>Umur</strong></td>
<td>' . $umur_pasien . '</td>
<td></td>
</tr>
<tr>
<td style="width:10%"></td>
<td><strong>NIK</strong></td>
<td>' . $suratrujukan['nik'] . '</td>
<td></td>
</tr>
<tr>
<td style="width:10%"></td>
<td><strong>KETERANGAN</strong></td>
<td colspan="2">' . $suratrujukan['keterangan'] . '</td>
</tr>
</table>';
$pdf->writeHTML($html, true, false, true, false, '');

$pdf->Cell(0, 0, 'Demikian rujukan ini kami kirim, atas perhatiannya diucapkan terimakasih', 0, 1, 'L', 0, '', 0);

$pdf->Ln(15);
$pdf->Cell(60, 0, 'Pontianak , ' . $suratrujukan['date_created'], 0, 1, 'C', 0, '', 0);
$pdf->Cell(60, 0, 'YANG MERUJUK', 0, 1, 'C', 0, '', 0);
$pdf->Ln(30);

$pdf->SetFont('helvetica', 'BU', 13);
$pdf->Cell(60, 0, $nama_dokter, 0, 1, 'C', 0, '', 4);




//Close and output PDF document
$pdf->Output('example_009a.pdf', 'I');
