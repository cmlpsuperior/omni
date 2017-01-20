@extends ('app')
@section ('main')

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Nuevo cliente - empresa
        </h1>
        <ol class="breadcrumb">
            <li class="">
                <i class="fa"></i>Clientes
            </li>
            <li class="active">
                <i class="fa"></i>Nuevo cliente - empresa
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

<form role="form" action="{{ action('ClientController@storeCompany') }}" method="POST">
<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="row">
  <div class="col-lg-6">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Datos principales</h3>
      </div>
      <div class="panel-body">

        <div class="form-group">
          <label for="businessName">Razon social *</label>
          <input class="form-control" id="businessName" name="businessName" type="text" required value="{{ old('businessName') }}">
        </div>              
        <br>

        <div class="form-group">

          <div class="row">
            <div class="col-xs-6">
              <label for="idDocumentType">Tipo documento *</label>
              <select class="form-control" id="idDocumentType" name="idDocumentType" required>        
                @foreach ($documentTypes as $key => $documentType)
                  <option value="{{ $documentType->idDocumentType }}" @if ($key==0) selected @endif @if (old('idDocumentType')==$documentType->idDocumentType) selected @endif>{{ $documentType->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-xs-6">
              <label for="documentNumber">Num. documento *</label>
              <input class="form-control" id="documentNumber" name="documentNumber" type="number" min="0" required value="{{ old('documentNumber') }}">
            </div>
          </div>

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
            <input class="form-control" id="phone" name="phone"  type="number" min="0" value="{{ old('phone') }}">
        </div>

      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="form-group text-center">
      <a class="btn btn-danger" href="{{ action('ClientController@index') }}"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar</a>
      <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Registrar</button>
    </div>
  </div>
</div>

</form>
@endsection