<div class="panel panel-success">

  <div class="panel-heading">
    <h3 class="panel-title">4. Comprobante</h3>
  </div>

  <div class="panel-body">
    
    @if ($voucherType == 'Boleta')
    <div class="form-group row">
      <div class="col-xs-6">
        <label for="">DNI</label>
        <p>{{ $documentNumber}}</p><!--have to finish first the table Voucher...............-->
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