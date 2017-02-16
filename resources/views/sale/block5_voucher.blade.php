<div class="panel panel-success">

  <div class="panel-heading">
    <h3 class="panel-title">5. Comprobante - {{mb_strtoupper($voucherType)}}</h3>
  </div>

  <div class="panel-body">
    @if ($voucherType == 'Boleta')
    <div class="form-group row">
      <div class="col-xs-6">
        <label for="documentNumber">DNI</label>
        <p>{{$documentNumber}}</p>
      </div>

      <div class="col-xs-6">         
        <label for="namesVoucher">Nombre cliente</label>
        <p>{{$namesVoucher}}</p>
      </div>
    </div>


    @elseif ($voucherType == 'Factura')      
      
    <div class="form-group row">
      <div class="col-xs-6">
        <label for="">RUC *</label>
        <p>{{$documentNumber}}</p>
      </div>

      <div class="col-xs-6">         
        <label for="">Razón social *</label>
        <p>{{$namesVoucher}}</p>
      </div>
    </div>

    @endif
  </div> 

</div>