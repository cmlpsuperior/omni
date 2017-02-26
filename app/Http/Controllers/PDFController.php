<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//my uses
use PDF;
use App\Sale;
use App\ProForma;

class PDFController extends Controller
{

    public function printSale ($idSale){
        $sale = Sale::findOrFail($idSale);
        $pdf = PDF::loadView('pdf.electronicSale', ['sale'=>$sale ]);
        return $pdf->setPaper([0,0,227,842])->stream($idSale.'pdf');
    }

    public function printProForma ($idProForma){
        $proForma = ProForma::findOrFail($idProForma);
        $pdf = PDF::loadView('pdf.electronicProForma', ['proForma'=>$proForma ]);
        return $pdf->setPaper([0,0,227,842])->stream($idProForma.'pdf');
    }
}
