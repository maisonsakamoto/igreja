<?
// include autoloader
require_once 'autoload.inc.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();

// carregar o html
$dompdf->loadHtml('<h1>hello world</h1>');

// definir o papel e a orientação
//$dompdf->setPaper('A4', 'landscape');
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();