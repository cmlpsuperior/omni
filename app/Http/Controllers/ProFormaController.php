<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//my uses;:
use App\ProForma;
use App\Zone;
use App\BankAccount;
use App\DocumentType;
use App\Client;
use DB;
use Illuminate\Contracts\Routing\ResponseFactory; //JSON
use Illuminate\Support\Facades\Auth; //to get the employee user

class ProFormaController extends Controller
{
    //step 1:
    public function zone (){
    	$zones = Zone::orderBy('name','asc')->get();

        return view('proForma.step1_zone', ['zones'=>$zones]);
    }

    public function zone_process( Request $request ){
        $idZone = $request->get('idZone');

        session( [  'idZone' => $idZone ] ); //store temporally

        return redirect()->action('ProFormaController@items' );
    }

    public function items (){
        $idZone = session ('idZone');
        $zone = Zone::findOrFail($idZone);

        return view('proForma.step1_items', [ 'zone'=>$zone ] );
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

        return redirect()->action('ProFormaController@amounts');
    }
}
