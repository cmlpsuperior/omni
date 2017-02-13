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



    
}
