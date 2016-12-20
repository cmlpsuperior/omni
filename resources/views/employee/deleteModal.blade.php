<!-- Modal -->
<div class="modal fade" id="deleteModal-{{$employee->idEmployee}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form role="form" action="{{ action('EmployeeController@destroy', ['id'=>$employee->idEmployee]) }}" method="POST">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Borrar empleado</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-12">            
              <div class="form-group">
                <p>¿Está seguro que decea eliminar el empleado?</p>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Eliminar</button>
        </div>

      </form>
    </div>
  </div>
</div>