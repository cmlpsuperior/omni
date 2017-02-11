<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//my uses;:
use App\Bill;
use App\BillType;
use App\Zone;
use App\Item; //AJAX search
use DB;
use Illuminate\Contracts\Routing\ResponseFactory; //JSON
use Illuminate\Support\Facades\Auth; //to get the employee user
use App\Http\Requests\ItemsBillRequest; //to verufy if exist items in the list

class BillController extends Controller
{
    public function index (Request $request){
    	$idBill =0;
        if ( $request->has('idBill') ) $idBill = $request->get('idBill');

        if ($idBill >0 )
            $bills = Bill::where('idBill','=',$idBill)
                        ->simplePaginate(10);
        else
            $bills = Bill::orderBy('idBill','desc')
                        ->simplePaginate(10);

        return view('bill.index', ['bills'=>$bills]);
    }

    //step 1:
    public function create (){
    	$zones = Zone::orderBy('name','asc')->get();

        return view('bill.step1_shipping', ['zones'=>$zones]);
    }

    public function shipping_process( Request $request ){ //save what the user insert
        $idZone = null;
        $shippingAddress = null;
        $shippingDate = null;

        $idZone = $request->get('idZone');
        if ( $request->has('shippingAddress') ) $shippingAddress = mb_strtoupper( $request->get('shippingAddress') );
        if ( $request->has('shippingDate') ) $shippingDate =  $request->get('shippingDate');

        session( [  'idZone' => $idZone,
                    'shippingAddress'=>$shippingAddress,
                    'shippingDate'=>$shippingDate ] ); //store temporally

        return redirect()->action('BillController@items' );
    }


    //Step 2:
    public function items (){
        $idZone = session ('idZone');
        $shippingAddress = session ('shippingAddress');
        $shippingDate = session ('shippingDate');

        $zone = Zone::findOrFail($idZone);

        return view('bill.step2_items', [   'zone'=>$zone,
                                            'shippingAddress'=>$shippingAddress,                                            
                                            'shippingDate'=>$shippingDate ] );
    }

    public function items_process (ItemsBillRequest $request){
        $shippingDate = null;
        $shippingAddress = null;

        $idItems= $request->get('idItems');
        $names = $request->get('names');
        $quantitys= $request->get('quantitys');
        $prices= $request->get('prices');
        $units= $request->get('units');
        $totalAmount= $request->get('totalAmount');     

        if ( $request->has('shippingAddress') ) $shippingAddress = mb_strtoupper( $request->get('shippingAddress') );
        if ( $request->has('shippingDate') ) $shippingDate =  $request->get('shippingDate');

        session( [  'shippingAddress'=>$shippingAddress,                                            
                    'shippingDate'=>$shippingDate,

                    'idItems' => $idItems,
                    'names' => $names,
                    'quantitys'=>$quantitys,
                    'prices'=>$prices,
                    'units'=>$units,
                    'totalAmount'=> $totalAmount ] ); //store temporally

        return redirect()->action('BillController@receivedAmount');
    }


    //Step 3
    public function receivedAmount (){
        $idZone = session ('idZone');
        $shippingAddress = session ('shippingAddress');
        $shippingDate = session ('shippingDate');

        $names = session ('names');
        $quantitys = session ('quantitys');
        $prices = session ('prices');
        $units = session ('units');
        $totalAmount = session ('totalAmount');

        $zone = Zone::findOrFail ( $idZone );

        $billTypes = BillType::where('state','=', 'Activo')
                            ->orderBy('idBillType','asc')
                            ->get();

        return view ('bill.step3_receivedAmount', [ 'zone'=>$zone,
                                                    'shippingAddress'=>$shippingAddress, 
                                                    'shippingDate'=>$shippingDate,

                                                    'names'=>$names,
                                                    'quantitys'=>$quantitys,
                                                    'prices'=>$prices,
                                                    'units'=>$units,
                                                    'totalAmount'=>$totalAmount,

                                                    'billTypes'=>$billTypes
                                                    ]);
    }

    public function receivedAmount_process (Request $request){
        $shippingDate = null;
        $shippingAddress = null;

        $voucher =null;

        $receivedAmount = $request->get('receivedAmount');
        $idBillType = $request->get('idBillType');
        if ( $request->has('shippingDate') ) $shippingDate =  $request->get('shippingDate');
        if ( $request->has('shippingAddress') ) $shippingAddress = mb_strtoupper( $request->get('shippingAddress') );
        if ( $request->has('voucher') ) $voucher =  $request->get('voucher');

        session( [  'shippingAddress'=>$shippingAddress,                                            
                    'shippingDate'=>$shippingDate,
                    'receivedAmount'=> $receivedAmount,
                    'idBillType'=>$idBillType,
                    'voucher'=>$voucher ] ); //store temporally
        
        return redirect()->action('BillController@client');
    }


    //Step 4
    public function client (){
        $idZone = session ('idZone');
        $shippingAddress = session ('shippingAddress');
        $shippingDate = session ('shippingDate');

        $names= session ('names');
        $quantitys= session ('quantitys');
        $prices= session ('prices');
        $units= session ('units');
        $totalAmount= session ('totalAmount');

        $receivedAmount= session ('receivedAmount');
        $idBillType= session ('idBillType');
        $voucher= session ('voucher');

        $zone = Zone::findOrFail ( $idZone );
        $billType = BillType::findOrFail($idBillType);

        return view ('bill.step4_client', [     'zone'=>$zone, //step1
                                                'shippingAddress'=>$shippingAddress, 
                                                'shippingDate'=>$shippingDate,                                      
         
                                                'names'=>$names, //step2
                                                'quantitys'=>$quantitys,
                                                'prices'=>$prices,
                                                'units'=>$units,
                                                'totalAmount'=>$totalAmount,

                                                'receivedAmount'=>$receivedAmount, //step3
                                                'billType'=>$billType,
                                                'voucher'=>$voucher
                                            ]);
    }

    public function client_process ( Request $request ){
        $shippingDate = null;
        $shippingAddress = null;

        $idZone = session('idZone');

        $idItems= session ('idItems');
        $quantitys= session ('quantitys');
        $prices= session ('prices');
        $totalAmount= session ('totalAmount');

        $receivedAmount= session ('receivedAmount');

        if ( $request->has('shippingAddress') ) $shippingAddress = mb_strtoupper( $request->get('shippingAddress') );
        if ( $request->has('shippingDate') ) $shippingDate =  $request->get('shippingDate');

        //get all the values of the bill
        

        $shippingAddress = null;

        $namePedido = null;
        $phonePedido = null;

        $documentNumberBoleta = null;
        $nameBoleta = null;        
        $phoneBoleta = null;

        $documentNumberFactura = null;
        $nameFactura = null;
        $legalAddressFactura = null;
        $phoneFactura = null;

        if ($request->has('shippingAddress') ) $shippingAddress = mb_strtoupper( $request->get('shippingAddress') );

        if ($request->has('namePedido') ) $namePedido =$request->get('namePedido');
        if ($request->has('phonePedido') ) $phonePedido =$request->get('phonePedido');

        if ($request->has('documentNumberBoleta') ) $documentNumberBoleta =$request->get('documentNumberBoleta');
        if ($request->has('nameBoleta') ) $nameBoleta =$request->get('nameBoleta');
        if ($request->has('phoneBoleta') ) $phoneBoleta =$request->get('phoneBoleta');

        if ($request->has('documentNumberFactura') ) $documentNumberFactura =$request->get('documentNumberFactura');
        if ($request->has('nameFactura') ) $nameFactura =$request->get('nameFactura');
        if ($request->has('legalAddressFactura') ) $legalAddressFactura =$request->get('legalAddressFactura');
        if ($request->has('phoneFactura') ) $phoneFactura =$request->get('phoneFactura');

        //set values of bill depending of the type of the bill
        $billType = BillType::findOrFail($idBillType);

        $name = null;
        $phone = null;
        $documentNumber = null;
        $legalAddress = null;

        if ( $billType->name == 'Pedido electronico' ){
            $name = $namePedido;
            $phone = $phonePedido;
        }
        else if ( $billType->name == 'Boleta electronica' ){ 
            $name = $nameBoleta;
            $phone = $phoneBoleta;
            $documentNumber = $documentNumberBoleta;
        }
        else if ( $billType->name == 'Factura electronica' ){
            $name = $nameFactura;
            $phone = $phoneFactura;
            $documentNumber = $documentNumberFactura;
            $legalAddress = $legalAddressFactura;
        }

        DB::beginTransaction();
            //create a new order:
            $bill = new Bill();
            $bill->name = $name;
            $bill->shippingAddress = $shippingAddress;
            $bill->phone = $phone;

            $bill->documentNumber = $documentNumber;
            $bill->legalAddress = $legalAddress;
            $bill->registerDate = date("Y-m-d H:i:s");

            $bill->totalAmount = $totalAmount;
            $bill->receivedAmount = $receivedAmount;
            $bill->state = 'Sin enviar';

            $bill->observations = null;

            $bill->idClient = null;
            $bill->idZone = $idZone;
            $bill->idEmployee= Auth::User()->employee->idEmployee;
            $bill->idBillType = $idBillType;
            $bill->save();

            //insert items of that bill
            foreach ($idItems as $key=> $idItem){
                $exist = DB::table('itemXBill')
                            ->where('idItem','=',$idItem)
                            ->where('idBill','=',$bill->idBill)
                            ->first();
                if ($exist == null)
                    $bill->items()->attach($idItem, ['quantity'=>$quantitys[$key], 'unitPrice'=>$prices[$key]]);
                else{
                    $oldQuantity = $exist->quantity;
                    $newQuantity = $oldQuantity + $quantitys[$key];
                    $bill->items()->updateExistingPivot($idItem, ['quantity'=>$newQuantity]);
                }
            }
        DB::commit();

        //erase variable in session:
        session()->forget('shippingAddress');
        session()->forget('idZone');

        session()->forget('idItems');
        session()->forget('quantitys');
        session()->forget('prices');
        session()->forget('untis');
        session()->forget('names');
        session()->forget('totalAmount');

        session()->forget('receivedAmount');

        return redirect()->action('BillController@view',$bill->idBill );
    }

    public function view ($idBill){
        $bill = Bill::findOrFail($idBill);
        return view('bill.view', ['bill' => $bill] );
    }


    //AJAX
    public function saleMonth (){        
        $days = DB::table('bill')->join('billType', 'billType.idBillType', '=', 'bill.idBillType')
                                ->select ( DB::raw('DAY(registerDate) as dia, sum(totalAmount) as total, count(*) as cantidad') )
                                ->where('billType.isSale','=', 1)
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
