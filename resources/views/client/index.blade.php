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
        <div class="btn-group">
          <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            Nuevo cliente 
            <span class="caret"></span>
          </button>
          <ul class="dropdown-menu">
            <li><a href="{{ action('ClientController@createPerson') }}" >Persona</a></li>
            <li><a href="{{ action('ClientController@createCompany') }}" >Empresa</a></li>
          </ul>
        </div>
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
                                <th>Tipo doc.</th>
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
                                <td>{{ $client->documentType->name }}</td>
        			            <td>{{ $client->documentNumber }}</td>
                                @if ( $client->names == null )
                                    <td>{{ $client->businessName }}</td>
                                @else
                                    <td>{{ $client->fatherLastName }} {{ $client->motherLastName }}, {{ $client->names }}</td>
                                @endif        			            
        			            <td>{{ $client->phone }}</td>	
        			            <td>{{ count( $client->addresses ) }}</td>		
        			            <td>{{ $client->gender }}</td>
                                <!--				            
        			            <td>
                                    @if ($client->documentType->type == 'Company')
                                        <a class="btn btn-default" href="{{ action('ClientController@editCompany', ['id'=>$client->idClient]) }}" title="Editar empresa">
                                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                        </a>
                                    @else
                                        <a class="btn btn-default" href="{{ action('ClientController@editPerson', ['id'=>$client->idClient]) }}" title="Editar persona">
                                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                        </a>
                                    @endif
        			            </td>
                                -->
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