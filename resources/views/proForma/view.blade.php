@extends ('app')
@section ('main')

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Proforma {{$proForma->idProForma}}
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
        <h3 class="panel-title">1. Lista de materiales</h3>
      </div>

      <div class="panel-body">
        <div class="row">
          <div class="col-xs-6">
            <div class="form-group">
              <label for="totalAmount">Zona</label>
              <p>{{ $proForma->zone->name }}</p>
            </div> 
          </div>
          
          <div class="col-xs-6">
            <div class="form-group">
              <label for="totalAmount">Flete sugerido</label>
              <p>S/ {{ $proForma->zone->shipping }}</p>
            </div> 
          </div>

        </div>
        <br>

        <div class="table-responsive">
          <table class="table table-hover table-striped">
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
              @foreach($proForma->items as $key => $item)
                <tr>
                  <td>{{ $item->pivot->quantity }}</td>
                  <td>{{ $item->unit->name }}</td>
                  <td>{{ $item->name }}</td>
                  <td class="text-right">{{ number_format($item->pivot->unitPrice, 2, '.',' ') }}</td>
                  <td class="text-right">{{ number_format($item->pivot->unitPrice * $item->pivot->quantity, 2, '.',' ') }}</td>
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
              <h4>S/ {{ number_format($proForma->totalAmount, 2, '.',' ') }}</h4>
            </div> 
          </div>
        </div>
      </div>

    </div>
  </div>

  <div class="col-lg-6">

    <div class="row">
      <div class="col-xs-6">
        <div class="panel panel-success">
          <div class="panel-heading">
            <h3 class="panel-title">2. Montos</h3>
          </div>

          <div class="panel-body form-horizontal">
            <div class=" row">
              <label for="" class="col-xs-6 text-right">Imp. total</label>
              <div class="col-xs-6 text-right">
                <p> {{ number_format($proForma->totalAmount, 1, '.','') }}</p>
              </div>            
            </div>

            <div class=" row">
              <label for="" class="col-xs-6 text-right">Flete</label>
              <div class="col-xs-6 text-right ">
                <p> {{ number_format($proForma->freight, 1, '.','') }}</p>        
              </div>            
            </div>

            <div class=" row">
              <label for="" class="col-xs-6 text-right">Desc.</label>
              <div class="col-xs-6 text-right ">
                <p> {{ number_format($proForma->discount, 1, '.','') }}</p>        
              </div>            
            </div>

            <div class="row text-right">
              <p class="col-xs-12">--------------------</p>                     
            </div>

            <div class="row">
              <label for="" class="col-xs-6 text-right">Monto final</label>
              <div class="col-xs-6 text-right">
                <h4 id="">S/ {{ number_format($proForma->finalAmount, 1, '.',' ') }}</h4>
              </div>            
            </div>            
            
          </div>

        </div>
      </div>
    </div>

    <div class="row">
      <div class="panel panel-success">
        
        <div class="panel-body">
          <div class="row">
            <div class="col-xs-12 text-center">           
              <a href="{{ action('PDFController@printProForma', $proForma->idProForma) }}" title="Imprimir" target="_blank" class="btn btn-info">
                <span class="glyphicon glyphicon-print" aria-hidden="true" ></span> imprimir
              </a>
              <a class="btn btn-primary" href="{{ action('MenuController@shop') }}">
                <span class="glyphicon glyphicon-ok" aria-hidden="true" ></span> Finalizar
              </a>
            </div>
          </div>
        </div>

      </div> 
    </div>

  </div>
</div>  

</form>
@endsection