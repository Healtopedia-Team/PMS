<?php
require_once 'dompdf/autoload.inc.php';
$cur_date = $_GET['cur_date'];
error_reporting(E_ALL);

// reference the Dompdf namespace
use Dompdf\Dompdf;

define('DOMPDF_ENABLE_PHP', true);

  // instantiate and use the dompdf class
  $dompdf = new Dompdf();
  //require_once 'https://pms.healtopedia.com/po.php?cur_date='. $cur_date ;
  //ob_start();
  //require('https://pms.healtopedia.com/po.php?cur_date=' . $cur_date);
  //$html = ob_get_contents();
  //ob_get_clean();

  //to put other html file
  /*
  $html = file_get_contents('https://pms.healtopedia.com/po.php?cur_date='.$cur_date);
  $dompdf->setBasePath(realpath('report-style.css'));

  $dompdf->loadHtml($html);

  // (Optional) Setup the paper size and orientation
  $dompdf->setPaper('A4','portrait');

  // Render the HTML as PDF
  $dompdf->render();

  // Output the generated PDF (1 = download and 0 = preview)
  $dompdf->stream("Purchase Order", array("Attachment"=>0));
*/
  ob_start();
  require 'https://pms.healtopedia.com/po.php?cur_date=' . $cur_date ;
  $dompdf->setBasePath(realpath('report-style.css'));
  $dompdf->setPaper('A4', 'portrait');
  $html = ob_get_clean();
  $dompdf->loadHtml($html);
  $dompdf->render();
  //$output = $dompdf->output();
  //file_put_contents('/files/report.pdf', $output);
  $dompdf->stream("Purchase Order", array("Attachment" => 0));


?>
