@extends ('app')
@section ('main')

<div class="container">

	<form class="" action="{{ action('LoginController@authenticate') }}" method="POST">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		
		<div class="form-group row">
			<div class="col-xs-10 col-sm-8 col-md-6 col-lg-4 col-xs-offset-1 col-sm-offset-2 col-md-offset-3 col-lg-offset-4">
				<h2>Iniciar sesión</h2>
			</div>			
		</div>

		<!--Errors-->
		@if (count($errors)>0)
		<div class="form-group row alert">
			<div class="col-xs-10 col-sm-8 col-md-6 col-lg-4 col-xs-offset-1 col-sm-offset-2 col-md-offset-3 col-lg-offset-4">
				<ul>
		        @foreach ($errors -> all() as $error)
		          <li>{{$error}}</li>
		        @endforeach
		    	</ul>
			</div>			
		</div>
		@endif  
		
							
		<div class="form-group row">
			<div class="col-xs-10 col-sm-8 col-md-6 col-lg-4 col-xs-offset-1 col-sm-offset-2 col-md-offset-3 col-lg-offset-4">
				<label for="email">Correo electrónico</label>
				<input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
			</div>			
		</div>

		<div class="form-group row">
			<div class="col-xs-10 col-sm-8 col-md-6 col-lg-4 col-xs-offset-1 col-sm-offset-2 col-md-offset-3 col-lg-offset-4">				
				<label for="password">Contraseña</label>
				<input type="password" id="password" name="password" class="form-control" value="{{ old('password') }}" required>
			</div>
			
		</div>
		
		<div class="form-group row">
			<div class="col-xs-10 col-sm-8 col-md-6 col-lg-4 col-xs-offset-1 col-sm-offset-2 col-md-offset-3 col-lg-offset-4">
				<button type="submit" class="btn btn-primary">Ingresar</button>
			</div>
		</div>		
		
	</form>

</div>
@stop