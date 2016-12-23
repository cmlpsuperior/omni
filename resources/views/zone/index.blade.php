@extends ('app')
@section ('main')

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Zonas
        </h1>
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i>Zonas
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
        <a href="{{ action('ZoneController@create') }}" class="btn btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nueva zona</a>
    </div>    
</div>
<br>

<div class="row">
	<div class="col-lg-8 col-lg-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Lista de zonas</h3>
            </div>
            <div class="panel-body">  
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Código de zona</th>
                                <th>Nombre zona</th>
                                <th>Monto de flete S/</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>                    
                            @foreach ($zones as $zone)
        		            <tr>
        			            <td>{{ $zone->idZone }}</td>
        			            <td>{{ $zone->name }}</td>
        			            <td>S/ {{ number_format($zone->shipping, 2, '.'," ") }}</td>
                                <td>{{ $zone->state }}</td>  				            
        			            <td>
                                    <a class="btn btn-default" href="{{ action('ZoneController@edit', ['id'=>$zone->idZone]) }}" title="Editar">
                                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                    </a>
                                    <button class="btn btn-default" type="button" data-toggle="modal" data-target="#deleteModal-{{$zone->idZone}}" title="Eliminar">
                                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                    </button>
        			            </td>
        			        </tr>
                            @include('zone.deleteModal')
        			        @endforeach
                        </tbody>
                    </table>
                    {{ $zones->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@include('zone.filterModal')

@endsection

