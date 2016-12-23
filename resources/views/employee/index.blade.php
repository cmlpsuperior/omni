@extends ('app')
@section ('main')

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Empleados
        </h1>
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i>Empleados
            </li>
        </ol>
    </div>
</div>



<!--Errors-->
@if ( count($errors)>0 )
  @foreach ( $errors -> all() as $error )
  <div class="form-group row">
    <div class="col-md-6">                        
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Error!</strong> {{ $error }}
        </div>
    </div>
  </div>
  @endforeach
@endif

<!--success-->
@if ( session('message') )
  <div class="form-group row">
    <div class="col-md-6">                        
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Correcto!</strong> {{ session('message') }}
        </div>
    </div>
  </div>
@endif

<div class="row">   

    <div class="col-md-12 text-right">
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#filterModal"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Buscar</button>
        <a href="{{ action('EmployeeController@create') }}" class="btn btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nuevo empleado</a>
    </div>
    
</div>
<br>

<div class="row">
	<div class="col-lg-10 col-lg-offset-1">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Lista de zonas</h3>
            </div>
            <div class="panel-body"> 

                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>N° documento</th>
                                <th>Nombre completo</th>
                                <th>Cargo</th>
                                <th>Fecha incorporación</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>                    
                            @foreach ($employees as $employee)
        		            <tr>
        			            <td>{{ $employee->documentNumber }}</td>
        			            <td>{{ $employee->fatherLastName }} {{ $employee->motherLastName }}, {{ $employee->names }}</td>
        			            <td>{{ $employee->position->name }}</td>	
        			            <td>{{ $employee->entryDate }}</td>		
        			            <td>{{ $employee->state }}</td>					            
        			            <td>
                                    <a class="btn btn-default" href="{{ action('EmployeeController@edit', ['id'=>$employee->idEmployee]) }}" title="Editar">
                                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                    </a>
                                    <button class="btn btn-default" type="button" data-toggle="modal" data-target="#deleteModal-{{$employee->idEmployee}}" title="Eliminar">
                                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                    </button>
        			            </td>
        			        </tr>
                            @include('employee.deleteModal')
        			        @endforeach
                        </tbody>
                    </table>
                    {{ $employees->links() }}
                </div>

            </div>
        </div>
    </div>
</div>

@include('employee.filterModal')

@endsection

