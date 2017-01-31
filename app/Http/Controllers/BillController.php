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

    public function create (){
    	$zones = Zone::orderBy('name','asc')->get();
        $billTypes = BillType::orderBy('idBillType','asc')->get();

        //first is proforma
        if ($billTypes[1]->idBilltype == )

        return view('order.create', ['zones'=>$zones]);
    }

    public function clientInfo_process (Request $request){
        $name = null;
        $address = null;
        $phone = null;
        $documentNumber = null;        
        $idZone = $request->get('idZone');

        if ($request->get('name') != '') $name =$request->get('name');
        if ($request->get('address') != '') $address =$request->get('address');
        if ($request->get('phone') != '') $phone =$request->get('phone');

        session( ['idZone' => $idZone, 'name'=>$name, 'address'=>$address , 'phone'=>$phone] ); //store temporally

        return redirect()->action('OrderController@items');
    }

}
