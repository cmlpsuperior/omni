<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//my uses
use App\ProForma;
use App\Zone;
use DB;
use Illuminate\Contracts\Routing\ResponseFactory; //JSON
use Illuminate\Support\Facades\Auth; //to get the employee user
use App\Http\Requests\ItemsProFormaRequest; //to verufy if exist items in the list

class ProFormaController extends Controller
{
    public function index (Request $request){
    	$idProForma =0;
        if ( $request->has('idProForma') ) $idProForma = $request->get('idProForma');

        $zones = Zone::orderBy('name','asc')->get();

        if ($idProForma >0 )
            $proFormas = ProForma::where('idProForma','=',$idProForma)
                        ->simplePaginate(10);
        else
            $proFormas = ProForma::orderBy('idProForma','desc')
                        ->simplePaginate(10);

        return view('proForma.index', ['proFormas'=>$proFormas, 'zones'=>$zones]);
    }

    public function create (){
    	$zones = Zone::orderBy('name','asc')->get();

        return view('proForma.create', ['zones'=>$zones]);
    }

    public function clientInfo_process (Request $request){
    	$idZone = $request->get('idZone');

    	session( ['idZone' => $idZone] ); //store temporally

    	return redirect()->action('ProFormaController@items');
    }

    public function items (){
        $idZone = session ('idZone');

        $zone = Zone::findOrFail($idZone);

        return view('proForma.items', ['zone'=>$zone]);
    }

    public function items_process (ItemsProFormaRequest $request){        
        $idZone = session('idZone');

        $idItems= $request->get('idItems');
        $quantitys= $request->get('quantitys');
        $prices= $request->get('prices');
        $totalAmount = $request->get('totalAmount');       

        DB::beginTransaction();
            //create a new proforma:
            $proForma = new Proforma();
            $proForma->registerDate = date("Y-m-d H:i:s");
            $proForma->totalAmount = $totalAmount;

            $proForma->idClient= null;
            $proForma->idZone= $idZone;
            $proForma->idEmployee= Auth::User()->employee->idEmployee;   
            $proForma->save();

            //insert items of that proforma
            foreach ($idItems as $key=> $idItem){
                $exist = DB::table('itemXProForma')
                            ->where('idItem','=',$idItem)
                            ->where('idProForma','=',$proForma->idProForma)
                            ->first();
                if ($exist == null)
                    $proForma->items()->attach($idItem, ['quantity'=>$quantitys[$key], 'unitPrice'=>$prices[$key]]);
                else{
                    $oldQuantity = $exist->quantity;
                    $newQuantity = $oldQuantity + $quantitys[$key];
                    $proForma->items()->updateExistingPivot($idItem, ['quantity'=>$newQuantity]);
                }
            }
        DB::commit();

        //erase variable in session:
        session()->forget('idZone');

        return redirect()->action('ProFormaController@view', ['id'=>$proForma->idProForma]);
    }

    public function view ($id){
        $proForma = ProForma::findOrFail($id);

        return view('proForma.view', ['proForma'=>$proForma ]);
    }
}
