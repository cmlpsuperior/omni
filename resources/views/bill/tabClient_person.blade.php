<div class="tab-content">
  <div role="tabpanel" class="tab-pane active" id="client">
    <div class="row">
      <div class="col-xs-6">
      	<div class="form-group">
	      	<label for="documentNumber">DNI *</label>
	      	<input class="form-control" id="documentNumber" name="documentNumber" type="text">
	     </div>
      </div>

      <div class="col-xs-6">
      	<div class="form-group">
	      	<label for="shippingAddress">RUC *</label>
	      	<input class="form-control" id="shippingAddress" name="shippingAddress" type="text" value="{{ old('shippingAddress') }}">
	     </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-6">
      	<div class="form-group">
	      	<label for="nameRead">Nombre cliente</label>
	      	<input class="form-control" id="nameRead" name="nameRead" type="text">
	     </div>
      </div>

      <div class="col-xs-6">
      	<div class="form-group">
	      	<label for="shippingAddress"></label>
	      	<input class="form-control" id="shippingAddress" name="shippingAddress" type="text" value="{{ old('shippingAddress') }}">
	     </div>
      </div>
    </div>
  </div>
</div>
