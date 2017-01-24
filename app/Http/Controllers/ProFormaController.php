<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//my uses
use App\ProForma;
use App\Zone;

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
}
