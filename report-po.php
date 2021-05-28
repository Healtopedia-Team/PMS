<?php
require_once 'dompdf/autoload.inc.php';
$cur_date = '';
$cur_date = $_GET['cur_date'];
//error_reporting(E_ALL);
//header("X-Accel-Buffering: no");

// reference the Dompdf namespace
ini_set("memory_limit", "1000M");
ini_set("max_execution_time", "900");


use Dompdf\Dompdf;

define('DOMPDF_ENABLE_PHP', true);
ob_start();
include_once 'po.php';
$html = ob_get_contents();
//var_dump($html);
ob_end_clean();

// instantiate and use the dompdf class
//$dompdf = new Dompdf();
$dompdf = new Dompdf();
//require_once 'https://pms.healtopedia.com/po.php?cur_date='. $cur_date ;
//print ob_get_level();
//to put other html file
//$html = file_get_contents('https://pms.healtopedia.com/po.php?cur_date='.$cur_date);
$dompdf->setBasePath(realpath('report-style.css'));

$html = preg_replace('/>\s+</', '><', $html);

//$dompdf->loadHtmlFile('https://pms.healtopedia.com/po.php?cur_date=' . $cur_date);
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4','portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF (1 = download and 0 = preview)
$dompdf->stream("Purchase Order", array("Attachment"=>0));
/*
ob_start();
include 'https://pms.healtopedia.com/po.php?cur_date=' . $cur_date ;
$dompdf->setBasePath(realpath('report-style.css'));
$dompdf->setPaper('A4', 'portrait');
$options = new \Dompdf\Options();
$options->setIsPhpEnabled(true);
$dompdf = new Dompdf($options);
$html = ob_get_clean();
ob_end_clean();
$dompdf->loadHtml($html);
$dompdf->render();
//$output = $dompdf->output();
//file_put_contents('/files/report.pdf', $output);
//$dompdf->stream("Purchase Order", array("Attachment" => 0));

*/
