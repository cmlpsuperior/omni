@extends ('app')
@section ('main')

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Nueva zona
        </h1>
        <ol class="breadcrumb">
            <li class="">
                <i class="fa"></i>Zonas
            </li>
            <li class="active">
                <i class="fa"></i>Nueva zona
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

<form role="form" action="{{ action('ZoneController@store') }}" method="POST">
<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="row">
  <div class="col-lg-6 col-lg-offset-3">
    <h2>Datos de la zona</h2>
    <div class="form-group">
        <label for="name">Nombre *</label>
        <input class="form-control" id="name" name="name" type="text" required value="{{ old('name') }}">
    </div>
    <div class="form-group">
        <label for="shipping">Monto por flete S/ *</label>
        <input class="form-control" id="shipping" name="shipping" type="number" min="0" step="0.01" required value="0">
    </div>   
  </div>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="form-group text-center">
      <a class="btn btn-danger" href="{{ action('ZoneController@index') }}"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar</a>
      <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Registrar</button>
    </div>
  </div>
</div>

</form>
@endsection