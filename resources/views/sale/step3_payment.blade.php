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
    @include('sale.block1_items')
  </div>

  <div class="col-lg-6">

    <div class="row">
      <div class="col-xs-6">
        @include('sale.block2_amounts')
      </div>

      <div class="col-xs-6">

        
        <div class="panel panel-primary">

          <div class="panel-heading">
            <h3 class="panel-title">3. Pago</h3>
          </div>

          <div class="panel-body">
            <ul class="nav nav-tabs">
              @foreach($paymentTypes as $key => $paymentType)
                <li @if ($key == 0) class="active" @endif><a data-toggle="tab" href="#{{ $paymentType->name }}">{{ $paymentType->name }}</a></li>
              @endforeach
            </ul>

            <div class="tab-content">
              <!--have to add a new block for every new paymenttype, here are only the 2 first-->
              <div id="{{ $paymentTypes[0]->name }}" class="tab-pane fade in active">
                <form role="form" action="{{ action('SaleController@payment_process') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <br>
                <input type="hidden" id="idPaymentType" name="idPaymentType" value="{{ $paymentTypes[0]->idPaymentType }}"> 

                <div class="form-group">
                  <label for="receivedAmount">Monto recibido *</label>
                  <input type="number" step="0.01" min="0" class="form-control text-right" id="receivedAmount" name="receivedAmount" required>          
                </div>

                <div class="form-group text-center">          
                  <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Continuar</button>
                </div> 
                </form>
              </div>
              

              
              <div id="{{ $paymentTypes[1]->name }}" class="tab-pane fade">
                <form role="form" action="{{ action('SaleController@payment_process') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <br>
                <input type="hidden" id="idPaymentType" name="idPaymentType" value="{{ $paymentTypes[1]->idPaymentType }}"> 

                <div class="form-group">
                  <label for="idBankAccount">Cuenta bancária *</label>
                  <select class="form-control" id="idBankAccount" name="idBankAccount" required>
                    <option value="">--Seleccionar--</option>
                    @foreach ( $bankAccounts as $bankAccount )
                      <option value="{{ $bankAccount->idBankAccount }}">{{ $bankAccount->bankName .' - ' . $bankAccount->AccountNumber }}</option>
                    @endforeach
                  </select>         
                </div>

                <div class="form-group">
                  <label for="receivedAmount">Monto recibido *</label>
                  <input type="number" step="0.01" min="0" class="form-control text-right" id="receivedAmount" name="receivedAmount" required>          
                </div>

                <div class="form-group text-center">          
                  <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Continuar</button>
                </div> 
                </form>
              </div>              

            </div>
          </div>          

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
  $('#paymentType').on('change', function (e) {
    var optionSelected = $("option:selected", this);
    var valueSelected = this.value;
    var textSelected = optionSelected.text();   
    
    cleanPaymentData();
    addPaymentData(valueSelected);
  });
});

function addPaymentData(valueSelected){
  if ( valueSelected == 'cash' ){
    $('#divCash').append(
      '<label for="receivedAmount" class="col-xs-4 col-sm-4 control-label">Importe recibido</label>'+
      '<div class="col-xs-8 col-sm-6">'+
        '<input type="number" step="0.01" min="0" class="form-control text-right" id="receivedAmount" name="receivedAmount" >'+
      '</div>'

      );
  }
}

function cleanPaymentData(){
  $('#divCash').empty();
  $('#divCredit').empty();
}

</script>
@endsection