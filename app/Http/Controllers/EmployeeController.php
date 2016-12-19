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

class EmployeeController extends Controller
{
    public function index(){       
        $employees = Employee::orderBy('idEmployee', 'desc')
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
	    	$employee->names=$request->get('names');
	    	$employee->fatherLastName=$request->get('fatherLastName');
	    	$employee->motherLastName=$request->get('motherLastName');

	    	$employee->birthdate=$request->get('birthdate');
	        $employee->documentNumber=$request->get('documentNumber');
	        if ( $request->get('email')!='' ) $employee->email = $request->get('email');

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

    	return Redirect('employee'); //es una URL
    }

    public function show ($id){
        return 'Legue al show';
    	//return view('cliente.show', ["cliente"=>Cliente::findOrFail($id)]);
    }

    public function edit($id){

        //obtengo todas las zonas registradas:
        $tiposDocumentos= TipoDocumento::orderBy('nombre', 'asc')->get();
        $cargos= Cargo::orderBy('nombre', 'asc')->get();

    	return view('empleado.edit', [ 'tiposDocumentos'=>$tiposDocumentos, 'cargos'=> $cargos, 'empleado'=> Empleado::findOrFail($id) ]);
    }

    public function update (EmpleadoUpdateRequest $request, $id){
    	$empleado = Empleado::findOrFail($id);

        $empleado->nombres=$request->get('nombres');
    	$empleado->apellidoPaterno=$request->get('apellidoPaterno');
    	$empleado->apellidoMaterno=$request->get('apellidoMaterno');
    	$empleado->fechaNacimiento=$request->get('fechaNacimiento');
        //$empleado->numeroDocumento=$request->get('numeroDocumento');

        if ( $request->get('correo')!='' ) $empleado->correo = $request->get('correo');
    	
        //$empleado->estado = 'Activo';

        if ( $request->get('licencia')!='' ) $empleado->licencia = $request->get('licencia');

        //$empleado->fechaIngreso= $request->get('fechaIngreso');
        //$empleado->fechaSalida = null;
    	$empleado->idCargo=$request->get('idCargo');
    	//$empleado->idTipoDocumento=$request->get('idTipoDocumento');

    	//$empleado->idUser = $usuario->idUsuario;
    	$empleado->save();

        return Redirect('empleado'); //es una URL

    }

    public function destroy ($id){

    	//desactivamos el empleado
    	$empleado = Empleado::findOrFail($id);

        $empleado->estado= 'Inactivo';

        $empleado->save();

        return Redirect('empleado'); //es una URL
    }
}
