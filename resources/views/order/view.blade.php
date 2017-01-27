@extends ('app')
@section ('main')

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Pedido N° {{ $order->idOrder }}
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
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Datos del cliente</h3>
      </div>
      <div class="panel-body">        

        <div class="row">
          <div class="col-lg-6">
            <div class="form-group">
              <label for="idZone">Zona</label>
              <select class="form-control" id="idZone" name="idZone" readonly> 
                <option value="{{ $order->zone->idZone }}" selected>{{ $order->zone->name }}</option>
              </select>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="form-group">
              <label for="address">Dirección</label>
              <input class="form-control" id="address" name="address" type="text" value="{{ $order->address }}" readonly>
            </div>
          </div>
        </div>

        <div class="row">

          <div class="col-lg-6">
            <div class="form-group">
              <label for="name">Nombre</label>
              <input class="form-control" id="name" name="name" type="text" value="{{ $order->name }}" readonly>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="form-group">
              <label for="phone">Teléfono</label>
              <input class="form-control" id="phone" name="phone" type="number" value="{{ $order->phone }}" readonly>
            </div>
          </div>

        </div>
        
      </div>
    </div>
    
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Lista de materiales</h3>
      </div>
      <div class="panel-body"> 
        <div class="table-responsive">
          <table class="table table-hover table-striped" id="tblItems">
              <thead>
                <tr>
                    <th>Cantidad</th>
                    <th>Unidad</th>
                    <th>Material</th>
                    <th>P.U. S/</th>
                    <th>Subtotal</th>
                    
                </tr>
              </thead>
              <tbody>                    
              @foreach($order->items as $item)
                <tr>
                  <td>{{ $item->pivot->quantity }}</td>
                  <td>{{ $item->unit->name }}</td>
                  <td>{{ $item->name }}</td>
                  <td>S/ {{ $item->pivot->unitPrice }}</td>
                  <td>S/ {{ $item->pivot->quantity*$item->pivot->unitPrice }}</td>
                </tr>
              @endforeach   
              </tbody>
          </table>
        </div> 

      </div>
    </div>

  </div>

  <div class="col-lg-6">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Resumen</h3>
      </div>
      <div class="panel-body">

        <div class="row">
          <div class="col-md-12">
            <div class="form-group text-center">
              <label>Importe total</label><br>
              <label>S/ {{ number_format($order->totalAmount, 2, '.'," ") }}</label>
            </div> 
          </div>
        </div>
        
        <div class="row">
          <div class="col-md-12">
            <div class="form-group text-center">
              <label>Importe recibido</label><br>
              <label>S/ {{ number_format($order->receivedAmount, 2, '.'," ") }}</label>
            </div> 
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group text-center">
              <label>Vuelto</label><br>
              <label>S/ {{ number_format($change, 2, '.'," ") }}</label>              
            </div>
          </div>

          <div class="col-sm-6">
            <div class="form-group text-center">
              <label>Deuda</label><br>
              <label>S/ {{ number_format($debt, 2, '.'," ") }}</label>              
            </div> 
          </div>
        </div>

        <div class="row">
          <div class="col-md-12 text-center">
            <div class="form-group">              
              <a href="{{action('PDFController@order', ['id'=>$order->idOrder])}}" title="Imprimir" target="_blank" class="btn btn-info">
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


</form>
@endsection
