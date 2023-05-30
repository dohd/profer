<?php

namespace App\Http\Controllers\pdf;

use App\Http\Controllers\Controller;
use App\Models\agenda\Agenda;
use Illuminate\Http\Request;
use Mpdf\Mpdf;
use Mpdf\Output\Destination;

class PdfController extends Controller
{
    // Agenda PDF
    public function print_agenda (Request $request, Agenda $agenda) {
        //create PDF
        $mpdf = new Mpdf(config('pdf'));

        $header = trim($request->get('header', ''));
        $footer = trim($request->get('footer', ''));
        if (strlen($header)) $mpdf->SetHTMLHeader($header);
        if (strlen($footer)) $mpdf->SetHTMLFooter($footer);
            
        // write content
        $html = view('pdfs.print_agenda', compact('agenda'));
        return $html;
        $mpdf->WriteHTML($html);

        // Set some header informations for output
        // $header = [
        //     'Content-Type' => 'application/pdf',
        //     'Content-Disposition' => 'inline; filename="'.$documentFileName.'"'
        // ];

        //return the PDF for download
        return $mpdf->Output('print_agenda.pdf', Destination::DOWNLOAD);
    }
}
