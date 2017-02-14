<div class="panel panel-success">
  <div class="panel-heading">
    <h3 class="panel-title">2. Montos</h3>
  </div>

  <div class="panel-body form-horizontal">
    <div class="form-group">
      <label for="totalAmount" class="col-xs-6 control-label">Imp. total</label>
      <div class="col-xs-6 text-right">
        <h4> {{ number_format($totalAmount, 1, '.','') }}</h4>
      </div>            
    </div> 
    
    <div class="form-group">
      <label for="discount" class="col-xs-6 control-label">Descuento</label>
      <div class="col-xs-6 text-right ">
        <h4> {{ number_format($discount, 1, '.','') }}</h4>
        
      </div>            
    </div>

    <div class="form-group text-right">
      <label class="col-xs-12">--------------------</label>                     
    </div>

    <div class="form-group">
      <label for="discount" class="col-xs-6 control-label">Monto final</label>
      <div class="col-xs-6 text-right">
        <h4 id="finalAmount">{{ number_format($totalAmount - $discount, 1, '.','') }}</h4>
      </div>            
    </div>            
    
  </div>

  <div class="panel-body">
    <div class="form-group text-center">
      <div class="col-lg-10 col-lg-offset-1">
        <label for="charge" class="control-label">Cobro al *</label>
        @if ($charge == 'credit')
          <h4>Crédito</h4>
        @elseif ($charge == 'cash')
          <h4>Contado</h4>
        @endif
      </div>     
    </div>
  </div> 

</div>