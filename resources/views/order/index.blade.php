@extends ('app')
@section ('main')

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Pedidos
        </h1>
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i>Pedidos
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
        <a href="{{ action('OrderController@create') }}" class="btn btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nuevo pedido</a>
    </div>    
</div>
<br>

<div class="row">
	<div class="col-lg-10 col-lg-offset-1">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Lista de pedidos</h3>
            </div>
            <div class="panel-body">

                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Código pedido</th>
                                <th>Fecha registro</th>
                                <th>Imp. total S/</th>
                                <th>Imp. recibido S/</th>
                                <th>Cant. materiales</th>
                                <th>Zona</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>                    
                            @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->idOrder }}</td>
                                <td>{{ $order->registerDate }}</td>
                                <td>S/ {{ number_format($order->totalAmount, 2, '.'," ") }}</td>
                                <td>S/ {{ number_format($order->receivedAmount, 2, '.'," ") }}</td>
                                <td>{{ count( $order->items ) }}</td>
                                <td>{{ $order->zone->name }}</td>                         
                                <td>
                                    <button class="btn btn-default" type="button" data-toggle="modal" data-target="#deleteModal-{{$order->idOrder}}" title="Eliminar">
                                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                    </button>

                                </td>
                            </tr>
                            @include('order.deleteModal')
                            @endforeach
                        </tbody>
                    </table>
                    {{ $orders->links() }}
                </div>

            </div>
        </div>
        
    </div>
</div>

@include('order.filterModal')

@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('#orders').addClass( "active" );
    });
</script>
@endsection

