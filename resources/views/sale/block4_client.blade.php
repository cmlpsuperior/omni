<div class="panel panel-success">

  <div class="panel-heading">
    <h3 class="panel-title">4. Cliente</h3>
  </div>


  @if ($client != null)
  <div class="panel-body">
    <ul class="nav nav-tabs">
      <li class="active"><a data-toggle="tab" href="#{{ $clientType }}">{{ $clientType }}</a></li>
    </ul>

    <div class="tab-content">
      
      @if ($clientType== 'Persona')
      <div id="Persona" class="tab-pane fade in active">
        <br>

        <div class="form-group row">
          <div class="col-xs-6">
            <label for="">DNI</label>
            <p>{{ $client->documentNumber }}</p>
          </div>
          <div class="col-xs-6">         
            <label for="">Teléfono </label>
            <p>{{ $client->phone }}</p>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-xs-12">         
            <label for="">Nombre completo</label>
            <p>{{ $client->fatherLastName .' '. $client->motherLastName . ', '.$client->names }}</p>
          </div>
        </div>
      </div>
      


      @elseif ($clientType== 'Empresa')
      <div id="company" class="tab-pane fade in active">
        <br>

        <div class="form-group row">
          <div class="col-xs-6">
            <label for="">RUC</label>
            <p>{{ $client->documentNumber }}</p>
          </div>

          <div class="col-xs-6">         
            <label for="">Teléfono </label>
            <p>{{ $client->phone }}</p>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-xs-12">         
            <label for="">Razón social *</label>
            <p>{{ $client->businessName }}</p>
          </div>          
        </div>
      </div>              
      @endif

    </div>
  </div>


  @else
  <div class="panel-body">
    <div class="form-group row">
      <div class="col-xs-12 text-center"> 
        <label for="">No aplica</label>
      </div>
    </div>
  </div>

  @endif
</div>