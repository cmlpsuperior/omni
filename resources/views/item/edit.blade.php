@extends ('app')
@section ('main')

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Modificar material
        </h1>
        <ol class="breadcrumb">
            <li class="">
                <i class="fa"></i>Materiales
            </li>
            <li class="active">
                <i class="fa"></i>Modificar material
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

<form role="form" action="{{ action('ItemController@update', ['id'=>$item->idItem]) }}" method="POST">
<input type="hidden" name="_method" value="PUT">
<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="row">
  <div class="col-lg-6">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Datos del material</h3>
      </div>
      <div class="panel-body">
        <div class="form-group">
          <label for="idUnit">Unidad de medida *</label>
          <select class="form-control" id="idUnit" name="idUnit" required> 
            <option value="">Seleccionar</option>      
            @foreach ($units as $key => $unit)
              <option value="{{ $unit->idUnit }}" @if ($item->idUnit==$unit->idUnit) selected @endif>{{ $unit->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
            <label for="name">Nombre *</label>
            <input class="form-control" id="name" name="name" type="text" required value="{{ $item->name }}">
        </div>
        <div class="form-group">
            <label for="price">Precio base S/ *</label>
            <input class="form-control" id="price" name="price" type="number" min="0" step="0.01" required value="{{ $item->price }}">
        </div>

      </div>
    </div> 
  </div> 

  <div class="col-lg-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Precio por zona</h3>
      </div>
      <div class="panel-body">
        
        <div class=row>
          <div class="col-xs-5">
            <div class="form-group">
              <label for="idZone"> Zona *</label>
              <select class="form-control" id="idZone" name="idZone" required> 
                <option value="">Seleccionar</option>      
                @foreach ($zones as $key => $zone)
                  <option value="{{ $zone->idZone }}">{{ $zone->name }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="col-xs-4">
            <div class="form-group">
              <label for="price">Precio S/ *</label>
              <input class="form-control" id="price" name="price" type="number" min="0" step="0.01" required value="{{ $item->price }}">
            </div> 
          </div>
        </div>

      </div>
    </div>
  </div>

</div>  


<div class="row">
  <div class="col-lg-12">
    <div class="form-group text-center">
      <a class="btn btn-danger" href="{{ action('ItemController@index') }}"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar</a>
      <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Registrar</button>
    </div>
  </div>
</div>

</form>
@endsection