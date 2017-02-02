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

    public function create ($idBillType){
    	$zones = Zone::orderBy('name','asc')->get();
        $billType = BillType::findOrFail($idBillType);

        session( [ 'billType' => $billType ] ); //store temporally

        return view('bill.Shipping', ['zones'=>$zones, 'billType' => $billType]);
    }

    public function shipping_process( $idBillType, Request $request ){ //save what the user insert
        $idZone = null;
        $shippingAddress = null;

        $idZone = $request->get('idZone');
        if ( $request->has('shippingAddress') ) $shippingAddress =$request->get('shippingAddress');

        session( [  'idZone' => $idZone,
                    'shippingAddress'=>$shippingAddress ] ); //store temporally

        return redirect()->action('BillController@items', $idBillType );
    }

    public function items ($idBillType){
        $shippingAddress = session ('shippingAddress');
        $idZone = session ('idZone');

        $zone = Zone::findOrFail($idZone);
        $billType = BillType::findOrFail($idBillType);

        return view('bill.items', [ 'shippingAddress'=>$shippingAddress, 
                                    'zone'=>$zone , 
                                    'billType'=>$billType ] );
    }

    public function items_process ($idBillType, Request $request){
        $idItems= $request->get('idItems');
        $names = $request->get('names'); //new value
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

        $billTypes = BillType::orderBy('idBillType', 'asc')->get();

        if ( $billTypes[0]->idBillType == $idBillType ){ //is a pro forma
            session( [ 'receivedAmount'=> 0 ] );
            return redirect()->action('BillController@client', $idBillType);
        }
        else // others bills always received money from client
            return redirect()->action('BillController@receivedAmount', $idBillType);
    }

    public function receivedAmount ($idBillType){
        $shippingAddress = session ('shippingAddress');
        $idZone = session ('idZone');

        $names= session ('names');
        $quantitys= session ('quantitys');
        $prices= session ('prices');
        $units= session ('units');
        $totalAmount= session ('totalAmount');

        $zone = Zone::findOrFail ( $idZone );
        $billType = BillType::findOrFail($idBillType);

        return view ('bill.receivedAmount', [   'shippingAddress'=>$shippingAddress, 
                                                'zone'=>$zone,
                                                'billType'=>$billType,
 
                                                'names'=>$names,
                                                'quantitys'=>$quantitys,
                                                'prices'=>$prices,
                                                'units'=>$units,
                                                'totalAmount'=>$totalAmount
                                            ]);
    }

    public function receivedAmount_process ($idBillType, Request $request){
        $receivedAmount= $request->get('receivedAmount');

        session( [ 'receivedAmount'=> $receivedAmount ] ); //store temporally
        
        return redirect()->action('BillController@client');
    }

    public function client ($idBillType){
        $shippingAddress = session ('shippingAddress');
        $idZone = session ('idZone');

        $names= session ('names');
        $quantitys= session ('quantitys');
        $prices= session ('prices');
        $units= session ('units');
        $totalAmount= session ('totalAmount');

        $receivedAmount= session ('receivedAmount');

        $zone = Zone::findOrFail ( $idZone );
        $billTypes = BillType::orderBy('idBillType','asc')->get();

        return view ('bill.client', [   'shippingAddress'=>$shippingAddress, 
                                        'zone'=>$zone,                                        
 
                                        'names'=>$names,
                                        'quantitys'=>$quantitys,
                                        'prices'=>$prices,
                                        'units'=>$units,
                                        'totalAmount'=>$totalAmount,

                                        'receivedAmount'=>$receivedAmount,

                                        'billTypes'=>$billTypes
                                            ]);
    }

    public function client_process ( Request $request ){
        $shippingAddress = session('shippingAddress');
        $idZone = session('idZone'); //null

        $idItems= session ('idItems');
        $quantitys= session ('quantitys');
        $prices= session ('prices');
        $totalAmount= session ('totalAmount');

        $receivedAmount= session ('receivedAmount');

        //get all the values of the bill
        $idBillType = $request->get('idBillType');

        $namePedido = null;
        $phonePedido = null;

        $documentNumberBoleta = null;
        $nameBoleta = null;        
        $phoneBoleta = null;

        $documentNumberFactura = null;
        $nameFactura = null;
        $legalAddressFactura = null;
        $phoneFactura = null;

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

        //AQUIIIIIIIIIIIIIIIIIIIIIIIME QUEDEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEE
        if ($billType->name == 'Proforma'){ //proforma

        }
        //to know if there is a debt or not
        $debt = 0;
        if ($receivedAmount < $totalAmount) $debt = $totalAmount - $receivedAmount;

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
            if ($debt > 0 )
                $bill->state = 'Deuda';
            else
                $bill->state = 'Pagado';

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
        session()->forget('names');
        session()->forget('totalAmount');

        session()->forget('receivedAmount');

        return redirect()->action('BillController@view', ['id'=>$bill->idBill]);
    }


}
