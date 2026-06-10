<?php // content="text/plain; charset=utf-8"
require_once ('jpgraph/src/jpgraph.php');
require_once ('jpgraph/src/jpgraph_bar.php');
 
function separator1000($aVal) {
    return number_format($aVal);
}
 
function separator1000_usd($aVal) {
    return '$'.number_format($aVal);
}
 
// Some data
$datay=array(60,56,70,66,78);
 
// Create the graph and setup the basic parameters
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
$graph->title->Set('Exam performance');
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
$graph->Stroke();
?>