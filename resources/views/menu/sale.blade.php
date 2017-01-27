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
    <a href="{{ action('ProFormaController@create') }}">
      <img src="{{ asset('img/proforma.png') }}" class="img-rounded" alt="Cinque Terre" width="100" height="100">
      <h4>Proforma</h4>
    </a>
  </div>
        
  <div class="col-xs-6 col-md-3 text-center">
    <a href="{{ action('OrderController@create') }}">
      <img src="{{ asset('img/order.png') }}" class="img-rounded" alt="Cinque Terre" width="100" height="100">
      <h4>Pedido</h4>
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

@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('#sales').addClass( "active" );
    });
</script>
@endsection

