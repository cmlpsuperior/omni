@extends ('app')
@section ('main')

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Clientes
        </h1>
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i>Clientes
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
        <a href="{{ action('ClientController@create') }}" class="btn btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nuevo cliente</a>
    </div>
    
</div>
<br>

<div class="row">
	<div class="col-lg-10 col-lg-offset-1">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Lista de clientes</h3>
            </div>
            <div class="panel-body"> 

                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>N° documento</th>
                                <th>Nombre completo</th>
                                <th>Teléfono</th>
                                <th>Cant. direcciones</th>
                                <th>Género</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>                    
                            @foreach ($clients as $client)
        		            <tr>
        			            <td>{{ $client->documentNumber }}</td>
        			            <td>{{ $client->fatherLastName }} {{ $client->motherLastName }}, {{ $client->names }}</td>
        			            <td>{{ $client->phone }}</td>	
        			            <td>{{ count( $client->addresses ) }}</td>		
        			            <td>{{ $client->gender }}</td>					            
        			            <td>
                                    <a class="btn btn-default" href="{{ action('ClientController@edit', ['id'=>$client->idClient]) }}" title="Editar">
                                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                    </a>
        			            </td>
        			        </tr>
        			        @endforeach
                        </tbody>
                    </table>
                    {{ $clients->links() }}
                </div>

            </div>
        </div>
    </div>
</div>

@include('client.filterModal')

@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('#clients').addClass( "active" );
    });
</script>
@endsection