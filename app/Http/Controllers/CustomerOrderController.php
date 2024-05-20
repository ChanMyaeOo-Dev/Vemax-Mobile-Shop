<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\PDF;

class HomeController extends Controller
{
    public function generatePDF()
    {

        $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y'),
            'users' => ""
        ];

        $pdf = PDF::loadView('myPDF', $data);

        return $pdf->download('itsolutionstuff.pdf');
    }
}
