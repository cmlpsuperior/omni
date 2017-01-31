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
use App\Http\Requests\ItemsOrderRequest; //to verufy if exist items in the list

class OrderController extends Controller
{
    public function index (Request $request){
    	$idOrder =0;
        if ( $request->get('idOrder') != '' ) $idOrder = $request->get('idOrder');

        $zones = Zone::orderBy('name','asc')->get();

        if ($idOrder >0 )
            $orders = Order::where('idOrder','=',$idOrder)
                        ->simplePaginate(10);
        else
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
        $phone = null;
    	$idZone = $request->get('idZone');

    	if ($request->get('name') != '') $name =$request->get('name');
    	if ($request->get('address') != '') $address =$request->get('address');
        if ($request->get('phone') != '') $phone =$request->get('phone');

    	session( ['idZone' => $idZone, 'name'=>$name, 'address'=>$address , 'phone'=>$phone] ); //store temporally

    	return redirect()->action('OrderController@items');
    }

    public function items (){
    	$name = session ('name');
    	$address = session ('address');
        $phone = session ('phone');
    	$idZone = session ('idZone');

        $zone = Zone::findOrFail($idZone);

    	return view('order.items', ['name'=>$name, 'address'=>$address, 'zone'=>$zone , 'phone'=>$phone]);
    }

    public function items_process (ItemsOrderRequest $request){        
        $name=session('name');
        $address = session('address');
        $phone = session('phone');
        $idZone = session('idZone');

        $idItems= $request->get('idItems');
        $quantitys= $request->get('quantitys');
        $prices= $request->get('prices');
        $receivedAmount = $request->get('receivedAmount');
        $totalAmount = $request->get('totalAmount');       

        //to know if there is a debt or not
        $debt = 0;
        if ($receivedAmount < $totalAmount) $debt = $totalAmount - $receivedAmount;

        DB::beginTransaction();
            //create a new order:
            $order = new Order();
            $order->name = $name;
            $order->address = $address;
            $order->phone = $phone;

            $order->registerDate = date("Y-m-d H:i:s");
            $order->totalAmount = $totalAmount;
            $order->receivedAmount = $receivedAmount;

            if ($debt >0 )
                $order->state = 'Deuda';
            else
                $order->state = 'Pagado';

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
        session()->forget('phone');
        session()->forget('idZone');

        return redirect()->action('OrderController@view', ['id'=>$order->idOrder]);
    }

    public function view ($id){
        $order = Order::findOrFail($id);
        $change = 0;
        $debt = 0;

        if ($order->receivedAmount > $order->totalAmount) $change = $order->receivedAmount - $order->totalAmount;
        if ($order->receivedAmount < $order->totalAmount) $debt = $order->totalAmount - $order->receivedAmount;

        return view('order.view', ['order'=>$order, 'change'=>$change, 'debt'=>$debt]);
    }

    public function destroy ($id){
        $order = Order::findOrFail($id);
        $order->state= 'Anulado';
        $order->save();
        
        return Redirect('order')->with('message','El pedido ha sido ANULADO exitosamente.');
    }
}
