@extends ('app')
@section ('main')

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Nuevo empleado
        </h1>
        <ol class="breadcrumb">
            <li class="">
                <i class="fa"></i>Empleados
            </li>
            <li class="active">
                <i class="fa"></i>Nuevo empleado
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

<form role="form" action="{{ action('EmployeeController@store') }}" method="POST">
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
          <input class="form-control" id="names" name="names" type="text" required value="{{ old('names') }}">
        </div>
        <div class="form-group">

          <div class="row">
            <div class="col-xs-6">
              <label for="fatherLastName">Ap. paterno *</label>
              <input class="form-control" id="fatherLastName" name="fatherLastName" type="text" required value="{{ old('fatherLastName') }}">
            </div>
            
            <div class="col-xs-6">
              <label for="motherLastName">Ap. Materno *</label>
              <input class="form-control" id="motherLastName" name="motherLastName" type="text" required value="{{ old('motherLastName') }}">
            </div>
          </div>
            
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
        <br>

        <div class="form-group">
          <div class="row">

            <div class="col-xs-6">
              <label for="birthdate">Fecha nacimiento *</label>
              <input class="form-control" id="birthdate" name="birthdate" type="date" required value="{{ old('birthdate') }}">
            </div>

            <div class="col-xs-6">
              <label for="gender">Género *</label>
              <select class="form-control" id="gender" name="gender" required>
                <option value="">Seleccionar</option>
                <option value="Masculino" @if (old('gender')=='Masculino') selected @endif>Masculino</option>
                <option valur="Femenino"  @if (old('gender')=='Femenino') selected @endif>Femenino</option>
                <option valur="Otro"      @if (old('gender')=='Otro') selected @endif>Otro</option>
              </select>
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>

  <div class="col-lg-6">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Datos de trabajo</h3>
      </div>
      <div class="panel-body">
    
        <div class="form-group">
          <label for="idPosition">Cargo *</label>
          <select class="form-control" id="idPosition" name="idPosition" required>
            <option value="">Seleccionar</option>
            @foreach ($positions as $position)
              <option value="{{ $position->idPosition }}" @if (old('idPosition')==$position->idPosition) selected @endif>{{ $position->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
            <label for="entryDate">Fecha incorporación *</label>
            <input class="form-control" id="entryDate" name="entryDate" type="date" required value="{{ old('entryDate') }}">
        </div>
        <div class="form-group">
            <label for="email">Correo</label>
            <input class="form-control" id="email" name="email"  type="email" value="{{ old('email') }}">
        </div>
        <div class="form-group">
            <label for="phone">Teléfono</label>
            <input class="form-control" id="phone" name="phone"  type="number" value="{{ old('phone') }}">
        </div>
        <div class="form-group">
          <label for="idDriverLicense">Licencia de conducir</label>
          <select class="form-control" id="driverLicense" name="idDriverLicense">
            <option value="">Seleccionar</option>
            @foreach ($driverLicenses as $driverLicense)
              <option value="{{ $driverLicense->idDriverLicense }}" @if (old('idDriverLicense')==$driverLicense->idDriverLicense) selected @endif>{{ $driverLicense->name }}</option>
            @endforeach
          </select>
        </div>

      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="form-group text-center">
      <a class="btn btn-danger" href="{{ action('EmployeeController@index') }}"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar</a>
      <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Registrar</button>
    </div>
  </div>
</div>

</form>
@endsection