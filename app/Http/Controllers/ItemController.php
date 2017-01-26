<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//my uses;:
use App\Item;
use App\Unit;
use App\Zone;
use DB;
use App\Http\Requests\ItemRequest;

class ItemController extends Controller
{
    public function index (Request $request){
    	$name ='';
        if ( $request->has('name') ) $name = $request->get('name');

        $names = explode(" ", $name); //separete all words

        $arraySearch = Array();
        foreach($names as $nameSearch){
            $arraySearch[] =  ['name','like', '%'.$nameSearch.'%'];
        }

        $items = Item::where ($arraySearch)
                        ->orderBy('name','asc')
                        ->with('unit')
                        ->simplePaginate(10);        

        return view('item.index', ['items'=>$items]);
    }

    public function create (){
    	$units = Unit::orderBy('name','asc')->get();
        return view('item.create', ['units'=>$units]);
    }

    public function store (ItemRequest $request){
        $item = new Item();
        $item->name = ucfirst( strtolower( trim( $request->get('name') ) ) );
        $item->price = $request->get('price');
        $item->state = 'Activo';
        $item->realStock = 0;
        $item->availableStock = 0;
        $item->idUnit= $request->get('idUnit');

        $item->save();

        return Redirect('item')->with('message','El material ha sido registrado exitosamente.'); //es una URL
    }

    public function edit ($id){
    	$units = Unit::orderBy('name','asc')->get();
        $zones = Zone::orderBy('name','asc')->get();
        return view('item.edit', [
            'item'=> Item::findOrFail($id),
            'units'=> $units,
            'zones'=> $zones
            ]);        
    }

    public function update (ItemRequest $request, $id){ 
        DB::beginTransaction();
            $item= Item::findOrFail($id);
            //save changes of the item
            $item->name=ucfirst( strtolower( trim( $request->get('name') ) ) ); //ucfirst is to upper first letter, srtolower is used for lower all letters, trim is used for erase blank letters
            $item->idUnit= $request->get('idUnit');
            $item->price= $request->get('price');
            $item->save();       

            //save prices by zone if exist
            $item->zones()->detach(); //erase all zones related to the item
            if ($request->has('idZones')){
                $idZones = $request->get('idZones');
                $prices = $request->get('prices'); 
                    
                foreach ($idZones as $key=>$idZone){
                    $exist = DB::table('itemXZone')
                                ->where('idITem', '=', $item->idItem)
                                ->where('idZone', '=', $idZone)
                                ->count();
                    if ( $exist == 0 ) //have to verify, beacuse there could be repited ids 
                        $item->zones()->attach($idZone, ['price' => $prices[$key]]); //insert the the new relacion idZone and its price
                }
            }
        DB::commit();
        return Redirect('item')->with('message','El material ha sido actualizado exitosamente.');

    }

    public function destroy ($id){
    	$item = Item::findOrFail($id);
        $item->state= 'Inactivo';
        $item->save();
        
        return Redirect('item')->with('message','El material ha sido desactivada exitosamente.');
    }

    public function pricesZone ($id){
        $zones = Zone::orderBy('name','asc')->get();
        return view('item.pricesZone', [
            'item'=> Item::findOrFail($id),
            'zones'=> $zones
            ]); 
    }



    //AJAX: used to find products in proforma or in order
    public function searchItem (Request $request){
        $name= $request->get('nameSearch');
        $idZone= $request->get('idZone'); //is the zone input,

        $names = explode(" ", $name); //separete all words

        $arraySearch = Array();
        foreach($names as $nameSearch){
            $arraySearch[] =  ['name','like', '%'.$nameSearch.'%'];
        }

        $items = Item::where ($arraySearch)
                        ->orderBy('name','asc')
                        ->with('unit')
                        ->get();
        
        //verify if exist a diferent price in that zone
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
