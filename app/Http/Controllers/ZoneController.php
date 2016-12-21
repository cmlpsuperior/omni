<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//my uses;:
use App\Zone;
use App\Unit;
use DB;;
use App\Http\Requests\ZoneRequest;

class ZoneController extends Controller
{
    public function index (Request $request){
    	$name ='';

        if ( $request->has('name') ) $name = $request->get('name');

        //it can be improved using ifs
        $zones = Zone::orderBy('name', 'asc')
                    ->where('name','like', '%'.$name.'%')
                    ->simplePaginate(10);

        return view('zone.index', ['zones'=>$zones]);
    }

    public function create (){
        return view('zone.create');
    }

    public function store (ZoneRequest $request){
        DB::beginTransaction();
            //create a new row in table zone
            $zone = new Zone();
            $zone->name = ucfirst( strtolower( trim( $request->get('name') ) ) );
            $zone->shipping = $request->get('shipping');
            $zone->state = 'Activo';

            $zone->save();
        DB::commit();

        return Redirect('zone')->with('message','El empleado ha sido registrado exitosamente.'); //es una URL
    }

    public function edit ($id){
        return view('zone.edit', [
            'zone'=> Zone::findOrFail($id)
            ]);        
    }

    public function update (ZoneRequest $request, $id){
        DB::beginTransaction();
            //create a new row in table employee
            $zone= Zone::findOrFail($id);
            $zone->name=ucfirst( strtolower( trim( $request->get('name') ) ) ); //ucfirst is to upper first letter, srtolower is used for lower all letters, trim is used for erase blank letters
            $zone->shipping= $request->get('shipping');

            $zone->save();
        DB::commit();

        return Redirect('zone')->with('message','El empleado ha sido actualizado exitosamente.');

    }

    public function destroy ($id){
    	$zone = Zone::findOrFail($id);
        $zone->state= 'Inactivo';
        $zone->save();
        
        return Redirect('zone')->with('message','La zona ha sido desactivada exitosamente.');
    }
}
