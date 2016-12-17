<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//my uses;:
use App\Empleado;
use App\TipoDocumento;

class EmpleadoController extends Controller
{
    public function index(){       
        $empleados = Empleado::orderBy('idEmpleado', 'desc')
                  ->simplePaginate(8);

        return view('empleado.index', ['empleados'=>$empleados]); 
    }

    public function create (){
    	$cargos= Cargo::orderBy('nombre', 'asc')->get();
        $tiposDocumentos= TipoDocumento::orderBy('idTipoDocumento', 'asc')->get();

    	return view('empleado.create', ['tiposDocumentos'=>$tiposDocumentos, 'cargos'=> $cargos]);
    }

    public function store (EmpleadoRequest $request){        
        //una transaccion, ya que ambos deben registrar, sino ninguno.
        DB::beginTransaction();

        	//creo para la tabal USERs
        	$usuario = new Usuario();

        	$usuario->name = $request->get('numeroDocumento');
        	$usuario->usuario = $request->get('numeroDocumento');
        	$usuario->password =  Hash::make( $request->get('numeroDocumento') );
            $usuario->save();

        	//creamos el empleado
	    	$empleado= new Empleado();
	    	$empleado->nombres=$request->get('nombres');
	    	$empleado->apellidoPaterno=$request->get('apellidoPaterno');
	    	$empleado->apellidoMaterno=$request->get('apellidoMaterno');
	    	$empleado->fechaNacimiento=$request->get('fechaNacimiento');
	        $empleado->numeroDocumento=$request->get('numeroDocumento');

	        if ( $request->get('correo')!='' ) $empleado->correo = $request->get('correo');
	    	
	        $empleado->estado = 'Activo';

	        if ( $request->get('licencia')!='' ) $empleado->licencia = $request->get('licencia');

	        $empleado->fechaIngreso= $request->get('fechaIngreso');
	        $empleado->fechaSalida = null;
	    	$empleado->idCargo=$request->get('idCargo');
	    	$empleado->idTipoDocumento=$request->get('idTipoDocumento');

	    	$empleado->idUser = $usuario->id;
	    	$empleado->save();

    	DB::commit();

    	return Redirect('empleado'); //es una URL
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
