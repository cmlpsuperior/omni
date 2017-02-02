@extends ('app')
@section ('main')

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
	<div class="col-xs-6 col-md-3 text-center">

      <img src="{{ asset('img/proForma.png') }}" class="img-rounded" alt="Cinque Terre" width="100" height="100">
      <br>
      <a type="button" class="btn btn-default" href="{{ action('BillController@create', $billTypes[0]->idBillType) }}">
        Proforma
      </a>

  </div>

  <div class="col-xs-6 col-md-3 text-center">

      <img src="{{ asset('img/bill.png') }}" class="img-rounded" alt="Cinque Terre" width="100" height="100">

      <div class="dropdown">
        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
          Nueva venta
          <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
          <li><a href="{{ action('BillController@create', $billTypes[1]->idBillType) }}">Pedido</a></li>
          <li><a href="{{ action('BillController@create', $billTypes[2]->idBillType) }}">Boleta</a></li>
          <li><a href="{{ action('BillController@create', $billTypes[3]->idBillType) }}">Factura</a></li>
        </ul>
      </div>

  </div>
        
</div>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

@endsection

