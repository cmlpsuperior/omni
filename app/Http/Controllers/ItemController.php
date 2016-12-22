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

        //it can be improved using ifs
        $items = Item::orderBy('name', 'asc')
                    ->where('name','like', '%'.$name.'%')
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

    public function update (UnitRequest $request, $id){       
        //create a new row in table employee
        $item= Item::findOrFail($id);
        $item->name=ucfirst( strtolower( trim( $request->get('name') ) ) ); //ucfirst is to upper first letter, srtolower is used for lower all letters, trim is used for erase blank letters
        $item->idUnit= $request->get('idUnit');
        $item->price= $request->get('price');

        $item->save();       

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
}
