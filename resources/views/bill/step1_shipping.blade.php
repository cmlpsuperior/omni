@extends ('app')
@section ('main')

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Nueva venta
        </h1>
    </div>
</div>

<!--Errors-->
@if (count($errors)>0)
  @foreach ($errors -> all() as $error)
  <div class="form-group row">
    <div class="col-md-6">                        
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>{{$error}}</strong>
        </div>
    </div>
  </div>
  @endforeach
@endif

<div class="row">
  <div class="col-lg-6">
    <div class="panel panel-primary">

      <div class="panel-heading">
        <h3 class="panel-title">1. Datos de envío</h3>
      </div>

      <div class="panel-body">
        <form role="form" action="{{ action('BillController@shipping_process') }}" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="row">
          <div class="col-lg-6">
            <div class="form-group">
              <label for="idZone">Zona *</label>
              <select class="form-control" id="idZone" name="idZone" required> 
                <option value="">Seleccionar</option>      
                @foreach ($zones as $key => $zone)
                  <option value="{{ $zone->idZone }}" @if (old('idZone')==$zone->idZone) selected @endif>{{ $zone->name }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="form-group">
              <label for="shippingAddress">Dirección</label>
              <input class="form-control" id="shippingAddress" name="shippingAddress" type="text" value="{{ old('shippingAddress') }}">
            </div>
          </div>
        </div>
            
        <div class="row">
          <div class="col-lg-6">
            <div class="form-group">
              
            </div>
          </div>

          <div class="col-lg-6">
            <div class="form-group">
              <label for="shippingDate">Fecha envío</label>
              <input type="date" class="form-control" id='shippingDate' name="shippingDate" >
            </div>
          </div>
        </div>        
        
        <div class="form-group text-center">          
          <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Continuar</button>
        </div>

        </form>
      </div>

    </div>
  </div>
</div>
@endsection

@section('script')
<script src="{{ asset('js/moment.min.js') }}"></script>
<script type="text/javascript">
$(document).ready(function() {
  var val = moment(new Date()).format("YYYY-MM-DD") //ISO FORMAT
  document.getElementById('shippingDate').value = val;
});
</script>
@endsection