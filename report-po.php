<?php
require_once 'dompdf/autoload.inc.php';
$cur_date = $_GET['cur_date'];

// reference the Dompdf namespace
use Dompdf\Dompdf;

define('DOMPDF_ENABLE_PHP', true);

  // instantiate and use the dompdf class
  $dompdf = new Dompdf();
  ob_start();
  require_once 'https://pms.healtopedia.com/po.php?cur_date=' . $cur_date;
  $contents = ob_get_clean();


  //to put other html file
  $html = file_get_contents('https://pms.healtopedia.com/po.php?cur_date='.$cur_date);
  $dompdf->setBasePath(realpath('report-style.css'));

  $dompdf->loadHtml($contents);

  // (Optional) Setup the paper size and orientation
  $dompdf->setPaper('A4','portrait');

  // Render the HTML as PDF
  $dompdf->render();

  // Output the generated PDF (1 = download and 0 = preview)
  $dompdf->stream("Purchase Order", array("Attachment"=>0));

?>
