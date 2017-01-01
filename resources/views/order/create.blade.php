@extends ('app')
@section ('main')

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Nuevo pedido
        </h1>
        <ol class="breadcrumb">
            <li class="">
                <i class="fa"></i>Pedidos
            </li>
            <li class="active">
                <i class="fa"></i>Nuevo pedido
            </li>
        </ol>
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
        <h3 class="panel-title">Datos del cliente</h3>
      </div>
      <div class="panel-body">
        <form role="form" action="{{ action('OrderController@clientInfo_process') }}" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="row">

          <div class="col-lg-6">
            <div class="form-group">
              <label for="name">Nombre</label>
              <input class="form-control" id="name" name="name" type="text" value="{{ old('name') }}">
            </div>
          </div>

          <div class="col-lg-6">
            <div class="form-group">
              <label for="phone">Teléfono</label>
              <input class="form-control" id="phone" name="phone" type="number" value="{{ old('phone') }}">
            </div>
          </div>

        </div>

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
              <label for="address">Dirección</label>
              <input class="form-control" id="address" name="address" type="text" value="{{ old('address') }}">
            </div>
          </div>
        </div>        

        <div class="form-group text-right">          
          <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Continuar</button>
        </div>

      </div>
    </div>
    
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Buscar materiales</h3>
      </div>
      <div class="panel-body">
        
        

      </div>
    </div>

  </div>

  <div class="col-lg-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Lista de materiales</h3>
      </div>
      <div class="panel-body">
        <br><br><br><br><br><br>        

      </div>
    </div>
       
  </div>
</div>



</form>
@endsection

@section('script')
<script type="text/javascript">
$(document).ready(function() {

  $('#orders').addClass( "active" ); //to active the menu

  $('#address').keyup(function(){
    this.value = this.value.toUpperCase();
  });

});

</script>
@endsection