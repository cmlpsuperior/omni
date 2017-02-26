@extends ('app')
@section ('main')

<div class="row">
	<div class="col-xs-6 col-md-3 text-center">
      <img src="{{ asset('img/proForma.png') }}" class="img-rounded" alt="Cinque Terre" width="100" height="100">
      <br>
      <a type="button" class="btn btn-default" href="{{ action('ProFormaController@zone') }}">
        Proforma
      </a>
  </div>

  <div class="col-xs-6 col-md-3 text-center">
      <img src="{{ asset('img/sale.png') }}" class="img-rounded" alt="Cinque Terre" width="100" height="100">
      <br>
      <a type="button" class="btn btn-default" href="{{ action('SaleController@zone') }}">
        Venta
      </a>
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
