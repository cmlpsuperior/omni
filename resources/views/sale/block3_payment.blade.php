<div class="panel panel-success">

@if ($paymentType!=null)
  <div class="panel-heading">
    <h3 class="panel-title">3. Pago - {{$paymentType->name}}</h3>
  </div>
  
  <div class="panel-body">
    @if ($paymentType->name == 'Efectivo')
    <div class=" row">
      <div class="col-xs-12">
        <label for="">Monto recibido</label>
        <p>S/ {{ $receivedAmount }}</p> 
      </div>              
    </div> 
      
    @elseif ($paymentType->name == 'Deposito')             
    <div class=" row">
      <div class="col-sm-6">
        <label for="">Monto recibido</label>
        <p>S/ {{ $receivedAmount }}</p>
      </div>

      <div class="col-sm-6">
        <label for="">Cuenta bancaria</label>
        <p>{{ $bankAccount->bankName. ' - '. $bankAccount->accountNumber }}</p>        
      </div>
    </div>
    @endif


    <!--To know if there is a debt or change-->
    @if ( $receivedAmount >= $totalAmount + $freight - $discount )
    <div class="row text-center text-success">
      <label for="">Vuelto</label>
      <h4>S/ {{ number_format($receivedAmount - ($totalAmount + $freight - $discount),1, '.',' ') }}</h4>  
    </div>
    @else
    <div class="row text-center text-danger">
      <label for="">Deuda</label>
      <h4>S/ {{ number_format( ($totalAmount + $freight - $discount) - $receivedAmount, 1, '.',' ') }}</h4>
    </div>
    @endif
  </div>

<!--Is a credit-->
@else
  <div class="panel-heading">
    <h3 class="panel-title">3. Pago - Crédito</h3>
  </div>
@endif
</div>