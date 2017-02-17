@extends ('app')
@section ('main')

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Venta {{$sale->idSale}}
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
              <p>{{ $sale->zone->name }}</p>
            </div> 
          </div>
          
          <div class="col-xs-6">
            <div class="form-group">
              <label for="totalAmount">Flete sugerido</label>
              <p>S/ {{ $sale->zone->shipping }}</p>
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
              @foreach($sale->items as $key => $item)
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
              <h4>S/ {{ number_format($sale->totalAmount, 2, '.',' ') }}</h4>
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
                <p> {{ number_format($sale->totalAmount, 1, '.','') }}</p>
              </div>            
            </div>

            <div class=" row">
              <label for="" class="col-xs-6 text-right">Flete</label>
              <div class="col-xs-6 text-right ">
                <p> {{ number_format($sale->freight, 1, '.','') }}</p>        
              </div>            
            </div>

            <div class=" row">
              <label for="" class="col-xs-6 text-right">Desc.</label>
              <div class="col-xs-6 text-right ">
                <p> {{ number_format($sale->discount, 1, '.','') }}</p>        
              </div>            
            </div>

            <div class="row text-right">
              <p class="col-xs-12">--------------------</p>                     
            </div>

            <div class="row">
              <label for="" class="col-xs-6 text-right">Monto final</label>
              <div class="col-xs-6 text-right">
                <h4 id="">S/ {{ number_format($sale->finalAmount, 1, '.',' ') }}</h4>
              </div>            
            </div>            
            
          </div>

        </div>
      </div>

      <div class="col-xs-6"> 
        <div class="panel panel-success">


          <div class="panel-heading">
            <h3 class="panel-title">3. Pagos</h3>
          </div>
          
          <div class="panel-body">
            
            <div class="table-responsive">
              <table class="table table-hover table-striped">
                  <thead>
                      <tr>
                          <th>Tipo</th>
                          <th class="text-right">Pago S/</th>
                      </tr>
                  </thead>
                  <tbody>                 
                  @foreach($sale->salePayments as $salePayment)                    
                    <tr>
                      <td>{{ $salePayment->paymenttype->name }}</td>                    
                      <td class="text-right">{{ number_format($salePayment->amountPaid, 1, '.'," ") }}</td>
                    </tr>
                  @endforeach   
                  </tbody>
                  <tfoot>
                    <tr>
                      <td class="text-right"><strong>Pago total</strong></td>
                      <td class="text-right">S/ {{ number_format($sale->totalPayment, 1, '.'," ") }}</td>
                    </tr>
                  </tfoot>
              </table>
            </div>

            <div class="row">
              <div class="col-xs-12 text-center">
                @if ($sale->totalPayment >= $sale->finalAmount)
                  <h4 class="text-success">Sin deuda</h4>
                @else
                  <label class="text-danger">Deuda</label>
                  <h4 class="text-danger">S/ {{ number_format( $sale->finalAmount - $sale->totalPayment, 1, '.'," ") }}</h4>
                @endif
              </div>
            </div>
          </div>

        </div> 
      </div>
    </div>

    <div class="row">
      <div class="panel panel-success">

        <div class="panel-heading">
          <h3 class="panel-title">4. Comprobante</h3>
        </div>
        
        <div class="panel-body">
          <div class="row">
            <div class="col-xs-12 text-center">           
              <a href="{{ action('PDFController@printSale', $sale->idSale) }}" title="Imprimir" target="_blank" class="btn btn-info">
                <span class="glyphicon glyphicon-print" aria-hidden="true" ></span> imprimir
              </a>
              <a class="btn btn-primary" href="{{ action('MenuController@dashBoard') }}">
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