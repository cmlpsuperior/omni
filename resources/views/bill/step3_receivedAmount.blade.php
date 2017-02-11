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

<form role="form" action="{{ action('BillController@receivedAmount_process') }}" method="POST">
<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="row">
  <div class="col-lg-6">
    @include('bill.block1_shipping')
    @include('bill.block2_items')
  </div>

  <div class="col-lg-6">
    <div class="panel panel-primary">
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
              <label for="receivedAmount">Importe recibido S/</label><br>
              <input class="form-control" id="receivedAmount" name="receivedAmount" type="number" min="0" step="0.01" value="{{ old('receivedAmount') }}" required>
            </div> 
          </div>          
        </div>

        <br><br>
        
        <div class="row">
          <div class="col-xs-6 col-xs-offset-3 text-center">
            <div class="form-group">
              <label for="idBillType">Transacción *</label>
              <select class="form-control" id="idBillType" name="idBillType" required> 
                <option value="">Seleccionar</option>      
                @foreach ($billTypes as $key => $billType)
                  <option value="{{ $billType->idBillType }}">{{ $billType->name }}</option>
                @endforeach
              </select>
            </div> 
          </div>
        </div>


        <div class="row" id="divBillPedido">
          <!--Jquery-->
        </div>

        <div class="row" id="divBillPorRecoger">
          <!--Jquery-->
        </div>

        <div class="row" id="divBillCredito">
          <!--Jquery-->
        </div>

        <div class="form-group text-center">          
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Continuar</button>
        </div>        
      </div>
    </div>
  </div>  
</div>
</form>
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
  if ( textSelected == 'Pedido' || textSelected == 'Credito' ){
    $('#divBillPedido').append( 
        '<div class="col-xs-6 col-xs-offset-3 text-center">'+
          '<div class="form-group">'+
            '<label for="voucher">Comprobante *</label>'+
            '<select class="form-control" id="voucher" name="voucher" required>'+
              '<option value="">Seleccionar</option>'    +
              '<option value="Ninguno">Ninguno</option>'    +
              '<option value="Boleta">Boleta</option>'    +
              '<option value="Factura">Factura</option>'    +
            '</select>'+
          '</div>'+
        '</div>'
      );
  }
}

function cleanBillTypesData(){
  $('#divBillPedido').empty();
  $('#divBillCredito').empty();
  $('#divBillPorRecoger').empty();
}
</script>
@endsection