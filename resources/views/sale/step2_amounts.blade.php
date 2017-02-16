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
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">2. Montos</h3>
          </div>

          <div class="panel-body">
            <div class="form-group row">
              <label for="totalAmount" class="col-xs-6 control-label text-right">Imp. total</label>
              <div class="col-xs-6">
                <input type="number" class="form-control text-right" id="totalAmount" name="totalAmount" value="{{ number_format($totalAmount, 1, '.','') }}" readonly>
              </div>            
            </div> 
            
            <div class="form-group row">
              <label for="freight" class="col-xs-6 control-label text-right">Flete</label>
              <div class="col-xs-6 ">
                <input type="number" step="0.01" min="0" class="form-control text-right" id="freight" name="freight" >
              </div>            
            </div>

            <div class="form-group row">
              <label for="discount" class="col-xs-6 control-label text-right">Desc.</label>
              <div class="col-xs-6 ">
                <input type="number" step="0.01" min="0" class="form-control text-right" id="discount" name="discount" >
              </div>            
            </div>

            <div class="form-group row text-right">
              <label class="col-xs-12">--------------------</label>                     
            </div>

            <div class="form-group row">
              <label for="discount" class="col-xs-6 control-label text-right">Monto final</label>
              <div class="col-xs-6 text-right">
                <h4 id="finalAmount">S/ {{ number_format($totalAmount, 1, '.','') }}</h4>
              </div>            
            </div>            
            
          </div>

          <div class="form-group row text-center">          
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Continuar</button>
          </div>   

        </div>
      </div>
    </div> <!--end row-->
    
  </div>
</div>  

</form>
@endsection

@section('script')
<script type="text/javascript">
$(document).ready(function() {
  $('#discount').on('keyup', function (e) {
    updateFinalAmount();
  });

  $('#freight').on('keyup', function (e) {
    updateFinalAmount();
  });
});

function updateFinalAmount(){
  var totalAmount = Number ($("#totalAmount").val() );
  var discount = Number( $("#discount").val() );
  var freight = Number( $("#freight").val() );

  var finalAmount = totalAmount + freight - discount;
  $('#finalAmount').text('S/ ' + finalAmount.toFixed(1));
}
</script>
@endsection