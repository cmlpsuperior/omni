@extends ('app')
@section ('main')

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Modificar material
        </h1>
        <ol class="breadcrumb">
            <li class="">
                <i class="fa"></i>Materiales
            </li>
            <li class="active">
                <i class="fa"></i>Modificar material
            </li>
        </ol>
    </div>
</div>

<!--Errors-->
@if (count($errors)>0)
  @foreach ($errors -> all() as $error)
  <div class="form-group row">
    <div class="col-md-6">                        
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>{{$error}}</strong>
        </div>
    </div>
  </div>
  @endforeach
@endif

<form role="form" action="{{ action('ItemController@update', ['id'=>$item->idItem]) }}" method="POST">
<input type="hidden" name="_method" value="PUT">
<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="row">
  <div class="col-lg-6">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Datos del material</h3>
      </div>
      <div class="panel-body">
        <div class="form-group">
          <label for="idUnit">Unidad de medida *</label>
          <select class="form-control" id="idUnit" name="idUnit" required> 
            <option value="">Seleccionar</option>      
            @foreach ($units as $key => $unit)
              <option value="{{ $unit->idUnit }}" @if ($item->idUnit==$unit->idUnit) selected @endif>{{ $unit->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
            <label for="name">Nombre *</label>
            <input class="form-control" id="name" name="name" type="text" required value="{{ $item->name }}">
        </div>
        <div class="form-group">
            <label for="price">Precio base S/ *</label>
            <input class="form-control" id="price" name="price" type="number" min="0" step="0.01" required value="{{ $item->price }}">
        </div>

      </div>
    </div> 
  </div> 

  <div class="col-lg-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Precio por zona</h3>
      </div>
      <div class="panel-body" id="divAllPriceZones">
        <!--List all the prices by zone that exist-->
        @foreach ($item->zones as $zone)

        <div class="row" id="divPriceZone-'+index+'">
          <div class="col-xs-5">
            <div class="form-group">
              <label for="idZones[]"> Zona *</label> 
              <select class="form-control" id="idZones[]" name="idZones[]" readonly> 
                <option value="{{ $zone->idZone }}">{{ $zone->name }}</option>
              </select>
            </div>
          </div>

          <div class="col-xs-4">
            <div class="form-group">
              <label for="prices[]">Precio S/ *</label>
              <input class="form-control" id="prices[]" name="prices[]" type="number" min="0" step="0.01" required value="{{ $zone->pivot->price }}">
            </div> 
          </div>

          
        </div>

        @endforeach

        <div class="row" id="divButtonAdd">
          <div class="col-xs-5">
            
          </div>

          <div class="col-xs-4">
            
          </div>

          <div class="col-xs-3">
            <div class="form-group">
              <label for=""></label><br>
              <a class="btn btn-primary text-down" id="btnAdd" title="Editar">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
              </a>              
            </div> 
          </div>
        </div>

      </div>
    </div>
  </div>

</div>  


<div class="row">
  <div class="col-lg-12">
    <div class="form-group text-center">
      <a class="btn btn-danger" href="{{ action('ItemController@index') }}"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar</a>
      <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Registrar</button>
    </div>
  </div>
</div>

</form>
@endsection

@section ('script')
<script>    

  $(document).ready(function() {     
    index = 0; //global variable   

    $(document).on ('click','#btnAdd',function(){ //is that way, couse buttons added by append has to work too
      removeOldBtnAdd();  
      addPriceZone();
    });    
    
  });  
  
  function addPriceZone(){
    index++; //up index that will identify a unique div
    var newRow =  '<div class="row" id="divPriceZone-'+index+'"> '+
                    '<div class="col-xs-5"> '+
                      '<div class="form-group"> ' +
                        '<label for="idZones[]"> Zona *</label> ' +
                        '<select class="form-control" id="idZones[]" name="idZones[]" required> '+ 
                          '<option value="">Seleccionar</option>  '+    
                          '@foreach ($zones as $key => $zone) '+
                            '<option value="{{ $zone->idZone }}">{{ $zone->name }}</option> '+
                          '@endforeach '+
                        '</select> '+
                      '</div> '+
                    '</div> '+

                    '<div class="col-xs-4"> '+
                      '<div class="form-group"> '+
                        '<label for="prices[]">Precio S/ *</label> '+
                        '<input class="form-control" id="prices[]" name="prices[]" type="number" min="0" step="0.01" required value="{{ $item->price }}"> '+
                      '</div>  '+
                    '</div> '+

                    '<div class="col-xs-3"> '+
                      '<div class="form-group"> '+
                        '<label for=""></label><br> '+
                        '<a class="btn btn-danger" onclick="deleteDivPriceZone('+index+')" title="Quitar"> '+
                          '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> '+
                        '</a>  '+        
                      '</div> '+
                    '</div> '+
                  '</div> ' +

                  '<div class="row" id="divButtonAdd"> '+
                    '<div class="col-xs-5"> '+                      
                      
                    '</div> '+

                    '<div class="col-xs-4"> '+
                      
                    '</div> '+

                    '<div class="col-xs-3"> '+
                      '<div class="form-group"> '+
                        '<label for=""></label><br> '+
                        '<a class="btn btn-primary" id="btnAdd" title="Agregar"> '+
                          '<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> '+
                        '</a>  '+        
                      '</div> '+
                    '</div> '+
                  '</div> ' ;
    $('#divAllPriceZones').append (newRow);
  }

  function removeOldBtnAdd() {
    $('#divButtonAdd').remove();
  }
  function deleteDivPriceZone(index){
    $('#divPriceZone-'+index).remove();
  }
</script>

@endsection