<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//my uses;:
use App\Client;
use App\DocumentType;
use DB;
use App\Http\Requests\ClientRequest;
use App\Http\Requests\ClientUpdateRequest;

class ClientController extends Controller
{
    public function index(Request $request){
        $documentNumber ='';
        $names='';
        $fatherLastName='';
        $motherLastName='';

        if ( $request->has('documentNumber') ) $documentNumber = $request->get('documentNumber');
        if ( $request->has('names') ) $names = $request->get('names');
        if ( $request->has('fatherLastName') ) $fatherLastName = $request->get('fatherLastName');
        if ( $request->has('motherLastName') ) $motherLastName = $request->get('motherLastName');

        //it can be improved using ifs
        $clients = Client::orderBy('idClient', 'desc')
                    ->where('documentNumber','like', '%'.$documentNumber.'%')
                    ->where('names','like', '%'.$names.'%')
                    ->where('fatherLastName','like', '%'.$fatherLastName.'%')
                    ->where('motherLastName','like', '%'.$motherLastName.'%')
                    ->simplePaginate(10);

        return view('client.index', ['clients'=>$clients]); 
    }

    public function create (){
    	$documentTypes= DocumentType::orderBy('name', 'asc')->get();

    	return view('client.create', [
            'documentTypes'=>$documentTypes
            ]);
    }

    public function store (ClientRequest $request){
    	//create a new row in table client        	
    	$client= new Client();
    	$client->names=ucfirst( strtolower( trim( $request->get('names') ) ) ); //ucfirst is to upper first letter, srtolower is used for lower all letters, trim is used for erase blank letters
    	$client->fatherLastName=ucfirst( strtolower( trim( $request->get('fatherLastName') ) ) );
    	$client->motherLastName=ucfirst( strtolower( trim( $request->get('motherLastName') ) ) );

    	if ( trim( $request->get('birthdate') )!='' ) $client->birthdate = $request->get('birthdate');
        $client->documentNumber=$request->get('documentNumber');
        if ( trim( $request->get('email') )!='' ) $client->email = strtolower( trim ( $request->get('email') ) );

        $client->gender = $request->get('gender');
        if ( $request->get('phone')!='' ) $client->phone = $request->get('phone');
        $client->registerDate= date("Y-m-d H:i:s");

        $client->idDocumentType=$request->get('idDocumentType');

    	$client->save();

    	return Redirect('client')->with('message','El cliente ha sido registrado exitosamente.'); //es una URL
    }

    public function edit($id){

        return view('client.edit', [ 
            'client'=> Client::findOrFail($id)
            ]);
        
    }

    public function update (ClientUpdateRequest $request, $id){
        //modifyn a new row in table client          
        $client= Client::findOrFail($id);
        $client->names=ucfirst( strtolower( trim( $request->get('names') ) ) ); //ucfirst is to upper first letter, srtolower is used for lower all letters, trim is used for erase blank letters
        $client->fatherLastName=ucfirst( strtolower( trim( $request->get('fatherLastName') ) ) );
        $client->motherLastName=ucfirst( strtolower( trim( $request->get('motherLastName') ) ) );

        if ( trim( $request->get('birthdate') )!='' ) $client->birthdate = $request->get('birthdate');
        //$client->documentNumber=$request->get('documentNumber');
        if ( trim( $request->get('email') )!='' ) $client->email = strtolower( trim ( $request->get('email') ) );

        $client->gender = $request->get('gender');
        if ( $request->get('phone')!='' ) $client->phone = $request->get('phone');
        //$client->registerDate= date("Y-m-d H:i:s");

        //$client->idDocumentType=$request->get('idDocumentType');

        $client->save();        

        return Redirect('client')->with('message','El cliente ha sido actualizado exitosamente.');

    }

}
