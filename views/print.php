<?php
	require("../tcpdf/tcpdf.php"); 
    require("../controllers/connection.php");

    $image1 = "../images/medical.png";
    $image2 = "../images/rx.png";
    $name = $_POST['name'];
    $date = $_POST['date'];
    $description = $_POST['description'];
class PDF extends TCPDF {

	//Page Header
	public function Header(){
	
	}

	public function Footer(){
		
		}


}

$pdf = new PDF('p', 'mm', 'LEGAL');

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Medical Certificate');
$pdf->SetTitle('Medical Certificate');
$pdf->SetSubject('');
$pdf->SetKeywords('');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

$pdf->AddPage();




 
    
    $pdf->Image($image1, 40, $pdf->GetY(), 33.78);
    $pdf->SetFont('helvetica', 'B', 22);
    $pdf->Cell(190,30,'Medical Certificate',0,0,'C');
    $pdf->Image($image1, 150, $pdf->GetY(), 33.78);
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Ln(30);
    $pdf->Cell(35,0,'Name: ' . $name ,0,0,'C');
    $pdf->Cell(160,0,'Date: ' . $date,0,1,'C');
    $pdf->Image($image2, 24, $pdf->GetY() + 10, 33.78);

    // $pdf->SetFont('helvetica', 'B', 12);
    // $pdf->Cell(15,0,'',0);
    // $pdf->Cell(20,0,'School ID:',0);
    // $pdf->Cell(10,0);
    // $pdf->Cell(35,0,'303139',1,0,'C');
    // $pdf->Ln(10);

    // $pdf->Cell(10,0,'',0);
    // $pdf->Cell(30,0,'School Name:',0);
    // $pdf->Cell(5,0);
    // $pdf->Cell(80,0,'LAHUG NIGHT HIGHSCHOOL',1,0,'C');

 
    // $pdf->SetFont('times','',12);
    // $pdf->Cell(160,$pdf->GetY() + 40,$description,0,1,'C');

  $pdf->Ln(70);
    $html1 = '';

    $html1 .= '
 
 <table  cellpadding="0" cellspacing="0"> 
  <tbody>
 ';
 
 
 $html1 .='
  <tr>
   <td width="500" height="100" align="justify">'.$description.'</td>
  </tr>
  ';
 
 
 $html1 .='
  </tbody>
 </table>
 ';
 
 $pdf->writeHTML($html1);
 
 $pdf->Ln(10);
   

   $html = '';

   $html .= '
<!-- EXAMPLE OF CSS STYLE -->

<style>

.first{
    text-align:center;
  }

.second{
    text-align:center;
  }


  .third{
    background-color:blue;
    color:white;
    text-align:center;
  }

  .fourth{
    background-color:red;
    text-align:center;
  }

  .fifth{
    background-color:yellow;
    text-align:center;
  }


</style>

';

$html .='
  ';


$pdf->writeHTML($html);




// $pdf->Output('Report-'.$investor_code.'.pdf', 'I');
$pdf->Output('Report.pdf', 'I');
?>
