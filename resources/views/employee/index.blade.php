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

<div class="row">
	<div class="col-lg-12">
        <h2>Lista de empleados</h2>
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
			            </td>
			        </tr>
			        @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

