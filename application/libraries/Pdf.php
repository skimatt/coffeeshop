<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH . 'third_party/dompdf/autoload.inc.php');

use Dompdf\Dompdf;

class Pdf
{
    public $dompdf;

    public function __construct()
    {
        $this->dompdf = new Dompdf();
    }

    public function loadHtml($html)
    {
        $this->dompdf->loadHtml($html);
    }

    public function setPaper($size = 'A4', $orientation = 'portrait')
    {
        $this->dompdf->setPaper($size, $orientation);
    }

    public function render()
    {
        $this->dompdf->render();
    }

    public function stream($filename = "document.pdf", $options = array())
    {
        $this->dompdf->stream($filename, $options);
    }

    // ✅ Tambahkan fungsi ini:
    public function createPDF($html, $filename = '', $download = true, $paper = 'A4', $orientation = 'portrait')
    {
        $this->loadHtml($html);
        $this->setPaper($paper, $orientation);
        $this->render();
        $this->stream($filename . ".pdf", array("Attachment" => $download));
    }
}
