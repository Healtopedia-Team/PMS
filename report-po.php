<?php
require_once 'dompdf/autoload.inc.php';
$cur_date = $_GET['date'];

// reference the Dompdf namespace
use Dompdf\Dompdf;


  // instantiate and use the dompdf class
  $dompdf = new Dompdf();
 


  //to put other html file
  $html = file_get_contents('https://pms.healtopedia.com/po.php?cur_date='.$cur_date);
  $dompdf->setBasePath(realpath('report-style.css'));

  $dompdf->loadHtml($html);

  // (Optional) Setup the paper size and orientation
  $dompdf->setPaper('A4','portrait');

  // Render the HTML as PDF
  $dompdf->render();

  // Output the generated PDF (1 = download and 0 = preview)
  $dompdf->stream("Purchase Order", array("Attachment"=>0));

?>