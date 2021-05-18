<?php
require_once 'dompdf/autoload.inc.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;


  // instantiate and use the dompdf class
  $dompdf = new Dompdf();
 


  //to put other html file
  $html = file_get_contents('https://pms.healtopedia.com/po.php');
  $dompdf->setBasePath(realpath('assets/css/app.css'));

  $dompdf->loadHtml($html);

  // (Optional) Setup the paper size and orientation
  $dompdf->setPaper('A4','portrait');

  // Render the HTML as PDF
  $dompdf->render();

  // Output the generated PDF (1 = download and 0 = preview)
  $dompdf->stream("Purchase Order", array("Attachment"=>0));

?>