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
      @include('sale.block3_payment')
      </div>
    </div>

    <div class="row">
      <div class="panel panel-primary">

        <div class="panel-heading">
          <h3 class="panel-title">4. Comprobante</h3>
        </div>

        <div class="panel-body">
          <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#Boleta">Boleta</a></li>
            <li ><a data-toggle="tab" href="#Factura">Factura</a></li>
          </ul>

          <div class="tab-content">
            <!--have to add a new block for every new paymenttype, here are only the 2 first-->
            <div id="Boleta" class="tab-pane fade in active">
              <form role="form" action="{{ action('SaleController@voucher_process') }}" method="POST">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">

              <br>
              <input type="hidden" id="voucherType" name="voucherType" value="Boleta"> 

              <div class="form-group row">
                <div class="col-xs-6">
                  <label for="documentNumber">DNI</label>
                  <input type="number" min="0" class="form-control" id="documentNumber" name="documentNumber" @if ($client != null && $client->names != null) value="{{$client->documentNumber}}" @endif>
                </div>

                <div class="col-xs-6">         
                  <label for="namesVoucher">Nombre cliente</label>
                  <input type="text" class="form-control" id="namesVoucher" name="namesVoucher" @if ($client != null && $client->names != null) value="{{$client->fatherLastName.' '.$client->motherLastName.', '.$client->names}}" @endif>
                </div>
              </div>

              <div class="form-group text-center">          
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Continuar</button>
              </div>

              </form>
            </div>
            
            
            <div id="Factura" class="tab-pane fade">
              <form role="form" action="{{ action('SaleController@voucher_process') }}" method="POST">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">

              <br>
              <input type="hidden" id="voucherType" name="voucherType" value="Factura">  

              <div class="form-group row">
                <div class="col-xs-6">
                  <label for="documentNumber">RUC *</label>
                  <input type="number" min="0" class="form-control" id="documentNumber" name="documentNumber" required @if ($client != null && $client->businessName != null) value="{{ $client->documentNumber }}" @endif>
                </div>

                <div class="col-xs-6">         
                  <label for="namesVoucher">Razón social *</label>
                  <input type="text" class="form-control" id="namesVoucher" name="namesVoucher" required @if ($client != null && $client->businessName != null) value="{{$client->businessName}}" @endif>
                </div>
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

</form>
@endsection