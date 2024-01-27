<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\PDF as PDF;
use Illuminate\Http\Request;

class StrukController extends Controller
{
    public function generatePDF()
    {
        $data = [
            'title' => 'ini pdf'
        ];

        $pdf = app('dompdf.wrapper')->loadView('test_pdf', $data);

        return $pdf->download('test_pdf.pdf');
    }
}
