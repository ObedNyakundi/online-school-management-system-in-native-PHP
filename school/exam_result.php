<?php

require "connection.php";
require "./fpdf/fpdf.php";



if (is_logged_in()) {

if (isset($_GET['exam'])) {


class PDF extends FPDF
{
//customized header and footer
function Header()
{
    // Logo
    $this->Image('./img/banner.png',10,6,30);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(30,10,'Exam Results',0,0,'C');
    // Line break
    $this->Ln(20);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    $this->Cell(0,10,'This system was developed by Obed N. Paul (254-706-748162)');
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
}

// Colored table
function FancyTable($header)
{
    // Colors, line width and bold font
    $this->SetFillColor(0,255,127);
    $this->SetTextColor(0);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
    $this->SetFont('','B','11');
    // Header
    $this->Ln();
    $w = array(32, 18, 18, 18, 18, 20, 18, 18, 18, 18);
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
    $this->Ln();
    // Color and font restoration
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
    // Data
    $fill = false;

     $exam=$_GET['exam'];
     $stclass=$_GET['stclass'];

    $query = "SELECT * FROM `exam` where `label`='$exam' and `upi` in (select `upi`from `students` where `class`='$stclass') order by `totals` desc";
    $result = mysqli_query(mysqli_connect("localhost","root","","skuli"), $query);
    $i=1; //counter for ranking
    $math=0;
    $eng=0;
    $kis=0;
    $sci=0;
    $ss=0;
    $mss=0;

     while ($row=mysqli_fetch_array($result,MYSQLI_BOTH)) {
        $this->Cell($w[0],6,$row['name'],'LR',0,'L',$fill);
        $this->Cell($w[1],6,number_format($row['maths']),'LR',0,'R',$fill);     $math+=$row['maths'];
        $this->Cell($w[2],6,number_format($row['english']),'LR',0,'R',$fill);   $eng+=$row['english'];
        $this->Cell($w[3],6,number_format($row['kiswahili']),'LR',0,'R',$fill); $kis+=$row['kiswahili'];
        $this->Cell($w[4],6,number_format($row['science']),'LR',0,'R',$fill);   $sci+=$row['science'];
        $this->Cell($w[5],6,number_format($row['socialStudies']),'LR',0,'R',$fill); $ss+=$row['socialStudies'];
        $this->Cell($w[6],6,number_format($row['totals']),'LR',0,'R',$fill);    $mss+=$row['totals'];
        $this->Cell($w[7],6,number_format($row['average']),'LR',0,'R',$fill);
        $this->Cell($w[8],6,number_format($i),'LR',0,'R',$fill);
        $this->Ln();
        $fill = !$fill;
        $i++;
         
     }
    // Closing line
     for($n=0;$n<9;$n++)
     {
        $this->Cell($w[$n],0,'','T');
    }

    //skipt 2 lines
    $this->Ln(); $this->Ln();

    $i-=1; //the total number of students
    $this->SetFont('','B','11');
        
        //add a row for Totals
        $this->Cell($w[0],6,"Total.",'LR',0,'R',$fill);
        $this->Cell($w[1],6,number_format($math),'LR',0,'R',$fill);
        $this->Cell($w[2],6,number_format($eng),'LR',0,'R',$fill);  
        $this->Cell($w[3],6,number_format($kis),'LR',0,'R',$fill); 
        $this->Cell($w[4],6,number_format($sci),'LR',0,'R',$fill);  
        $this->Cell($w[5],6,number_format($ss),'LR',0,'R',$fill);
        $this->Cell($w[6],6,number_format($mss),'LR',0,'R',$fill); 
        $this->Cell($w[7],6," ",'LR',0,'R',$fill);
        $this->Cell($w[8],6," ",'LR',0,'R',$fill);
        $this->Ln(); $fill=!$fill;

        //add a row for MSS
        $this->Cell($w[0],6,"MSS.",'LR',0,'R',$fill);
        $this->Cell($w[1],6,number_format($math/$i),'LR',0,'R',$fill);
        $this->Cell($w[2],6,number_format($eng/$i),'LR',0,'R',$fill);  
        $this->Cell($w[3],6,number_format($kis/$i),'LR',0,'R',$fill); 
        $this->Cell($w[4],6,number_format($sci/$i),'LR',0,'R',$fill);  
        $this->Cell($w[5],6,number_format($ss/$i),'LR',0,'R',$fill);
        $this->Cell($w[6],6,number_format($mss/$i),'LR',0,'R',$fill); 
        $this->Cell($w[7],6," ",'LR',0,'R',$fill);
        $this->Cell($w[8],6," ",'LR',0,'R',$fill);

        $this->Ln();
        // Closing line
     for($n=0;$n<9;$n++)
     {
        $this->Cell($w[$n],0,'','T');
    }
        //$this->Cell(array_sum($w),0,'','T');
}

}

$pdf = new PDF();
// Column headings
$header = array('Name','Math', 'English', 'Kiswahili', 'Science', 'S.Studies', 'Total','Average', 'Rank');

//creating the PDF
$pdf->SetFont('Times','',10);
$pdf->AddPage();

$exam=$_GET['exam'];
$stclass=$_GET['stclass'];

//Center the page heading
$pdf->SetFont('Courier','B',16);
$pdf->Cell(80);
$pdf->Cell(40,10,ucwords($stclass.' '.$exam),0,0,'C');

$pdf->SetFont('Times','',10);

$pdf->FancyTable($header);


$pdf->Output();
}
}
else
{
header("location:home.php");
}


?>