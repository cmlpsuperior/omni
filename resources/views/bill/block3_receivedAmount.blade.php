<div class="panel panel-success">

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
          <label>Importe recibido</label><br>
          <h4>S/ {{ number_format($receivedAmount, 2, '.'," ") }}</h4>
        </div> 
      </div>
    </div>

    @if ( $receivedAmount - $totalAmount >= 0 ) 
    <div class="row">
        <div class="form-group text-center text-success">
          <label>Vuelto</label><br>
          <h4>S/ {{ number_format($receivedAmount - $totalAmount, 2, '.'," ") }}</h4>
        </div>    
    </div>
    @else
    <div class="row">
        <div class="form-group text-center text-danger">
          <label>Deuda</label><br>
          <h4>S/ {{ number_format($totalAmount - $receivedAmount, 2, '.'," ") }}</h4>
        </div>    
    </div>
    @endif

  </div>

</div>