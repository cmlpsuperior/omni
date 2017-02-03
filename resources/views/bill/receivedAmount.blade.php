@extends ('app')
@section ('main')

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Nueva venta
        </h1>
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
    <div class="panel panel-success">

      <div class="panel-heading">
        <h3 class="panel-title">1. Datos del envío</h3>
      </div>

      <div class="panel-body">
        
        <div class="row">
          <div class="col-xs-6">
            <div class="form-group">
              <label >Zona</label>
              <h4 >{{ $zone->name }}</h4>
            </div>
          </div>

          <div class="col-xs-6">
            <div class="form-group">
              <label >Dirección</label>
              <h4 >{{ $shippingAddress }}</h4>
            </div>
          </div>
        </div>

      </div>
    </div>
    
    <div class="panel panel-success">

      <div class="panel-heading">
        <h3 class="panel-title">2. Lista de materiales</h3>
      </div>

      <div class="panel-body">
        <div class="table-responsive">
          <table class="table table-hover table-striped" id="tblItems">
              <thead>
                  <tr>
                      <th>Cant.</th>
                      <th>Unidad</th>
                      <th>Material</th>
                      <th>P.U. S/</th>
                      <th>Subtotal S/</th>
                  </tr>
              </thead>
              <tbody>                    
              @foreach($names as $key => $name)
                <tr>
                  <td>{{ $quantitys[$key] }}</td>
                  <td>{{ $units[$key] }}</td>
                  <td>{{ $name }}</td>
                  <td class="text-right">{{ number_format($prices[$key], 1, '.'," ") }}</td>
                  <td class="text-right">{{ number_format($prices[$key]*$quantitys[$key], 1, '.'," ") }}</td>
                </tr>
              @endforeach   
              </tbody>
          </table>
        </div>

        <br>
        <div class="row">
          <div class="col-md-6 col-md-offset-3">
            <div class="form-group text-center">
              <label >Importe total </label><br>
              <h4>S/ {{ number_format($totalAmount, 2, '.'," ") }}</h4>
            </div> 
          </div>
        </div>
      </div>

    </div>

  </div>


  <div class="col-lg-6">

    <div class="panel panel-primary">

      <div class="panel-heading">
        <h3 class="panel-title">3. Montos</h3>
      </div>

      <div class="panel-body">

        <form role="form" action="{{ action('BillController@receivedAmount_process') }}" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="row">
          <div class="col-xs-6 text-center">
            <div class="form-group">
              <label>Importe total </label><br>
              <h4>S/ {{ number_format($totalAmount, 2, '.'," ") }}</h4>
            </div> 
          </div>         

          <div class="col-xs-6 text-center">
            <div class="form-group">
              <label for="receivedAmount">Importe recibido S/</label><br>
              <input class="form-control" id="receivedAmount" name="receivedAmount" type="number" min="0" step="0.01" value="{{ old('receivedAmount') }}" required>
            </div> 
          </div>          
        </div>

        <div class="form-group text-center">          
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Continuar</button>
        </div>

        </form>
      </div>

    </div>    
       
  </div>
  
</div>
@endsection