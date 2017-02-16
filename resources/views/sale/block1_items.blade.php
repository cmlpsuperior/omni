<div class="panel panel-success">

  <div class="panel-heading">
    <h3 class="panel-title">1. Lista de materiales</h3>
  </div>

  <div class="panel-body">
    <div class="row">
      <div class="col-xs-6">
        <div class="form-group">
          <label for="totalAmount">Zona</label>
          <p>{{ $zone->name }}</p>
        </div> 
      </div>
      
      <div class="col-xs-6">
        <div class="form-group">
          <label for="totalAmount">Flete sugerido</label>
          <p>S/ {{ $zone->shipping }}</p>
        </div> 
      </div>

    </div>
    <br>

    <div class="table-responsive">
      <table class="table table-hover table-striped">
          <thead>
              <tr>
                  <th>Cant.</th>
                  <th>Unidad</th>
                  <th>Material</th>
                  <th>P.U. S/</th>
                  <th>Subtotal S/</th>
              </tr>
          </thead>
          <tbody>                    
          @foreach($names as $key => $name)
            <tr>
              <td>{{ $quantitys[$key] }}</td>
              <td>{{ $units[$key] }}</td>
              <td>{{ $name }}</td>
              <td class="text-right">{{ number_format($prices[$key], 1, '.'," ") }}</td>
              <td class="text-right">{{ number_format($prices[$key]*$quantitys[$key], 1, '.'," ") }}</td>
            </tr>
          @endforeach   
          </tbody>
      </table>
    </div>

    <br>
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="form-group text-center">
          <label >Importe total </label><br>
          <h4>S/ {{ number_format($totalAmount, 2, '.'," ") }}</h4>
        </div> 
      </div>
    </div>
  </div>

</div>