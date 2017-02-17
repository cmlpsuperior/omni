<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//my uses
use PDF;
use App\Sale;

class PDFController extends Controller
{

    public function printSale ($idSale){
        $sale = Sale::findOrFail($idSale);
        $pdf = PDF::loadView('pdf.electronicSale', ['sale'=>$sale ]);
        return $pdf->setPaper([0,0,227,842])->stream($idSale.'pdf');
    }
}
