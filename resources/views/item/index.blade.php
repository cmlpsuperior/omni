@extends ('app')
@section ('main')

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Meteriales
        </h1>
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i>Materiales
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
    <div class="col-md-8">
        <h2>Lista de materiales</h2>
    </div>

    <div class="col-md-4 text-right">
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#filterModal"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Buscar</button>
        <a href="{{ action('ItemController@create') }}" class="btn btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nuevo material</a>
    </div>
    
</div>

<div class="row">
	<div class="col-lg-10 col-lg-offset-1">     
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>Unidad</th>
                        <th>Nombre</th>
                        <th>Precio S/</th>
                        <th>Stock disponible</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>                    
                    @foreach ($items as $item)
		            <tr>
			            <td>{{ $item->unit->name }}</td>
			            <td>{{ $item->name }}</td>
			            <td>S/ {{ number_format($item->price, 2, '.'," ") }}</td>
                        <td>{{ $item->availableStock }}</td>
                        <td>{{ $item->state }}</td>  				            
			            <td>
                            <a class="btn btn-default" href="{{ action('ItemController@pricesZone', ['id'=>$item->idItem]) }}" title="Precios por zona">
                                <span class="glyphicon glyphicon-usd" aria-hidden="true"></span>
                            </a>
                            <a class="btn btn-default" href="{{ action('ItemController@edit', ['id'=>$item->idItem]) }}" title="Editar">
                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                            </a>
                            <button class="btn btn-default" type="button" data-toggle="modal" data-target="#deleteModal-{{$item->idItem}}" title="Eliminar">
                                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                            </button>

			            </td>
			        </tr>
                    @include('item.deleteModal')
			        @endforeach
                </tbody>
            </table>
            {{ $items->links() }}
        </div>
    </div>
</div>

@include('item.filterModal')

@endsection

