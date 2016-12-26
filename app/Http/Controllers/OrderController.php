<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


//my uses;:
use App\Order;
use App\Zone;
use DB;

class OrderController extends Controller
{
    public function index (Request $request){
    	$idOrder ='';

        if ( $request->has('idOrder') ) $name = $request->get('idOrder');

        $zones = Zone::orderBy('name','asc')->get();
        //it can be improved using ifs
        $orders = Order::orderBy('idOrder','desc')
                    ->simplePaginate(10);

        return view('order.index', ['orders'=>$orders, 'zones'=>$zones]);
    }

    public function create (){
    	$zones = Zone::orderBy('name','asc')->get();

        return view('order.create', ['zones'=>$zones]);
    }

    public function clientInfo_process (Request $request){
    	$name = null;
    	$address = null;
    	$idZone = $request->get('idZone');

    	if ($request->get('name') != '') $name =$request->get('name');
    	if ($request->get('address') != '') $address =$request->get('address');

    	session( ['idZone' => $idZone, 'name'=>$name, 'address'=>$address] ); //store temporally

    	return redirect()->action('OrderController@items');
    }

    public function items (){
    	$name = session ('name');
    	$address = session ('address');
    	$idZone = session ('idZone');

    	return view('order.items', ['name'=>$name, 'address'=>$address, 'idZone'=>$idZone]);
    }

    public function items_process (Request $request){
    	
    }
}
