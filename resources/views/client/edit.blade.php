@extends ('app')
@section ('main')

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Modificar cliente
        </h1>
        <ol class="breadcrumb">
            <li class="">
                <i class="fa"></i>Clientes
            </li>
            <li class="active">
                <i class="fa"></i>Modificar cliente
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

<form role="form" action="{{ action('ClientController@update', ['id'=>$client->idClient]) }}" method="POST">
<input type="hidden" name="_method" value="PUT">
<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="row">
  <div class="col-lg-6">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Datos personales</h3>
      </div>
      <div class="panel-body">

        <div class="form-group">
            <label for="names">Nombres *</label>
            <input class="form-control" id="names" name="names" type="text" required value="{{ $client->names }}">
        </div>
        <div class="form-group">
            <label for="fatherLastName">Apellido paterno *</label>
            <input class="form-control" id="fatherLastName" name="fatherLastName" type="text" required value="{{ $client->fatherLastName  }}">
        </div>
        <div class="form-group">
            <label for="motherLastName">Apellido Materno *</label>
            <input class="form-control" id="motherLastName" name="motherLastName" type="text" required value="{{ $client->motherLastName }}">
        </div>
        <div class="form-group">
            <label for="birthdate">Fecha de nacimiento *</label>
            <input class="form-control" id="birthdate" name="birthdate" type="date" required value="{{ date( 'Y-m-d',strtotime($client->birthdate) ) }}">
        </div>
        <div class="form-group">
          <label for="idDocumentType">Tipo de documento</label>
          <select class="form-control" id="idDocumentType" name="idDocumentType" readonly>
              <option value="{{ $client->documentType->idDocumentType }}" selected>{{ $client->documentType->name }}</option>
          </select>
        </div>
        <div class="form-group">
            <label for="documentNumber">Numero de documento</label>
            <input class="form-control" id="documentNumber" name="documentNumber" type="number" min="0" required value="{{ $client->documentNumber }}" readonly>
        </div>
        <div class="form-group">
          <label for="gender">Género *</label>
          <select class="form-control" id="gender" name="gender" required>
            <option value="">Seleccionar</option>
            <option value="Masculino" @if ($client->gender=='Masculino') selected @endif>Masculino</option>
            <option valur="Femenino"  @if ($client->gender=='Femenino') selected @endif>Femenino</option>
            <option valur="Otro"      @if ($client->gender=='Otro') selected @endif>Otro</option>
          </select>
        </div>

      </div>
    </div>
  </div>

  <div class="col-lg-6">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Datos de contacto</h3>
      </div>
      <div class="panel-body">
              
        <div class="form-group">
            <label for="email">Correo</label>
            <input class="form-control" id="email" name="email"  type="email" value="{{ $client->email }}">
        </div>
        <div class="form-group">
            <label for="phone">Teléfono</label>
            <input class="form-control" id="phone" name="phone"  type="number" value="{{ $client->phone }}">
        </div>

      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="form-group text-center">
      <a class="btn btn-danger" href="{{ action('ClientController@index') }}"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar</a>
      <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Guardar</button>
    </div>
  </div>
</div>

</form>
@endsection