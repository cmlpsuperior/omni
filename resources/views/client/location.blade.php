@extends ('app')
@section ('main')

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Clientes
        </h1>
        <ol class="breadcrumb">
            <li class="">
                <i class="fa"></i>Clientes
            </li>
            <li class="">
                <i class="fa"></i>{{ $client->idClient }}
            </li>
            <li class="active">
                <i class="fa"></i>Direcciones
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
        <h3 class="panel-title">Datos personales</h3>
      </div>
      <div class="panel-body" >

        <div class="form-group" style="width:100%;height:500px;background:yellow">
          <div id="map" style="width:100%;height:100%;"></div>
        </div>

      </div>
    </div>
  </div>

  <div class="col-lg-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Datos de contacto</h3>
      </div>
      <div class="panel-body">
            
        <div class="form-group">
            <label for="email">Correo</label>
            <input class="form-control" id="email" name="email"  type="email" value="{{ old('email') }}">
        </div>
        <div class="form-group">
            <label for="phone">Teléfono</label>
            <input class="form-control" id="phone" name="phone"  type="number" value="{{ old('phone') }}">
        </div>

      </div>
    </div>
  </div>
</div>

@endsection

@section('script')
<script>
var map;
function initMap() {
  map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: -34.397, lng: 150.644},
    zoom: 8
  });
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDCPMEv6tiNk2Ho2Emv_kuW3d4r3sEqxqI&callback=initMap" async defer></script>
@endsection