<?php

require "connection.php";
require "./fpdf/fpdf.php";



if (is_logged_in() && isset($_POST['viewslip']) ) 
{

    $tclass=$_POST['tclass']; /** $tclass holds the name of the class to generate list**/


        class PDF extends FPDF
        {

            //customized header and footer
            function Header()
            {
                $tclass=$_POST['tclass'];
                // Logo
                $this->Image('./img/banner.png',10,6,30);
                // Arial bold 15
                $this->SetFont('Arial','B',15);
                // Move to the right
                $this->Cell(80);
                // Title
                $this->Cell(30,10,'Student List for '.$tclass,0,0,'C');
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
                $w = array(10,40, 18, 18, 18, 18, 20, 18, 18);
                for($i=0;$i<count($header);$i++)
                    $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
                $this->Ln();
                // Color and font restoration
                $this->SetFillColor(224,235,255);
                $this->SetTextColor(0);
                $this->SetFont('');
                // Data
                $fill = false;
                $tclass=$_POST['tclass'];

                $query = "SELECT * from `students` where `class`='$tclass' order by `name` asc";
                $result = mysqli_query(mysqli_connect("localhost","root","","skuli"), $query);
                $i=1;

                 while ($row=mysqli_fetch_array($result,MYSQLI_BOTH)) {
                    $this->Cell($w[0],6,$i.'.','LRT',0,'C',$fill);
                    $this->Cell($w[1],6,$row['name'],'LRT',0,'L',$fill);
                    $this->Cell($w[2],6,'','LRT',0,'R',$fill);    
                    $this->Cell($w[3],6,'','LRT',0,'R',$fill);   
                    $this->Cell($w[4],6,'','LRT',0,'R',$fill); 
                    $this->Cell($w[5],6,'','LRT',0,'R',$fill);   
                    $this->Cell($w[6],6,'','LRT',0,'R',$fill); 
                    $this->Cell($w[7],6,'','LRT',0,'R',$fill);    
                    $this->Ln();
                    $fill = !$fill;
                    $i++;
                     
                 }
                // Closing line
                 for($n=0;$n<8;$n++)
                 {
                    $this->Cell($w[$n],0,'','T');
                }

                
            }
        }


        $pdf = new PDF();
        // Column headings
        $header = array('S/N', 'Name','Math', 'English', 'Kiswahili', 'Science', 'S.Studies', 'Total');

        //creating the PDF
        $pdf->SetFont('Times','',10);
        $pdf->AddPage();


        //Center the page heading
        $pdf->SetFont('Courier','B',16);
        $pdf->Cell(80);
        $pdf->Cell(40,10,ucwords($tclass.' '.' class list'),0,0,'C');

        $pdf->SetFont('Times','',10);

        $pdf->FancyTable($header);


        $pdf->Output();
    
}
else
{
header("location:home.php");
}