<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//my uses;:
use App\Client;
use App\DocumentType;
use App\Address;
use DB;
use App\Http\Requests\ClientRequest;
use App\Http\Requests\ClientUpdateRequest;
use App\Http\Requests\CompanyRequest;


class ClientController extends Controller
{
    public function index(Request $request){
        $documentNumber ='';
        $businessName = '';
        $names ='';
        $fatherLastName ='';
        $motherLastName= '';

        if ( $request->has('documentNumber') ) $documentNumber = $request->get('documentNumber');
        if ( $request->has('businessName') ) $businessName = $request->get('businessName');
        if ( $request->has('names') ) $names = $request->get('names');
        if ( $request->has('fatherLastName') ) $fatherLastName = $request->get('fatherLastName');
        if ( $request->has('motherLastName') ) $motherLastName = $request->get('motherLastName');

        //results
        if ( $documentNumber != ''){
            $clients = Client::orderBy('documentNumber', 'asc')
                        ->where('documentNumber','like', '%'.$documentNumber.'%')
                        ->simplePaginate(10);
        }
        else if ( $names != '' || $fatherLastName != '' || $motherLastName != ''){ //is a person search
            $clients = Client::orderBy('documentNumber', 'asc')
                        ->where('names','like', '%'.$names.'%')
                        ->where('fatherLastName','like', '%'.$fatherLastName.'%')
                        ->where('motherLastName','like', '%'.$motherLastName.'%')
                        ->simplePaginate(10);
        }
        else if ( $businessName !='' ){ //is a company search
            $clients = Client::orderBy('documentNumber', 'asc')
                        ->where('businessName','like', '%'.$businessName.'%')
                        ->simplePaginate(10);
        }
        else {
            $clients = Client::orderBy('documentNumber', 'asc')
                        ->simplePaginate(10);
        }

        return view('client.index', ['clients'=>$clients]); 
    }

    public function createPerson (){
    	$documentTypes= DocumentType::where('type','Person')
                                    ->orderBy('name', 'asc')
                                    ->get();

    	return view('client.createPerson', [
            'documentTypes'=>$documentTypes
            ]);
    }

    public function createCompany (){
        $documentTypes= DocumentType::where('type','Company')
                                    ->orderBy('name', 'asc')
                                    ->get();

        return view('client.createCompany', [
            'documentTypes'=>$documentTypes
            ]);
    }
    
    public function storePerson (ClientRequest $request){
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

    public function storeCompany (CompanyRequest $request){
        //create a new row in table client          
        $client= new Client();
        $client->names=null;
        $client->fatherLastName=null;
        $client->motherLastName=null;

        $client->birthdate = null;
        $client->documentNumber = $request->get('documentNumber');
        $client->email = strtolower( trim ( $request->get('email') ) );

        $client->gender = 'Empresa';
        if ( $request->get('phone')!='' ) $client->phone = $request->get('phone');
        $client->registerDate= date("Y-m-d H:i:s");

        $client->businessName = trim ( $request->get('businessName') );

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

    public function location ($id){
        $client = Client::findOrFail($id);
        $addresses = $client->addresses; 

        return view ('client.location', ['client'=>$client, 'addresses'=> $addresses]);
    }







    //AJAX: used to find person-client names
    public function searchPersonByDocumentNumber (Request $request){
        $documentNumber= $request->get('documentNumber');

        //get ids of documentType person
        $idsDocumentType = DocumentType::where('type','=', 'person')->pluck('idDocumentType');

        $personClient = Client::where('documentNumber','=',$documentNumber)
                                ->whereIn('idDocumentType', $idsDocumentType)
                                ->first();

        return response()->json([
                            'personClient' => $personClient                      
                        ]);
    }

}
