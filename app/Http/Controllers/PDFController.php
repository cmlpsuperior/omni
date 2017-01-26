<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//my uses
use PDF;
use App\Order;
use App\ProForma;

class PDFController extends Controller
{
    public function order ($id){
    	$order = Order::findOrFail($id);
    	$debt =0;

    	if ($order->receivedAmount < $order->totalAmount) $debt = $order->totalAmount - $order->receivedAmount;
    	
    	$pdf = PDF::loadView('pdf.order', ['order'=>$order, 'debt' => $debt]);

    	return $pdf->setPaper([0,0,227,842])->stream($id.'pdf');
    }

    public function proForma ($id){
    	$proForma = ProForma::findOrFail($id);
    	
    	$pdf = PDF::loadView('pdf.proForma', ['proForma'=>$proForma ]);

    	return $pdf->setPaper([0,0,227,842])->stream($id.'pdf');
    }
}
