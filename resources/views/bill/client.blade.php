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
    @include('bill.block1_shipping')
    @include('bill.block2_items')
  </div>

  <div class="col-lg-6">

    @include('bill.block3_receivedAmount')

    <div class="panel panel-primary">

      <div class="panel-heading">
        <h3 class="panel-title">4. Recibo</h3>
      </div>

      <form role="form" action="{{ action('BillController@client_process') }}" method="POST">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">

      <div class="panel-body">
        <div class="row">
          <div class="col-xs-6 col-xs-offset-3 text-center">
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
        <div class="row" id="divBillPedidoElectronico">
               <!--Jquery-->     
        </div>

        <!--Boleta-->
        <div class="row" id="divBillBoletaElectronica">
                <!--Jquery--> 
        </div> 

        <!--Factura-->
        <div class="row" id="divBillFacturaElectronica">
                <!--Jquery-->       
        </div>

        <!--Por recoger-->
        <div class="" id="divBillPorRecoger">
                <!--Jquery-->       
        </div>

        <div class="row">
          <div class="col-md-12 text-center">
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
  if (textSelected == 'Pedido electronico'){
    $('#divBillPedidoElectronico').append(
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
  else if (textSelected == 'Boleta electronica'){
    $('#divBillBoletaElectronica').append(
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
  else if (textSelected == 'Factura electronica'){
    $('#divBillFacturaElectronica').append(
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
  else if (textSelected == 'Por recoger'){
  $('#divBillPorRecoger').append(
                            '<div class="row">' +
                              '<div class="col-xs-6">' +
                                '<div class="form-group">' +
                                  '<label for="documentNumberPorRecoger">DNI *</label>' +
                                  '<input class="form-control" id="documentNumberPorRecoger" min="0" name="documentNumberPorRecoger" type="number" required>' +
                                '</div>' +
                              '</div> ' +

                              '<div class="col-xs-6">' +
                                '<div class="btn-toolbar">' +
                                  '<label for=""></label><br>' +
                                  '<a  class="btn btn-info"><span class="glyphicon glyphicon-ok" aria-hidden="true" ></span> Verificar</a>'+
                                  //'<a  class="btn btn-info"><span class="glyphicon glyphicon-plus" aria-hidden="true" ></span> Nuevo</a>'+                               
                                '</div>' +
                              '</div>' +
                            '</div>' +

                            '<div class="row">' +
                              '<div class="col-xs-6">' +
                                '<div class="form-group">' +
                                  '<label for="namePorRecoger">Nombre cliente</label>' +
                                  '<input class="form-control" id="namePorRecoger" name="namePorRecoger" type="text" readonly>' +
                                '</div>' +
                              '</div>' +
                            '</div>'                    
                            );
  }
}

function cleanBillTypesData(){
  $('#divBillPedidoElectronico').empty();
  $('#divBillBoletaElectronica').empty();
  $('#divBillFacturaElectronica').empty();
  $('#divBillPorRecoger').empty();
}

</script>
@endsection