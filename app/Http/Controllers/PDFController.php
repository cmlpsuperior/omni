<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//my uses
use PDF;
use App\Bill;
use App\ProForma;

class PDFController extends Controller
{
    public function printBill ($idBill){
        $bill = Bill::findOrFail($idBill);
        $pdf = PDF::loadView('pdf.electronicBill', ['bill'=>$bill ]);
        return $pdf->setPaper([0,0,227,842])->stream($idBill.'pdf');
    }
}
