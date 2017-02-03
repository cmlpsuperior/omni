@extends ('app')
@section ('main')

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Venta N - {{ $bill->idBill }}
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
              <h4 >{{ $bill->zone->name }}</h4>
            </div>
          </div>

          <div class="col-xs-6">
            <div class="form-group">
              <label >Dirección</label>
              <h4 >{{ $bill->shippingAddress }}</h4>
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
              @foreach($bill->items as $key => $item)
                <tr>
                  <td>{{ $item->pivot->quantity }}</td>
                  <td>{{ $item->unit->name }}</td>
                  <td>{{ $item->name }}</td>
                  <td class="text-right">{{ number_format($item->pivot->unitPrice, 1, '.'," ") }}</td>
                  <td class="text-right">{{ number_format($item->pivot->unitPrice * $item->pivot->quantity, 1, '.'," ") }}</td>
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
              <h4>S/ {{ number_format($bill->totalAmount, 2, '.'," ") }}</h4>
            </div> 
          </div>
        </div>
      </div>

    </div>

  </div>

  <div class="col-lg-6">

    <div class="panel panel-success">

      <div class="panel-heading">
        <h3 class="panel-title">3. Montos</h3>
      </div>

      <div class="panel-body">

        <div class="row">
          <div class="col-xs-6 text-center">
            <div class="form-group">
              <label>Importe total </label><br>
              <h4>S/ {{ number_format($bill->totalAmount, 2, '.'," ") }}</h4>
            </div> 
          </div>

          <div class="col-xs-6 text-center">
            <div class="form-group">
              <label>Importe recibido</label><br>
              <h4>S/ {{ number_format($bill->receivedAmount, 2, '.'," ") }}</h4>
            </div> 
          </div>
        </div>

        @if ( $bill->receivedAmount - $bill->totalAmount >= 0 ) 
        <div class="row">
            <div class="form-group text-center text-success">
              <label>Vuelto</label><br>
              <h4>S/ {{ number_format($bill->receivedAmount - $bill->totalAmount, 2, '.'," ") }}</h4>
            </div>    
        </div>
        @else
        <div class="row">
            <div class="form-group text-center text-danger">
              <label>Deuda</label><br>
              <h4>S/ {{ number_format($bill->totalAmount - $bill->receivedAmount, 2, '.'," ") }}</h4>
            </div>    
        </div>
        @endif

      </div>

    </div>

    <div class="panel panel-success">

      <div class="panel-heading">
        <h3 class="panel-title">4. Recibo</h3>
      </div>

      <div class="panel-body">
        <div class="row">
          <div class="col-xs-6 col-xs-offset-3 text-center">
            <div class="form-group">
              <label>Tipo de recibo </label>
              <h4>{{ $bill->billType->name }}</h4>
            </div> 
          </div>
        </div>
        <br>

        @if ( $bill->billType->name == 'Pedido electronico')
        <!--Pedido-->
        <div class="row text-center">
          <div class="col-xs-6">
            <div class="form-group">
              <label>Nombre cliente</label>
              <h4 >{{ $bill->name }}</h4>
            </div>
          </div>

          <div class="col-xs-6">
            <div class="form-group">
              <label>Teléfono</label>
              <h4 >{{ $bill->phone }}</h4>
            </div>
          </div>
        </div>
        <br>

        @elseif ( $bill->billType->name == 'Boleta electronica')
        <!--Boleta-->
        <div class="row text-center">
          <div class="col-xs-6">
            <div class="form-group">
              <label>DNI</label>
              <h4 >{{ $bill->documentNumber }}</h4>
            </div>
          </div>          
        </div>
        <br>

        <div class="row text-center">
          <div class="col-xs-6">
            <div class="form-group">
              <label>Nombre cliente</label>
              <h4 >{{ $bill->name }}</h4>
            </div>
          </div>

          <div class="col-xs-6">
            <div class="form-group">
              <label>Teléfono</label>
              <h4 >{{ $bill->phone }}</h4>
            </div>
          </div>
        </div>
        <br>

        @elseif ( $bill->billType->name == 'Factura electronica')
        <!--Factura-->
        <div class="row text-center">
          <div class="col-xs-6">
            <div class="form-group">
              <label>RUC</label>
              <h4 >{{ $bill->documentNumber }}</h4>
            </div>
          </div>

          <div class="col-xs-6">
            <div class="form-group">
              <label>Razón social</label>
              <h4 >{{ $bill->name }}</h4>
            </div>
          </div>
        </div>
        <br>

        <div class="row text-center">
          <div class="col-xs-6">
            <div class="form-group">
              <label>Dirección legal</label>
              <h4 >{{ $bill->legalAddress }}</h4>
            </div>
          </div>

          <div class="col-xs-6">
            <div class="form-group">
              <label>Teléfono</label>
              <h4 >{{ $bill->phone }}</h4>
            </div>
          </div>
        </div>
        <br>
        @endif

        <div class="row">
          <div class="col-xs-12 text-center">
            <div class="form-group">              
              <a href="{{ action('PDFController@printBill', $bill->idBill) }}" title="Imprimir" target="_blank" class="btn btn-info">
                <span class="glyphicon glyphicon-print" aria-hidden="true" ></span> imprimir
              </a>
              <a class="btn btn-primary" href="{{ action('MenuController@sale') }}">
                <span class="glyphicon glyphicon-ok" aria-hidden="true" ></span> Finalizar
              </a>
            </div> 
          </div>
        </div>

      </div>

    </div>
       
  </div>
  
</div>
@endsection