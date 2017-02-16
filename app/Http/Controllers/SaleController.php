<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//my uses;:
use App\Sale;
use App\Zone;
use App\BankAccount;
use App\PaymentType;
use App\SalePayment;
use App\DocumentType;
use App\Client;
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

        if ($charge =='credit')
            return redirect()->action('SaleController@client');        
        else
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
        $receivedAmount = $request->get('receivedAmount');
        $idBankAccount = null;
        if ( $request->has('idBankAccount') ) $idBankAccount = $request->get('idBankAccount');

        session( [  'idPaymentType' => $idPaymentType,
                    'idBankAccount' => $idBankAccount,
                    'receivedAmount' => $receivedAmount
                 ] ); //store temporally
        

        $charge = $request->session()->get('charge');
        if ($charge == 'cash')
            return redirect()->action('SaleController@voucher');
        else 
            return redirect()->action('SaleController@client');
    }


    //step 4:
    public function client (Request $request ){
        $idZone = session ('idZone'); //step1.1

        $names = session ('names'); //step1.2
        $quantitys = session ('quantitys');
        $prices = session ('prices');
        $units = session ('units');
        $totalAmount = session ('totalAmount');

        $discount = session ('discount'); //step 2
        $charge = session ('charge');

        $idPaymentType = null; //step 3 //CULD BE NULL IF IS A CREDIT 
        $idBankAccount = null;
        $receivedAmount = null;
        if ( $request->session()->has('idPaymentType') ){ //this means, there were a pay (is not a credit sale)
            $idPaymentType = $request->session()->get('idPaymentType');
            $idBankAccount = $request->session()->get('idBankAccount');
            $receivedAmount = $request->session()->get('receivedAmount');
        }

        $zone = Zone::findOrFail($idZone);
        $paymentType = null;
        if ($idPaymentType != null)
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
        $clientType = $request->get('clientType');

        if ($clientType == 'Persona'){
            $documentNumber = $request->get('documentNumber');
            $names = $request->get('names');
            $fatherLastName = $request->get('fatherLastName');
            $motherLastName = $request->get('motherLastName');

            $phone = null;
            if ( $request->has('phone') ) $phone = $request->get('phone');
        }
        else if ($clientType == 'Empresa'){
            $documentNumberCompany = $request->get('documentNumberCompany');
            $businessName = $request->get('businessName');

            $phoneCompany = null;
            if ( $request->has('phoneCompany') ) $phoneCompany = $request->get('phoneCompany');
        }

        $idClient = null; //value to save in session
        //register new client
        if ($clientType == 'Persona'){
            $exist = Client::where('documentNumber','like',$documentNumber)->first();
            
            if ($exist == null){ //is new client
                $documentType = DocumentType::where('type','like','Person')->orderBy('idDocumentType','asc')->first(); //first is DNI

                $client = new Client();
                $client->documentNumber = $documentNumber;
                $client->names = $names;
                $client->fatherLastName = $fatherLastName;
                $client->motherLastName = $motherLastName;
                $client->phone = $phone;
                $client->registerDate = date("Y-m-d H:i:s");
                $client->idDocumentType = $documentType->idDocumentType;
                $client->save();

                $idClient = $client->idClient;
            }
            else{
                $idClient = $exist->idClient;
            }
        }
        elseif ($clientType == 'Empresa'){
            $exist = Client::where('documentNumber','like',$documentNumberCompany)->first();
            
            if ($exist == null){ //is new client
                $documentType = DocumentType::where('type','like','Company')->orderBy('idDocumentType','asc')->first(); //first is RUC

                $client = new Client();
                $client->documentNumber = $documentNumberCompany;
                $client->businessName = $businessName;
                $client->phone = $phoneCompany;
                $client->registerDate = date("Y-m-d H:i:s");
                $client->idDocumentType = $documentType->idDocumentType;
                $client->save();

                $idClient = $client->idClient;
            }
            else{
                $idClient = $exist->idClient;
            }
        }
        
        session([   'idClient' => $idClient,
                    'clientType' => $clientType ]);

        return redirect()->action('SaleController@voucher');
    }


    //step 5
    public function voucher (Request $request){ //always
        $idZone = session ('idZone'); //step1.1

        $names = session ('names'); //step1.2
        $quantitys = session ('quantitys');
        $prices = session ('prices');
        $units = session ('units');
        $totalAmount = session ('totalAmount');

        $discount = session ('discount'); //step 2
        $charge = session ('charge');

        $idPaymentType = null; //step 3 CULD BE NULL IF IS A CREDIT 
        $idBankAccount = null;
        $receivedAmount = null;
        if ( $request->session()->has('idPaymentType') ){ //this means, there were a pay (is not a credit sale)
            $idPaymentType = $request->session()->get('idPaymentType');
            $idBankAccount = $request->session()->get('idBankAccount');
            $receivedAmount = $request->session()->get('receivedAmount');
        }

        $idClient= null;
        $clientType=null;
        if ( $request->session()->has('idClient') ){
            $idClient = $request->session()->get('idClient'); //step 4 --COULD BE NULL
            $clientType = $request->session()->get('clientType');
        }

        $zone = Zone::findOrFail($idZone);

        $paymentType = null;
        if ($idPaymentType != null)
            $paymentType = PaymentType::findOrFail($idPaymentType);
        $bankAccount = null;
        if ($idBankAccount != null)
            $bankAccount = BankAccount::findOrFail($idBankAccount);  

        $client = null;
        if ($idClient != null)
            $client = Client::findOrFail($idClient);

        return view ('sale.step5_voucher', [ 'zone'=>$zone,

                                            'names'=>$names,
                                            'quantitys'=>$quantitys,
                                            'prices'=>$prices,
                                            'units'=>$units,
                                            'totalAmount'=>$totalAmount,

                                            'discount'=>$discount,
                                            'charge'=>$charge,

                                            'paymentType'=>$paymentType,
                                            'bankAccount'=>$bankAccount,
                                            'receivedAmount'=>$receivedAmount,

                                            'client'=>$client,
                                            'clientType'=>$clientType
                                            ]);
    }

    public function voucher_process (Request $request){
        $voucherType = $request->get('voucherType');

        //verificar que no haya errores:
        if ($voucherType == 'Factura' && !$request->has('documentNumber') && !$request->has('names') ){
            return redirect()->action('SaleController@voucher')->withErrors('Error', 'La factura debe tener razón social y RUC');
        }

        //all is okay:        
        $documentNumber = null;
        $namesVoucher = null;        
        if ( $request->has('documentNumber') ) $documentNumber = $request->get('documentNumber');
        if ( $request->has('namesVoucher') ) $namesVoucher = $request->get('namesVoucher');        

        //
        $idZone = session ('idZone'); //step1.1

        $idItems = session ('idItems');
        $quantitys = session ('quantitys');
        $prices = session ('prices');
        $totalAmount = session ('totalAmount');

        $discount = session ('discount'); //step 2
        $charge = session ('charge');

        $idPaymentType = null; //step 3 //CULD BE NULL IF IS A CREDIT 
        $idBankAccount = null;
        $receivedAmount = null;
        if ( $request->session()->has('idPaymentType') ){ //this means, there were a pay (is not a credit sale)
            $idPaymentType = $request->session()->get('idPaymentType');
            $idBankAccount = $request->session()->get('idBankAccount');
            $receivedAmount = $request->session()->get('receivedAmount');
        }

        $idClient = null; //step 4
        $clientType = null;
        if ( $request->session()->has('idClient') ){ //this mean, there were a client registered (is a credit)
            $idClient = $request->session()->get('idClient');
            $clientType = $request->session()->get('clientType');
        }
                
        
        DB::beginTransaction();
        //save a sale:
        $sale = new Sale();
        $sale->registerDate = date("Y-m-d H:i:s");
        $sale->totalAmount = $totalAmount;
        $sale->discount = $discount;
        $sale->payment = $charge;
        if ($charge =='credit'){
            $sale->state = 'Deuda';
        }
        else if ($charge =='cash'){
            if ($receivedAmount >= $totalAmount - $discount)
                $sale->state = 'Pagado';
            else
                $sale->state = 'Deuda';
        }
        else //esto no deberia pasar
            $sale->state = 'Caso especial';
        
        $sale->observations = null;
        $sale->idClient = $idClient;
        $sale->idZone = $idZone;
        $sale->idEmployee = Auth::User()->employee->idEmployee;
        $sale->save();

        //save its items
        $counter=0;
        foreach ($idItems as $key=> $idItem){
            $exist = DB::table('itemXSale')
                        ->where('idItem','=',$idItem)
                        ->where('idSale','=',$sale->idSale)
                        ->first();
            if ($exist == null){
                $counter++;
                $sale->items()->attach($idItem, ['orderNumber'=>$counter,'quantity'=>$quantitys[$key], 'unitPrice'=>$prices[$key]]);
            }
            else{
                $oldQuantity = $exist->quantity;
                $newQuantity = $oldQuantity + $quantitys[$key];
                $sale->items()->updateExistingPivot($idItem, ['quantity'=>$newQuantity]);
            }
        }

        //save payment:
        if ( $idPaymentType != null && $receivedAmount > 0){ //is a pay(not credit), and y bigger than 0
            $salePayment = new SalePayment();
            $salePayment->debtAmount = $totalAmount - $discount;
            $salePayment->receivedAmount = $receivedAmount;
            $salePayment->registerDate = date("Y-m-d H:i:s");
            $salePayment->idSale = $sale->idSale;
            $salePayment->idEmployee = Auth::User()->employee->idEmployee;
            $salePayment->idPaymentType = $idPaymentType;
            $salePayment->idBankAccount = $idBankAccount;
            $salePayment->save();
        }

        //register the voucher: (boleta o factura)


        DB::commit();

        //erase all sessions variables:
        $request->session()->forget('idZone');

        $request->session()->forget('idItems');
        $request->session()->forget('names');
        $request->session()->forget('quantitys');
        $request->session()->forget('prices');
        $request->session()->forget('units');
        $request->session()->forget('totalAmount');

        $request->session()->forget('discount');
        $request->session()->forget('charge');

        $request->session()->forget('idPaymentType');
        $request->session()->forget('idBankAccount');
        $request->session()->forget('receivedAmount');

        $request->session()->forget('idClient');
        $request->session()->forget('clientType');

        return redirect()->action('MenuController@dashBoard');
    }
    



    //AJAX
    public function saleMonth (){        
        $days = DB::table('sale')->select ( DB::raw('DAY(registerDate) as dia, sum(totalAmount-discount) as total, count(*) as cantidad') )
                                ->whereYear('registerDate', '=', date('Y'))
                                ->whereMonth('registerDate', '=', date('m'))
                                ->groupBy ( DB::raw('DAY(registerDate)') )
                                ->get();

        $numDays = cal_days_in_month( CAL_GREGORIAN, date('n'), date('Y') );
        return response()->json([
                            'days' => $days,
                            'numDays' => $numDays          
                        ]);
    }
}
