<!-- Modal -->
<div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form role="form" action="{{ action('OrderController@index') }}" method="GET">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Buscar pedido</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-6">            
              <div class="form-group">
                  <label for="idOrder">Código del pedido</label>
                  <input class="form-control" id="idOrder" name="idOrder" min="1" type="number">
              </div>              
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6">            
              <div class="form-group">
                <label for="idZone">Zona</label>
                <select class="form-control" id="idZone" name="idZone">
                  <option value="">Seleccionar</option>       
                  @foreach ($zones as $key => $zone)
                    <option value="{{ $zone->idZone }}">{{ $zone->name }}</option>
                  @endforeach
                </select>
              </div>              
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Buscar</button>
        </div>

      </form>
    </div>
  </div>
</div>