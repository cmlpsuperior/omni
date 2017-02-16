<div class="panel panel-success">

  <div class="panel-heading">
    <h3 class="panel-title">3. Pago</h3>
  </div>

  @if ($paymentType != null)
  <div class="panel-body">
    <ul class="nav nav-tabs">
      <li class="active"><a data-toggle="tab" href="#{{ $paymentType->name }}">{{ $paymentType->name }}</a></li>
    </ul>

    <div class="tab-content">
      @if ($paymentType->name == 'Efectivo')
      <div id="Efectivo" class="tab-pane fade in active">
        <br>
        <div class="form-group">
          <label for="">Monto recibido *</label>
          <p>S/ {{ $receivedAmount }}</p>         
        </div>
      </div>
      
      @elseif ($paymentType->name == 'Deposito')
      <div id="Deposito" class="tab-pane fade in active">
        <br>               
        <div class="form-group">
          <label for="idBankAccount">Cuenta bancária</label>
          <p>{{ $bankAccount->bankName. ' - '. $bankAccount->accountNumber }}</p>        
        </div>

        <div class="form-group">
          <label for="">Monto recibido</label>
          <p>S/ {{ $receivedAmount }}</p>         
        </div>
      </div>
      @endif
    </div>

    @if ( $receivedAmount >= $totalAmount - $discount )
    <div class="form-group text-center text-success">
      <label for="">Vuelto</label>
      <h4>S/ {{ number_format($receivedAmount - ($totalAmount - $discount),2, '.',' ') }}</h4>  
    </div>
    @else
    <div class="form-group text-center text-danger">
      <label for="">Deuda</label>
      <h4>S/ {{ number_format( $totalAmount - $discount - $receivedAmount, 2, '.',' ') }}</h4>
    </div>
    @endif
  </div>          


  @else
  <div class="panel-body">

    <div class="form-group text-center">
      <label for="">No aplica</label>        
    </div>

  </div>

  @endif
</div>