@extends ('app')
@section ('main')

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Nueva venta
        </h1>
    </div>
    <hr />
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

<div class="row">
  <div class="col-lg-6">    
    
    <form role="form" action="{{ action('SaleController@items_process') }}" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">1. Lista de materiales</h3>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-xs-6">
            <div class="form-group">
              <label for="totalAmount">Zona </label>
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
          <table class="table table-hover table-striped" id="tblItems">
              <thead>
                  <tr>
                      <th>Cant.</th>
                      <th>Unidad</th>
                      <th>Material</th>
                      <th>P.U. S/</th>
                      <th>Subtotal S/</th>
                      <th></th>
                  </tr>
              </thead>
              <tbody>                    
                  <!--Here is AJAX-->
              </tbody>
          </table>
        </div>

        <br>
        <div class="row">
          <div class="col-xs-6 col-xs-offset-3">
            <div class="form-group">
              <label for="totalAmount">Importe total S/</label><br>
              <input class="form-control" id="totalAmount" name="totalAmount" type="number" step="0.01" readonly>
            </div> 
          </div>
        </div>   

        <div class="row">
          <div class="col-md-12 text-center">
            <div class="form-group">
              <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" aria-hidden="true" ></span> Continuar</button>
            </div> 
          </div>
        </div>

      </div>
    </div>

    </form>    

  </div>

  <div class="col-lg-6">
    
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Buscar materiales</h3>
      </div>
      <div class="panel-body"> 
        <div class="row">
          <div class="col-lg-8">
            <div class="form-group">
              <label for="nameSearch">Material</label>
              <input class="form-control" id="nameSearch" name="nameSearch" type="text" placeholder="pj. piedra chancada">
            </div>
          </div>          
        </div>        

        <div class="table-responsive">
          <table class="table table-hover table-striped" id="tblSearchItem">
              <thead>
                  <tr>
                      <th>Cantidad</th>
                      <th>Unidad</th>
                      <th>Material</th>
                      <th>P.U. S/</th>                      
                  </tr>
              </thead>
              <tbody>                    
                  <!--Here is AJAX-->
              </tbody>
          </table>
        </div>        

        <div class="form-group text-right">
          <label for=""></label><br>
          <a class="btn btn-info" id="btnAddItem"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar</a>
        </div>

      </div>
    </div>
       
  </div>
  
</div>
@endsection

@section('script')
<script type="text/javascript">
$(document).ready(function() {
  index=0;

  //begin: AJAX to search items
  $("#nameSearch").keyup(function(){
    var nameSearch = $("#nameSearch").val();
    var idZone = $("#idZone").val();
    var myUrl=  "{{ url('item/searchItem') }}";
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');      

    $.ajax({        
      type: "GET",   
      url: myUrl,
      dataType : "JSON",
      data: {
          nameSearch: nameSearch,
          idZone: idZone,
          _token: CSRF_TOKEN
      },
      success: function(data){
        $('#tblSearchItem tbody').empty();
        $.each(data.items, function(k, value){
          $('#tblSearchItem').append( '<tr>'+
                                        '<td><input id="quantityItemSearched" type="number" step="0.5" min="0.5"></td>'+
                                        '<td>'+value.unit.name+'</td>'+
                                        '<td>'+value.name+'</td>'+
                                        '<td><input type="number" step="0.01" min="0" value="'+value.price+'"></td>'+
                                        '<td hidden>'+value.idItem+'</td>'+
                                      '</tr>');
        });               
           
      },
      error: function (e) {
        console.log(e.responseText);
      },
    });
  });
  //End: AJAX para actualizar la busqueda del modal

  $('#btnAddItem').click(function(){
    $('#tblSearchItem tbody tr').each(function (index) {
      var quantity = $(this).find("td").eq(0).find("input").val();
      var unit = $(this).find("td").eq(1).html();
      var name = $(this).find("td").eq(2).html();
      var price = $(this).find("td").eq(3).find("input").val();
      var idItem = $(this).find("td").eq(4).html();

      if (quantity!='' && quantity> 0 && price != '' && price >=0){
        addItemToTblItems(quantity, unit, name, price, idItem);        
        $(this).find("td").eq(0).find("input").val("");
      }      
      
    });
    refreshTotalAmount();
  });
  
  /***************Adding events when enter is pressed********************/  
  //press enter when you are in quantity of item searched => click to btnAddItem  
  $(document).on('keyup', '#quantityItemSearched', function(e) { //it is made this way, because has to take generated input (dinamicaly)
    if(e.keyCode == 13){
      $('#btnAddItem').click();
    }
  });
  

});

function addItemToTblItems(quantity, unit, name, price, idItem){
  index++;
  $('#tblItems').append( '<tr id="trItem-'+index+'">'+
                            '<td>'+quantity+'</td>'+
                            '<td>'+unit+'</td>'+
                            '<td>'+name+'</td>'+
                            '<td class="text-right">'+price+'</td>'+
                            '<td class="text-right">'+(price*quantity).toFixed(1)+'</td>'+
                            '<td><a class="btn btn-danger" onclick="removeItem('+index+')" title="Quitar"> '+
                                  '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> '+
                                '</a>'+
                            '</td>'+
                            '<td hidden><input type="hidden" name="quantitys[]" value="'+quantity+'"></td>'+
                            '<td hidden><input type="hidden" name="idItems[]" value="'+idItem+'"></td>'+
                            '<td hidden><input type="hidden" name="prices[]" value="'+price+'"></td>'+
                            '<td hidden><input type="hidden" name="names[]" value="'+name+'"></td>'+
                            '<td hidden><input type="hidden" name="units[]" value="'+unit+'"></td>'+
                          '</tr>');
}

function refreshTotalAmount(){
  var total= 0;
  $('#tblItems tbody tr').each(function (index) {
    var quantity = $(this).find("td").eq(0).html();
    var price = $(this).find("td").eq(3).html();

    total = total + price*quantity;
  });
  $("#totalAmount").val(total.toFixed(2));
}

function removeItem (index){
  $('#trItem-'+index).remove();
  refreshTotalAmount();
}

</script>
@endsection
