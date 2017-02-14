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

          <div class="panel-body form-horizontal">
            <div class="form-group">
              <label for="totalAmount" class="col-xs-6 control-label">Imp. total</label>
              <div class="col-xs-6">
                <input type="number" class="form-control text-right" id="totalAmount" name="totalAmount" value="{{ number_format($totalAmount, 1, '.','') }}" readonly>
              </div>            
            </div> 
            
            <div class="form-group">
              <label for="discount" class="col-xs-6 control-label">Descuento</label>
              <div class="col-xs-6 ">
                <input type="number" step="0.01" min="0" class="form-control text-right" id="discount" name="discount" >
              </div>            
            </div>

            <div class="form-group text-right">
              <label class="col-xs-12">--------------------</label>                     
            </div>

            <div class="form-group">
              <label for="discount" class="col-xs-6 control-label">Monto final</label>
              <div class="col-xs-6 text-right">
                <h4 id="finalAmount">{{ number_format($totalAmount, 1, '.','') }}</h4>
              </div>            
            </div>            
            
          </div>

          <div class="panel-body">
            <div class="form-group text-center">
              <div class="col-lg-10 col-lg-offset-1">
                <label for="charge" class="control-label">Cobro al *</label>
                <select class="form-control" id="charge" name="charge" required>
                  <option value="">--Seleccionar--</option>
                  <option value="cash">Contado</option>
                  <option value="credit">Crédito</option>
                </select> 
              </div>     
            </div>
          </div>

          <div class="form-group text-center">          
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Continuar</button>
          </div>   

        </div>
      </div>
    </div> <!--end row-->
    
  </div>
</div>  

</form>
@endsection