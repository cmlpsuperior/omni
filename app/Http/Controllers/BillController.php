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

    public function shipping_process( Request $request ){ //save what the user insert
        $idZone = null;
        $shippingAddress = null;

        $idZone = $request->get('idZone');
        if ( $request->has('shippingAddress') ) $shippingAddress =$request->get('shippingAddress');

        session( [  'idZone' => $idZone,
                    'shippingAddress'=>$shippingAddress ] ); //store temporally
        dd('aqui estoy');
        return redirect()->action('BillController@items');
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
        $totalAmount= $request->get('totalAmount');     

        session( [  'idItems' => $idItems,
                    'names' => $names,
                    'quantitys'=>$quantitys,
                    'prices'=>$prices,
                    'totalAmount'=> $totalAmount ] ); //store temporally

        $billTypes = BillType::orderBy('idBillType', 'asc')->get();

        if ( $billTypes[0]->idBillType == $idBillType ){ //is a pro forma
            session( [ 'receivedAmount'=> 0 ] );
            return redirect()->action('BillController@client');
        }
        else // others bills always received money from client
            return redirect()->action('BillController@receivedAmount');
    }

    public function receivedAmount ($idBillType){
        $shippingAddress = session ('shippingAddress');
        $idZone = session ('idZone');

        $names= session ('names');
        $quantitys= session ('quantitys');
        $prices= session ('prices');
        $totalAmount= session ('totalAmount');

        $zone = Zone::findOrFail ( $idZone );
        $billType = BillType::findOrFail($idBillType);

        return view ('bill.receivedAmount', [   'shippingAddress'=>$shippingAddress, 
                                                'zone'=>$zone,
                                                'billType'=>$billType,
 
                                                'names'=>$names,
                                                'quantitys'=>$quantitys,
                                                'prices'=>$prices,
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
        $totalAmount= session ('totalAmount');

        $receivedAmount= session ('receivedAmount');

        $zone = Zone::findOrFail ( $idZone );
        $billType = BillType::findOrFail($idBillType);

        return view ('bill.client', [   'shippingAddress'=>$shippingAddress, 
                                        'zone'=>$zone,
                                        'billType'=>$billType,
 
                                        'names'=>$names,
                                        'quantitys'=>$quantitys,
                                        'prices'=>$prices,
                                        'totalAmount'=>$totalAmount,

                                        'receivedAmount'=>$receivedAmount
                                            ]);
    }

    public function client_process ( $idBillType, Request $request ){
        $shippingAddress = session('shippingAddress');
        $idZone = session('idZone'); //null

        $idItems= session ('idItems');
        $quantitys= session ('quantitys');
        $prices= session ('prices');
        $totalAmount= session ('totalAmount');

        $receivedAmount= session ('receivedAmount');

        $name = null;
        $documentNumber = null;
        $legalAddress = null;        
        $phone = null;

        if ($request->has('name') ) $name =$request->get('name');
        if ($request->has('documentNumber') ) $documentNumber =$request->get('documentNumber');
        if ($request->has('legalAddress') ) $legalAddress =$request->get('legalAddress');
        if ($request->has('phone') ) $phone =$request->get('phone');

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
