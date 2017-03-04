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
    public function view($idProForma){
        $proForma = ProForma::findOrFail($idProForma);
        return view('proForma.view',['proForma'=>$proForma]);
    } 

    

    //step 1:
    public function zone (){
        $this->eraseMemory();
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

    //Step 2:
    public function amounts (){
        $idZone = session ('idZone'); //step1
        $zone = Zone::findOrFail ($idZone);

        $names = session ('names'); //step1.2
        $quantitys = session ('quantitys');
        $prices = session ('prices');
        $units = session ('units');
        $totalAmount = session ('totalAmount');        

        return view ('proForma.step2_Amounts', ['zone'=>$zone,

                                            'names'=>$names,
                                            'quantitys'=>$quantitys,
                                            'prices'=>$prices,
                                            'units'=>$units,
                                            'totalAmount'=>$totalAmount
                                            ]);
    }

    public function amounts_process (Request $request){
        $discount = 0;
        $freight = 0;
        if ( $request->has('discount') ) $discount = $request->get('discount');
        if ( $request->has('freight') )  $freight = $request->get('freight');

        $idZone = session ('idZone'); //step1.1
        $zone = Zone::findOrFail($idZone);

        $idItems = session('idItems');
        $quantitys = session ('quantitys');
        $prices = session ('prices');
        $totalAmount = session ('totalAmount');
        
        $finalAmount = $totalAmount + $freight - $discount;      
        DB::beginTransaction();
        //save a proForma:
        $proForma = new ProForma();
        $proForma->registerDate = date("Y-m-d H:i:s");        
        $proForma->discount = $discount;
        $proForma->freight = $freight;

        $proForma->totalAmount = $totalAmount;

        $proForma->idClient = null;
        $proForma->idZone = $idZone;
        $proForma->idEmployee = Auth::User()->employee->idEmployee;
        $proForma->idMoneyType = 'PEN';
        $proForma->save();

        //save its items
        $counter=0;
        foreach ($idItems as $key=> $idItem){
            $exist = DB::table('itemXProForma')
                        ->where('idItem','=',$idItem)
                        ->where('idProForma','=',$proForma->idProForma)
                        ->first();
            if ($exist == null){
                $counter++;
                $proForma->items()->attach($idItem, ['orderNumber'=>$counter,'quantity'=>$quantitys[$key], 'unitPrice'=>$prices[$key]]);
            }
            else{
                $oldQuantity = $exist->quantity;
                $newQuantity = $oldQuantity + $quantitys[$key];
                $proForma->items()->updateExistingPivot($idItem, ['quantity'=>$newQuantity]);
            }
        }

        //register the voucher: (boleta o factura)
        //working in that

        DB::commit();

        $this->eraseMemory();

        return redirect()->action('ProFormaController@view',$proForma->idProForma);        
    }

    private function eraseMemory ( ){
        //erase all sessions variables:
        session()->forget('idZone');

        session()->forget('idItems');
        session()->forget('names');
        session()->forget('quantitys');
        session()->forget('prices');
        session()->forget('units');
        session()->forget('totalAmount');

        session()->forget('discount');
        session()->forget('freight');
    }
}
