<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//my uses;:
use App\Sale;
use App\Zone;
use App\BankAccount;
use App\PaymentType;
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
        $charge = $request->get('charge');

        if ( $request->has('discount') ) $discount = $request->get('discount');

        session( [  'discount' => $discount,
                    'charge' => $charge
                 ] ); //store temporally
        
        return redirect()->action('SaleController@payment');
    }

    //step 3:
    public function payment (){
        $idZone = session ('idZone'); //step1.1

        $names = session ('names'); //step1.2
        $quantitys = session ('quantitys');
        $prices = session ('prices');
        $units = session ('units');
        $totalAmount = session ('totalAmount');

        $discount = session ('discount'); //step 2
        $charge = session ('charge');

        $zone = Zone::findOrFail ( $idZone );
        $bankAccounts = BankAccount::all();
        $paymentTypes = PaymentType::all();

        return view ('sale.step3_payment', ['zone'=>$zone,

                                            'names'=>$names,
                                            'quantitys'=>$quantitys,
                                            'prices'=>$prices,
                                            'units'=>$units,
                                            'totalAmount'=>$totalAmount,

                                            'discount'=>$discount,
                                            'charge'=>$charge,

                                            'bankAccounts'=>$bankAccounts,
                                            'paymentTypes'=> $paymentTypes
                                            ]);
    }

    public function payment_process (Request $request){
        $idPaymentType = $request->get('idPaymentType');
        $idBankAccount = null;
        $receivedAmount = $request->get('receivedAmount');;

        if ( $request->has('idBankAccount') ) $idBankAccount = $request->get('idBankAccount');

        session( [  'idPaymentType' => $idPaymentType,
                    'idBankAccount' => $idBankAccount,
                    'receivedAmount' => $receivedAmount
                 ] ); //store temporally
        
        return redirect()->action('SaleController@client');
    }


    //step 4:
    public function client (){
        $idZone = session ('idZone'); //step1.1

        $names = session ('names'); //step1.2
        $quantitys = session ('quantitys');
        $prices = session ('prices');
        $units = session ('units');
        $totalAmount = session ('totalAmount');

        $discount = session ('discount'); //step 2
        $charge = session ('charge');

        $idPaymentType = session('idPaymentType'); //step 3
        $idBankAccount = session('idBankAccount');
        $receivedAmount = session('receivedAmount');

        $zone = Zone::findOrFail($idZone);
        $paymentType = PaymentType::findOrFail($idPaymentType);

        $bankAccount = null;
        if ($idBankAccount != null)
            $bankAccount = BankAccount::findOrFail($idBankAccount);        

        return view ('sale.step4_client', [ 'zone'=>$zone,

                                            'names'=>$names,
                                            'quantitys'=>$quantitys,
                                            'prices'=>$prices,
                                            'units'=>$units,
                                            'totalAmount'=>$totalAmount,

                                            'discount'=>$discount,
                                            'charge'=>$charge,

                                            'paymentType'=>$paymentType,
                                            'bankAccount'=>$bankAccount,
                                            'receivedAmount'=>$receivedAmount
                                            ]);
    }

    public function client_process (Request $request){
        $idPaymentType = $request->get('idPaymentType');
        $idBankAccount = null;
        $receivedAmount = $request->get('receivedAmount');;

        if ( $request->has('idBankAccount') ) $idBankAccount = $request->get('idBankAccount');

        session( [  'idPaymentType' => $idPaymentType,
                    'idBankAccount' => $idBankAccount,
                    'receivedAmount' => $receivedAmount
                 ] ); //store temporally
        
        return redirect()->action('SaleController@client');
    }


    
}
