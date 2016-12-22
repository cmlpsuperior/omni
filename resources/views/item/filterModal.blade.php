<!-- Modal -->
<div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form role="form" action="{{ action('ItemController@index') }}" method="GET">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Buscar material</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-6">            
              <div class="form-group">
                  <label for="name">Nombre</label>
                  <input class="form-control" id="name" name="name" type="text">
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