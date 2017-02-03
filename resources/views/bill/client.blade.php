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
          <div class="col-lg-6">
            <div class="form-group">
              <label >Zona</label>
              <h4 >{{ $zone->name }}</h4>
            </div>
          </div>

          <div class="col-lg-6">
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
                      <th>Cantidad</th>
                      <th>Unidad</th>
                      <th>Material</th>
                      <th>P.U. S/</th>
                      <th>Subtotal</th>
                  </tr>
              </thead>
              <tbody>                    
              @foreach($names as $key => $name)
                <tr>
                  <td>{{ $quantitys[$key] }}</td>
                  <td>{{ $units[$key] }}</td>
                  <td>{{ $name }}</td>
                  <td>S/ {{ $prices[$key] }}</td>
                  <td>S/ {{ $prices[$key]*$quantitys[$key] }}</td>
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

    <div class="panel panel-success">

      <div class="panel-heading">
        <h3 class="panel-title">3. Montos</h3>
      </div>

      <div class="panel-body">

        <div class="row">
          <div class="col-xs-6 text-center">
            <div class="form-group">
              <label>Importe total </label><br>
              <h4>S/ {{ number_format($totalAmount, 2, '.'," ") }}</h4>
            </div> 
          </div>

          <div class="col-xs-6 text-center">
            <div class="form-group">
              <label>Importe recibido</label><br>
              <h4>S/ {{ number_format($receivedAmount, 2, '.'," ") }}</h4>
            </div> 
          </div>
        </div>

        @if ( $receivedAmount - $totalAmount >= 0 ) 
        <div class="row">
            <div class="form-group text-center text-success">
              <label>Vuelto</label><br>
              <h4>S/ {{ number_format($receivedAmount - $totalAmount, 2, '.'," ") }}</h4>
            </div>    
        </div>
        @else
        <div class="row">
            <div class="form-group text-center text-danger">
              <label>Deuda</label><br>
              <h4>S/ {{ number_format($totalAmount - $receivedAmount, 2, '.'," ") }}</h4>
            </div>    
        </div>
        @endif

      </div>

    </div>

    <div class="panel panel-primary">

      <div class="panel-heading">
        <h3 class="panel-title">4. Recibo</h3>
      </div>

      <form role="form" action="{{ action('BillController@client_process') }}" method="POST">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">

      <div class="panel-body">
        <div class="row">
          <div class="col-xs-6 col-md-offset-3 text-center">
            <div class="form-group">
              <label for="idBillType">Tipo de recibo *</label>
              <select class="form-control" id="idBillType" name="idBillType" required> 
                <option value="">Seleccionar</option>      
                @foreach ($billTypes as $key => $billType)
                  <option value="{{ $billType->idBillType }}" @if (old('idBillType')==$billType->idBillType) selected @endif>{{ $billType->name }}</option>
                @endforeach
              </select>
            </div> 
          </div>
        </div>

        <!--Pedido-->
        <div class="row" id="divBillPedido">
               <!--Jquery-->     
        </div>

        <!--Boleta-->
        <div class="row" id="divBillBoleta">
                <!--Jquery--> 
        </div> 

        <!--Factura-->
        <div class="row" id="divBillFactura">
                <!--Jquery-->       
        </div>

        <div class="row">
          <div class="col-md-12 text-right">
            <div class="form-group">
              <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" aria-hidden="true" ></span> Registrar</button>
            </div> 
          </div>
        </div>
      </div>

      </form>
    </div>
       
  </div>
  
</div>
@endsection

@section('script')
<script type="text/javascript">
$(document).ready(function() {

  $('#idBillType').on('change', function (e) {
    var optionSelected = $("option:selected", this);
    var valueSelected = this.value;
    var textSelected = optionSelected.text();   
    
    cleanBillTypesData();
    addBillTypeData(textSelected);
  });

});

function addBillTypeData(textSelected){
  if (textSelected == 'Pedido'){
    $('#divBillPedido').append(
                              '<div class="col-xs-6">' +
                                '<div class="form-group">' +
                                  '<label for="namePedido">Nombre cliente</label>' +
                                  '<input class="form-control" id="namePedido" name="namePedido" type="text" >' +
                                '</div>' +
                              '</div>' +

                              '<div class="col-xs-6">' +
                                '<div class="form-group">' +
                                  '<label for="phonePedido">Teléfono</label>' +
                                  '<input class="form-control" id="phonePedido" min="0" name="phonePedido" type="number" >' +
                                '</div>' +
                              '</div>'
                              );
  }
  else if (textSelected == 'Boleta'){
    $('#divBillBoleta').append(
                              '<div class="col-xs-6">' +
                                '<div class="form-group">' +
                                  '<label for="documentNumberBoleta">DNI</label>' +
                                  '<input class="form-control" id="documentNumberBoleta" min="0" name="documentNumberBoleta" type="number" >' +
                                '</div>' +
                              '</div> ' +

                              '<div class="col-xs-6">' +
                                '<div class="form-group">' +
                                  '<label for="nameBoleta">Nombre cliente</label>' +
                                  '<input class="form-control" id="nameBoleta" name="nameBoleta" type="text">' +
                                '</div>' +
                              '</div>' +

                              '<div class="col-xs-6">' +
                                '<div class="form-group">' +
                                  '<label for="phoneBoleta">Teléfono</label>' +
                                  '<input class="form-control" id="phoneBoleta" name="phoneBoleta" type="number" >' +
                                '</div>' +
                              '</div>'
                              );
  }
  else if (textSelected == 'Factura'){
    $('#divBillFactura').append(
                                '<div class="col-xs-6">' +
                                  '<div class="form-group">' +
                                    '<label for="documentNumberFactura">RUC *</label>' +
                                    '<input class="form-control" id="documentNumberFactura" min="0" name="documentNumberFactura" type="number" required>' +
                                  '</div>' +
                                '</div> ' +

                                '<div class="col-xs-6">' +
                                  '<div class="form-group">' +
                                    '<label for="nameFactura">Razón social *</label>' +
                                    '<input class="form-control" id="nameFactura" name="nameFactura" type="text" required>' +
                                  '</div>' +
                                '</div>' +

                                '<div class="col-xs-6">' +
                                  '<div class="form-group">' +
                                    '<label for="legalAddressFactura">Dirección legal *</label>' +
                                    '<input class="form-control" id="legalAddressFactura" name="legalAddressFactura" type="text" required>' +
                                  '</div>' +
                                '</div>' +

                                '<div class="col-xs-6">' +
                                  '<div class="form-group">' +
                                    '<label for="phoneFactura">Teléfono</label>' +
                                    '<input class="form-control" id="phoneFactura" name="phoneFactura" type="number">' +
                                  '</div>' +
                                '</div>'                        
                              );
  }
}

function cleanBillTypesData(){
  $('#divBillPedido').empty();
  $('#divBillBoleta').empty();
  $('#divBillFactura').empty();
}

</script>
@endsection