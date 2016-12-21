<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//my uses;:
use App\Employee;
use App\DocumentType;
use App\Position;
use App\DriverLicense;
use App\User;
use DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\EmployeeUpdateRequest;

class EmployeeController extends Controller
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
        $employees = Employee::orderBy('idEmployee', 'desc')
                    ->where('documentNumber','like', '%'.$documentNumber.'%')
                    ->where('names','like', '%'.$names.'%')
                    ->where('fatherLastName','like', '%'.$fatherLastName.'%')
                    ->where('motherLastName','like', '%'.$motherLastName.'%')
                    ->simplePaginate(10);

        return view('employee.index', ['employees'=>$employees]); 
    }

    public function create (){
    	$documentTypes= DocumentType::orderBy('name', 'asc')->get();
        $positions= Position::orderBy('name', 'asc')->get();
        $driverLicenses= DriverLicense::orderBy('name', 'asc')->get();

    	return view('employee.create', [
            'documentTypes'=>$documentTypes, 
            'positions'=> $positions,
            'driverLicenses'=> $driverLicenses
            ]);
    }

    public function store (EmployeeRequest $request){
        DB::beginTransaction();
        	//create a new row in table users
        	$user = new User();
        	$user->name = $request->get('documentNumber');
        	$user->password =  Hash::make( $request->get('documentNumber') );
            $user->save();

        	//create a new row in table employee
	    	$employee= new employee();
	    	$employee->names=ucfirst( strtolower( trim( $request->get('names') ) ) ); //ucfirst is to upper first letter, srtolower is used for lower all letters, trim is used for erase blank letters
	    	$employee->fatherLastName=ucfirst( strtolower( trim( $request->get('fatherLastName') ) ) );
	    	$employee->motherLastName=ucfirst( strtolower( trim( $request->get('motherLastName') ) ) );

	    	$employee->birthdate=$request->get('birthdate');
	        $employee->documentNumber=$request->get('documentNumber');
	        if ( trim( $request->get('email') )!='' ) $employee->email = strtolower( trim ( $request->get('email') ) );

	        $employee->state = 'Activo';
            $employee->gender = $request->get('gender');
            if ( $request->get('phone')!='' ) $employee->phone = $request->get('phone');

            $employee->entryDate= $request->get('entryDate');
            $employee->endDate= null;

            $employee->idDocumentType=$request->get('idDocumentType');
	        if ( $request->get('idDriverLicense')!='' ) $employee->idDriverLicense = $request->get('idDriverLicense');	  
            $employee->idPosition=$request->get('idPosition');
	    	$employee->idUser = $user->id;

	    	$employee->save();
    	DB::commit();

    	return Redirect('employee')->with('message','El empleado ha sido registrado exitosamente.'); //es una URL
    }

    public function show ($id){
        return 'Legue al show';
    }

    public function edit($id){
        $documentTypes= DocumentType::orderBy('name', 'asc')->get();
        $positions= Position::orderBy('name', 'asc')->get();
        $driverLicenses= DriverLicense::orderBy('name', 'asc')->get();

        return view('employee.edit', [ 
            'positions'=> $positions,
            'driverLicenses'=> $driverLicenses,
            'employee'=> Employee::findOrFail($id)
            ]);
    	
    }

    public function update (EmployeeUpdateRequest $request, $id){
    	DB::beginTransaction();
            //create a new row in table employee
            $employee= Employee::findOrFail($id);
            $employee->names=ucfirst( strtolower( trim( $request->get('names') ) ) ); //ucfirst is to upper first letter, srtolower is used for lower all letters, trim is used for erase blank letters
            $employee->fatherLastName=ucfirst( strtolower( trim( $request->get('fatherLastName') ) ) );
            $employee->motherLastName=ucfirst( strtolower( trim( $request->get('motherLastName') ) ) );

            $employee->birthdate=$request->get('birthdate');
            //$employee->documentNumber=$request->get('documentNumber');
            if ( trim( $request->get('email') )!='' ) $employee->email = strtolower( trim ( $request->get('email') ) );

            //$employee->state = 'Activo';
            $employee->gender = $request->get('gender');
            if ( $request->get('phone')!='' ) $employee->phone = $request->get('phone');

            //$employee->entryDate= $request->get('entryDate');
            //$employee->endDate= null;

            //$employee->idDocumentType=$request->get('idDocumentType');
            if ( $request->get('idDriverLicense')!='' ) $employee->idDriverLicense = $request->get('idDriverLicense');    
            $employee->idPosition=$request->get('idPosition');
            //$employee->idUser = $user->id;

            $employee->save();
        DB::commit();

        return Redirect('employee')->with('message','El empleado ha sido actualizado exitosamente.');

    }

    public function destroy ($id){
    	$employee = Employee::findOrFail($id);
        if ($employee->state != 'Inactivo') {
            $employee->state= 'Inactivo';
            $employee->endDate= date("Y-m-d H:i:s");
            $employee->save();
        }
        return Redirect('employee')->with('message','El empleado ha sido desactivado exitosamente.');
    }
}
