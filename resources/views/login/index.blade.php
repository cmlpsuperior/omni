@extends ('app')
@section ('main')

<form class="form-signin" method="POST">
	<h2>Iniciar sesión</h2>
						
	<div class="form-group">
		<label for="email">Correo electrónico</label>
		<input type="email" id="email" name="email" class="form-control" title="Por favor ingrese su correo electrónico." required>
	</div>

	<div class="form-group">
		<label for="password">Contraseña</label>
		<input type="password" id="password" name="password" class="form-control" title="Por favor ingrese su nueva contraseña." required>
	</div>

	<button type="submit" class="btn btn-primary">Ingresar</button>
	
</form>

@stop