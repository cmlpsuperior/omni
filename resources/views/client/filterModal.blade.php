<!-- Modal -->
<div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form role="form" action="{{ action('ClientController@index') }}" method="GET">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Buscar cliente</h4>
        </div>
        <div class="modal-body">

          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                  <label for="documentNumber">RUC / DNI</label>
                  <input class="form-control" id="documentNumber" name="documentNumber" type="number" min="0" value="{{ old('documentNumber') }}">
              </div>
            </div>
          </div>
          <br>

          <div class="row">
            <div class="col-lg-6">            
              <div class="form-group">
                  <label for="names">Nombres</label>
                  <input class="form-control" id="names" name="names" type="text" value="{{ old('names') }}">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-6">            
              <div class="form-group">
                  <label for="fatherLastName">Apellido paterno</label>
                  <input class="form-control" id="fatherLastName" name="fatherLastName" type="text" value="{{ old('fatherLastName') }}">
              </div>
            </div>
            <div class="col-lg-6"> 
              <div class="form-group">
                  <label for="motherLastName">Apellido Materno</label>
                  <input class="form-control" id="motherLastName" name="motherLastName" type="text" value="{{ old('motherLastName') }}">
              </div>
            </div>            
          </div>
          <br>

          <div class="row">
            <div class="col-lg-6">            
              <div class="form-group">
                  <label for="businessName">Razón social</label>
                  <input class="form-control" id="businessName" name="businessName" type="text" value="{{ old('businessName') }}">
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