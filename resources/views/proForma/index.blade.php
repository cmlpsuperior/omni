@extends ('app')
@section ('main')

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Proforma
        </h1>
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
        <a href="{{ action('ProFormaController@create') }}" class="btn btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nueva proforma</a>
    </div>    
</div>
<br>

<div class="row">
    <div class="col-lg-10 col-lg-offset-1">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Lista de proformas</h3>
            </div>
            <div class="panel-body">

                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Código proforma</th>
                                <th>Fecha registro</th>
                                <th>Imp. total S/</th>
                                <th>Cant. materiales</th>
                                <th>Zona</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>                    
                            @foreach ($proFormas as $proForma)
                            <tr>
                                <td>{{ $proForma->idProForma }}</td>
                                <td>{{ $proForma->registerDate }}</td>
                                <td>S/ {{ number_format($proForma->totalAmount, 2, '.'," ") }}</td>
                                <td>{{ count( $proForma->items ) }}</td>
                                <td>{{ $proForma->zone->name }}</td>                      
                                <td>
                                    
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $proFormas->links() }}
                </div>

            </div>
        </div>
        
    </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('#proFormas').addClass( "active" );
    });
</script>
@endsection

