@extends ('app')
@section ('main')

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Modificar empleado
        </h1>
        <ol class="breadcrumb">
            <li class="">
                <i class="fa"></i>Empleados
            </li>
            <li class="active">
                <i class="fa"></i>Modificar empleado
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

<form role="form" action="{{ action('EmployeeController@update', ['id'=>$employee->idEmployee]) }}" method="POST">
<input type="hidden" name="_method" value="PUT">
<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="row">
  <div class="col-lg-6">
    <h2>Datos personales</h2>
    <div class="form-group">
        <label for="names">Nombres *</label>
        <input class="form-control" id="names" name="names" type="text" required value="{{ $employee->names }}">
    </div>
    <div class="form-group">
        <label for="fatherLastName">Apellido paterno *</label>
        <input class="form-control" id="fatherLastName" name="fatherLastName" type="text" required value="{{ $employee->fatherLastName  }}">
    </div>
    <div class="form-group">
        <label for="motherLastName">Apellido Materno *</label>
        <input class="form-control" id="motherLastName" name="motherLastName" type="text" required value="{{ $employee->motherLastName }}">
    </div>
    <div class="form-group">
        <label for="birthdate">Fecha de nacimiento *</label>
        <input class="form-control" id="birthdate" name="birthdate" type="date" required value="{{ date( 'Y-m-d',strtotime($employee->birthdate) ) }}">
    </div>
    <div class="form-group">
      <label for="idDocumentType">Tipo de documento</label>
      <select class="form-control" id="idDocumentType" name="idDocumentType" readonly>
          <option value="{{ $employee->documentType->idDocumentType }}" selected>{{ $employee->documentType->name }}</option>
      </select>
    </div>
    <div class="form-group">
        <label for="documentNumber">Numero de documento</label>
        <input class="form-control" id="documentNumber" name="documentNumber" type="number" min="0" required value="{{ $employee->documentNumber }}" readonly>
    </div>
    <div class="form-group">
      <label for="gender">Género *</label>
      <select class="form-control" id="gender" name="gender" required>
        <option value="">Seleccionar</option>
        <option value="Masculino" @if ($employee->gender=='Masculino') selected @endif>Masculino</option>
        <option valur="Femenino"  @if ($employee->gender=='Femenino') selected @endif>Femenino</option>
        <option valur="Otro"      @if ($employee->gender=='Otro') selected @endif>Otro</option>
      </select>
    </div>
  </div>

  <div class="col-lg-6">
    <h2>Datos de trabajo</h2> 
    <div class="form-group">
      <label for="idPosition">Cargo *</label>
      <select class="form-control" id="idPosition" name="idPosition" required>
        <option value="">Seleccionar</option>
        @foreach ($positions as $position)
          <option value="{{ $position->idPosition }}" @if ($employee->idPosition==$position->idPosition) selected @endif>{{ $position->name }}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
        <label for="entryDate">Fecha incorporación</label>
        <input class="form-control" id="entryDate" name="entryDate" type="date" required value="{{ date( 'Y-m-d',strtotime($employee->entryDate) ) }}" readonly>
    </div>
    <div class="form-group">
        <label for="email">Correo</label>
        <input class="form-control" id="email" name="email"  type="email" value="{{ $employee->email }}">
    </div>
    <div class="form-group">
        <label for="phone">Teléfono</label>
        <input class="form-control" id="phone" name="phone"  type="number" value="{{ $employee->phone }}">
    </div>
    <div class="form-group">
      <label for="idDriverLicense">Licencia de conducir</label>
      <select class="form-control" id="driverLicense" name="idDriverLicense">
        <option value="">Seleccionar</option>
        @foreach ($driverLicenses as $driverLicense)
          <option value="{{ $driverLicense->idDriverLicense }}" @if ($employee->idDriverLicense==$driverLicense->idDriverLicense) selected @endif>{{ $driverLicense->name }}</option>
        @endforeach
      </select>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="form-group text-center">
      <a class="btn btn-danger" href="{{ action('EmployeeController@index') }}"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar</a>
      <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Guardar</button>
    </div>
  </div>
</div>

</form>
@endsection