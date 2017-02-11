<div class="panel panel-success">

  <div class="panel-heading">
    <h3 class="panel-title">1. Datos del envío</h3>
  </div>

  <div class="panel-body">
    
    <div class="row">
      <div class="col-xs-6">
        <div class="form-group">
          <label >Zona</label>
          <h4 >{{ $zone->name }}</h4>
        </div>
      </div>

      <div class="col-xs-6">
        <div class="form-group">
          <label for="shippingAddress">Dirección</label>
          <input class="form-control" type="text" name="shippingAddress" id ="shippingAddress" value="{{ $shippingAddress }}">
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-6">
        <div class="form-group">
          
        </div>
      </div>

      <div class="col-xs-6">
        <div class="form-group">
          <label for="shippingDate">Fecha envío</label>          
          <input type="date" class="form-control" id='shippingDate' name="shippingDate" value="{{ $shippingDate }}">
        </div>
      </div>
    </div>
  </div>
</div>