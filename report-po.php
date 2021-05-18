<?php
require_once 'dompdf/autoload.inc.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;


  // instantiate and use the dompdf class
  $dompdf = new Dompdf();
 


  //to put other html file
  $html = file_get_contents('https://pms.healtopedia.com/po.php');
  $html .= '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous"/>';


  $dompdf->loadHtml($html);

  // (Optional) Setup the paper size and orientation
  $dompdf->setPaper('A4','portrait');

  // Render the HTML as PDF
  $dompdf->render();

  // Output the generated PDF (1 = download and 0 = preview)
  $dompdf->stream("Purchase Order", array("Attachment"=>0));

?>