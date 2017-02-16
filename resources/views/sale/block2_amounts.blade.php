<div class="panel panel-success">
  <div class="panel-heading">
    <h3 class="panel-title">2. Montos</h3>
  </div>

  <div class="panel-body form-horizontal">
    <div class=" row">
      <label for="" class="col-xs-6 text-right">Imp. total</label>
      <div class="col-xs-6 text-right">
        <p> {{ number_format($totalAmount, 1, '.','') }}</p>
      </div>            
    </div>

    <div class=" row">
      <label for="" class="col-xs-6 text-right">Flete</label>
      <div class="col-xs-6 text-right ">
        <p> {{ number_format($freight, 1, '.','') }}</p>        
      </div>            
    </div>

    <div class=" row">
      <label for="" class="col-xs-6 text-right">Desc.</label>
      <div class="col-xs-6 text-right ">
        <p> {{ number_format($discount, 1, '.','') }}</p>        
      </div>            
    </div>

    <div class="row text-right">
      <p class="col-xs-12">--------------------</p>                     
    </div>

    <div class="row">
      <label for="" class="col-xs-6 text-right">Monto final</label>
      <div class="col-xs-6 text-right">
        <h4 id="">S/ {{ number_format($totalAmount + $freight - $discount, 1, '.',' ') }}</h4>
      </div>            
    </div>            
    
  </div>

</div>