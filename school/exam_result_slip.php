<?php

require "connection.php";
require_once ('jpgraph/src/jpgraph.php');
require_once ('jpgraph/src/jpgraph_bar.php');
require "./fpdf/fpdf.php";


function separator1000($aVal) {
    return number_format($aVal);
}
 
function separator1000_usd($aVal) {
    return '$'.number_format($aVal);
}


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
    $this->Cell(30,10,'Exam Result Slip',0,0,'C');
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
    $this->Cell(0,10,'This system developed by Obed N. Paul (254-706-748162)');
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
}

// Colored table
function FancyTable()
{
    // Colors, line width and bold font
    $this->SetFillColor(0,255,127);
    $this->SetTextColor(0);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
    $this->SetFont('','B','11');
    // Header
    $w = array(32, 18, 18, 18, 18, 20, 18, 18, 18, 18);
    

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

    $num=mysqli_num_rows($result);//total number of students

     while ($row=mysqli_fetch_array($result,MYSQLI_BOTH)) {
        //find other details about the student from students table
        $st_upi=$row['upi'];
        $sq0="SELECT * from `students` where `upi`='$st_upi'";
        $rec=mysqli_fetch_array(mysqli_query(mysqli_connect("localhost","root","","skuli"),$sq0),MYSQLI_BOTH);

        $jina=$rec['name'];
        $st_class=$rec['class'];

        //center Student Name and Class
        $this->SetFont('Courier','B',12);
        $this->Cell(80); $this->Cell(40,10,ucwords("Exam Result Slip For ".$exam),0,0,'C'); 
        $this->Ln();

        //draw a line $this->Ln();
             for($n=0;$n<9;$n++)
             {
                $this->Cell($w[$n],0,'','T');
            }
        $this->Ln();

        //draw a section for the student details
        $this->SetFont('Times','BI',10);
        $this->Cell(80); $this->Cell(40,10,ucwords("Student Details"),0,0,'C'); 
        $this->Ln();

        $this->SetFont('Times','',10);
        $this->Cell(40,10, "Student Name: ",'',0,'R');
        $this->Cell(40,10,$jina,'',0,'C');
        $this->Ln();

        $this->Cell(40,10, "Class: ",'',0,'R');
        $this->Cell(40,10,$st_class,'',0,'C');
        $this->Ln();

        $this->Cell(40,10, "UPI: ",'',0,'R');
        $this->Cell(40,10,$st_upi,'',0,'C');
        $this->Ln();

        //draw a line
        for($n=0;$n<9;$n++)
             {
                $this->Cell($w[$n],0,'','T');
            }
        $this->Ln();

        //header for the exam results section
        $this->SetFont('Times','BI',10);
        $this->Cell(80); $this->Cell(40,10,ucwords("Exam Results"),0,0,'C'); 
        $this->Ln();
       
        //return font to default
        $this->SetFont('Times','',10);

        //list the student performance
        $this->Cell(40,6, "Mathematics: ",'',0,'R',$fill);
        $this->Cell(40,6,number_format($row['maths']),'',0,'C',$fill); 
        $this->Ln();

        $this->Cell(40,6, "English: ",'',0,'R',!$fill);
        $this->Cell(40,6,number_format($row['english']),'',0,'C',!$fill); 
        $this->Ln();

        $this->Cell(40,6, "Kiswahili: ",'',0,'R',$fill);
        $this->Cell(40,6,number_format($row['kiswahili']),'',0,'C',$fill); 
        $this->Ln();

        $this->Cell(40,6, "Science: ",'',0,'R',!$fill);
        $this->Cell(40,6,number_format($row['science']),'',0,'C',!$fill); 
        $this->Ln();

        $this->Cell(40,6, "Social Studies: ",'',0,'R',$fill);
        $this->Cell(40,6,number_format($row['socialStudies']),'',0,'C',$fill); 
        $this->Ln();
        
        //draw a line
        for($n=0;$n<9;$n++)
             {
                $this->Cell($w[$n],0,'','T');
            }
        $this->Ln();

        $this->Cell(40,6, "Total: ",'',0,'R',$fill);
        $this->Cell(20,6,number_format($row['totals']),'LRB',0,'L',$fill);

        $this->Cell(30,6, "Average: ",'',0,'R',$fill); 
        $this->Cell(30,6,$row['average'],'LRB',0,'L',$fill);

        $this->Cell(30,6, "Position: ",'',0,'R',$fill); 
        $this->Cell(20,6,$i." out of ".$num,'LRB',0,'L',$fill);

        //draw a line
        for($n=0;$n<9;$n++)
             {
                $this->Cell($w[$n],0,'','T');
            }
        $this->Ln();

        //The following code generates a bar graph

        //scores per subject
        $datay=array(number_format($row['maths']),number_format($row['english']),number_format($row['kiswahili']),number_format($row['science']),number_format($row['socialStudies']));
            $graph = new Graph(500,300,'auto');
            $graph->img->SetMargin(80,30,30,40);
            $graph->SetScale('textint');
            $graph->SetShadow();
            $graph->SetFrame(false); // No border around the graph
             
            $graph->yaxis->scale->SetGrace(50);
            $graph->yaxis->SetLabelFormatCallback('separator1000');
             
            // Setup X-axis labels
            $a = array('Math','Eng','Kis','Sci','S. Studies');
            $graph->xaxis->SetTickLabels($a);
            $graph->xaxis->SetFont(FF_FONT2);
             
            // Setup graph title ands fonts
            $graph->title->Set($jina.' Exam performance');
            $graph->title->SetFont(FF_FONT2,FS_BOLD);
            $graph->xaxis->title->Set('Subject');
            $graph->xaxis->title->SetFont(FF_FONT2,FS_BOLD);
             
            // Create a bar pot
            $bplot = new BarPlot($datay);
            $bplot->SetFillColor('orange');
            $bplot->SetWidth(0.5);
            $bplot->SetShadow();
             
            // Setup the values that are displayed on top of each bar
            $bplot->value->Show();
             
            // Must use TTF fonts if we want text at an arbitrary angle
            $bplot->value->SetFont(FF_ARIAL,FS_BOLD);
            $bplot->value->SetAngle(45);
            $bplot->value->SetFormatCallback('separator1000_usd');
             
            // Black color for positive values and darkred for negative values
            $bplot->value->SetColor('black','darkred');
            $graph->Add($bplot);
             
            // Finally stroke the graph
            //$graph->Stroke();
            //end of code for generating graph

        $this->addPage();
        $fill = !$fill;
        $i++;
         
     }

}

}

$pdf = new PDF();


//creating the PDF
$pdf->SetFont('Times','',10);
$pdf->AddPage();

$pdf->FancyTable();


$pdf->Output();
}
}
else
{
header("location:home.php");
}


?>