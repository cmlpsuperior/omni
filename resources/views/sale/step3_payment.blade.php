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

<form role="form" action="{{ action('SaleController@amounts_process') }}" method="POST">
<input type="hidden" name="_token" value="{{ csrf_token() }}">

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

  $('#discount').on('keyup', function (e) {
    var discount = $("#discount").val();
    updateFinalAmount(discount);
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

function updateFinalAmount(discount){
  var amount = $("#totalAmount").val();
  var finalAmount = amount - discount;
  //alert(amount + ' - ' + discount + ' = '+ finalAmount );
  $('#finalAmount').text('S/ ' + finalAmount.toFixed(1));
}
</script>
@endsection