<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//my uses;:
use App\Sale;
use App\Zone;
use App\Item; //AJAX search
use DB;
use Illuminate\Contracts\Routing\ResponseFactory; //JSON
use Illuminate\Support\Facades\Auth; //to get the employee user

class SaleController extends Controller
{
    //step 1:
    public function zone (){
    	$zones = Zone::orderBy('name','asc')->get();

        return view('sale.step1_zone', ['zones'=>$zones]);
    }

    public function zone_process( Request $request ){
        $idZone = $request->get('idZone');

        session( [  'idZone' => $idZone ] ); //store temporally

        return redirect()->action('SaleController@items' );
    }

    public function items (){
        $idZone = session ('idZone');
        $zone = Zone::findOrFail($idZone);

        return view('sale.step1_items', [ 'zone'=>$zone ] );
    }

    public function items_process (request $request){
        $idItems= $request->get('idItems');
        $names = $request->get('names');
        $quantitys= $request->get('quantitys');
        $prices= $request->get('prices');
        $units= $request->get('units');
        $totalAmount= $request->get('totalAmount');

        session( [  'idItems' => $idItems,
                    'names' => $names,
                    'quantitys'=>$quantitys,
                    'prices'=>$prices,
                    'units'=>$units,
                    'totalAmount'=> $totalAmount ] ); //store temporally

        return redirect()->action('SaleController@amounts');
    }


    //Step 2:
    public function amounts (){
        $idZone = session ('idZone');

        $names = session ('names');
        $quantitys = session ('quantitys');
        $prices = session ('prices');
        $units = session ('units');
        $totalAmount = session ('totalAmount');

        $zone = Zone::findOrFail ( $idZone );

        return view ('sale.step2_Amounts', ['zone'=>$zone,

                                            'names'=>$names,
                                            'quantitys'=>$quantitys,
                                            'prices'=>$prices,
                                            'units'=>$units,
                                            'totalAmount'=>$totalAmount
                                            ]);
}

    public function amounts_process (Request $request){
        $discount = 0;
        $receivedAmount = $request->get('receivedAmount');

        if ( $request->has('discount') ) $discount = $request->get('discount');
        if ( $request->has('voucher') ) $voucher =  $request->get('voucher');

        session( [  'shippingAddress'=>$shippingAddress,                                            
                    'shippingDate'=>$shippingDate,
                    'receivedAmount'=> $receivedAmount,
                    'idBillType'=>$idBillType,
                    'voucher'=>$voucher ] ); //store temporally
        
        return redirect()->action('SaleController@client');
    }


    
}
