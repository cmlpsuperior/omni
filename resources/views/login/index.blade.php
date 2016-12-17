<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Ferreteria Espinoza</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    
    <!--my css  -->
    <link href="css/main.css" rel="stylesheet">
    <!--to generate token when use AJAX-->
    <meta name="csrf-token" content="{{ csrf_token() }}">

  </head>

  <body>
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
					@foreach ($errors -> all() as $error)
					<div class="form-group row">
	                    <div class="col-xs-10 col-sm-8 col-md-6 col-lg-4 col-xs-offset-1 col-sm-offset-2 col-md-offset-3 col-lg-offset-4">	                    	
	                        <div class="alert alert-danger alert-dismissable">
	                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	                            <strong>{{$error}}</strong> vuelve a intentarlo
	                        </div>
	                    </div>
	                </div>
                	@endforeach>
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


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

  </body>
</html>


