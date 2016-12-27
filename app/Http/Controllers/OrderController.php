<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


//my uses;:
use App\Order;
use App\Zone;
use App\Item; //AJAX search
use DB;
use Illuminate\Contracts\Routing\ResponseFactory; //JSON
use Illuminate\Support\Facades\Auth; //to get the employee user

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

        $zone = Zone::findOrFail($idZone);

    	return view('order.items', ['name'=>$name, 'address'=>$address, 'zone'=>$zone]);
    }

    public function items_process (Request $request){        
        $name=session('name');
        $address = session('address');
        $idZone = session('idZone');

        $idItems= $request->get('idItems');
        $quantitys= $request->get('quantitys');
        $prices= $request->get('prices');
        $receivedAmount = $request->get('receivedAmount');
        $totalAmount = $request->get('totalAmount');

        DB::beginTransaction();
            //create a new order:
            $order = new Order();
            $order->name = $name;
            $order->address = $address;
            $order->registerDate = date("Y-m-d H:i:s");

            $order->totalAmount = $totalAmount;
            $order->receivedAmount = $receivedAmount;
            $order->state = 'Confirmado';

            $order->idClient= null;
            $order->idZone= $idZone;
            $order->idEmployee= Auth::User()->employee->idEmployee;           

            $order->save();

            //insert items of that order
            foreach ($idItems as $key=> $idItem){
                $exist = DB::table('itemXOrder')
                            ->where('idItem','=',$idItem)
                            ->where('idOrder','=',$order->idOrder)
                            ->first();
                if ($exist == null)
                    $order->items()->attach($idItem, ['quantity'=>$quantitys[$key], 'unitPrice'=>$prices[$key]]);
                else{
                    $oldQuantity = $exist->quantity;
                    $newQuantity = $oldQuantity + $quantitys[$key];
                    $order->items()->updateExistingPivot($idItem, ['quantity'=>$newQuantity]);
                }
            }
        DB::commit();

        //erase variable in session:
        session()->forget('name');
        session()->forget('address');
        session()->forget('idZone');

        return redirect()->action('OrderController@resume', ['id'=>$order->idOrder]);
    }

    public function resume ($id){
        $order = Order::findOrFail($id);
        $change = 0;
        $debt = 0;

        if ($order->receivedAmount > $order->totalAmount) $change = $order->receivedAmount - $order->totalAmount;
        if ($order->receivedAmount < $order->totalAmount) $debt = $order->totalAmount - $order->receivedAmount;


        return view('order.resume', ['order'=>$order, 'change'=>$change, 'debt'=>$debt]);
    }

    //AJAX
    public function searchItem (Request $request){
        $name= $request->get('nameSearch');
        $idZone= $request->get('idZone');

        $items = Item::where ('name','like','%'.$name.'%')
                        ->orderBy('name','asc')
                        ->with('unit')
                        ->get();

        foreach ($items as $item){
            $exist = DB::table('itemXZone')
                        ->where('idItem','=', $item->idItem)
                        ->where('idZone','=', $idZone)
                        ->first();

            if ($exist != null){                
                $item->price=$exist->price;
            }
        }
        return response()->json([
                            'items' => $items                      
                        ]);
    }
}
