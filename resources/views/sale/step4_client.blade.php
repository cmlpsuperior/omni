@extends ('app')
@section ('main')

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Nueva venta
        </h1>
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

<div class="row">
  <div class="col-lg-6">
    @include('sale.block1_items')
  </div>

  <div class="col-lg-6">

    <div class="row">
      <div class="col-xs-6">
        @include('sale.block2_amounts')
      </div>

      <div class="col-xs-6"> 
      @include('sale.block3_payment')
      </div>
    </div>

    <div class="row">
      <div class="panel panel-primary">

        <div class="panel-heading">
          <h3 class="panel-title">4. Cliente</h3>
        </div>

        <div class="panel-body">
          <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#person">Persona</a></li>
            <li ><a data-toggle="tab" href="#company">Empresa</a></li>
          </ul>

          <div class="tab-content">
            <!--have to add a new block for every new paymenttype, here are only the 2 first-->
            <div id="person" class="tab-pane fade in active">
              <form role="form" action="{{ action('SaleController@client_process') }}" method="POST">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">

              <br>
              <input type="hidden" id="clientType" name="clientType" value="Persona"> 

              <div class="form-group row">
                <div class="col-xs-6">
                  <label for="documentNumber">DNI *</label>
                  <input type="number" min="0" class="form-control" id="documentNumber" name="documentNumber" required>
                </div>

                <div class="col-xs-6">
                  <label for=""></label><br>
                  <a class="btn btn-info" id="btnSearch" ><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Verificar</a>
                  <label class="" id="status" name="status"> </label>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-xs-6">         
                  <label for="names">Nombres *</label>
                  <input type="text" class="form-control" id="names" name="names" required>
                </div>
              </div>

              <div class="form-group row">       
                <div class="col-xs-6">
                  <label for="fatherLastName">Apellido paterno *</label>
                  <input type="text" class="form-control" id="fatherLastName" name="fatherLastName" required>
                </div>   
                <div class="col-xs-6">
                  <label for="motherLastName">Apellido materno *</label>
                  <input type="text" class="form-control" id="motherLastName" name="motherLastName" required>
                </div> 
              </div>

              <div class="form-group row">
                <div class="col-xs-6">         
                  <label for="phone">Teléfono </label>
                  <input type="number" min="0" class="form-control" id="phone" name="phone">
                </div>
              </div>

              <div class="form-group text-center">          
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Continuar</button>
              </div>

              </form>
            </div>
            

            
            <div id="company" class="tab-pane fade">
              <form role="form" action="{{ action('SaleController@client_process') }}" method="POST">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">

              <br>
              <input type="hidden" id="clientType" name="clientType" value="Empresa">  

              <div class="form-group row">
                <div class="col-xs-6">
                  <label for="documentNumberCompany">RUC *</label>
                  <input type="number" min="0" class="form-control" id="documentNumberCompany" name="documentNumberCompany" required>
                </div>

                <div class="col-xs-6">
                  <label for=""></label><br>
                  <a class="btn btn-info" id="btnSearchCompany" ><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Verificar</a>
                  <label class="" id="statusCompany" name="statusCompany"> </label>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-xs-6">         
                  <label for="businessName">Razón social *</label>
                  <input type="text" class="form-control" id="businessName" name="businessName" required>
                </div>

                <div class="col-xs-6">         
                  <label for="phoneCompany">Teléfono </label>
                  <input type="number" min="0" class="form-control" id="phoneCompany" name="phoneCompany">
                </div>
              </div>

              <div class="form-group text-center">          
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Continuar</button>
              </div>

              </form>
            </div>              

          </div>

        </div>         

      </div>
    </div>

  </div>
</div>  

</form>
@endsection

@section('script')
<script type="text/javascript">
$(document).ready(function() {

  $('#btnSearch').on('click', function (e) {
    var documentNumber = $('#documentNumber').val();  
    var myUrl = "{{ url('person/searchPersonByDocumentNumber') }}";
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $.ajax({        
      type: "GET",   
      url: myUrl,
      dataType : "JSON",
      data: {
          documentNumber: documentNumber,
          _token: CSRF_TOKEN
      },
      success: function(data){
        console.log(data.personClient);
        cleanClientData();
        updateClientStatus(data.personClient);

        if (data.personClient != null){
          updateClientInfo(data.personClient);
        }                
      },
      error: function (e) {
        console.log(e.responseText);
      },
    });

  });

  $('#btnSearchCompany').on('click', function (e) {
    var documentNumber = $('#documentNumberCompany').val();  
    var myUrl = "{{ url('company/searchCompanyByDocumentNumber') }}";
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
      type: "GET",   
      url: myUrl,
      dataType : "JSON",
      data: {
          documentNumber: documentNumber,
          _token: CSRF_TOKEN
      },
      success: function(data){
        console.log(data.companyClient);
        cleanCompanyData();
        updateCompanyStatus(data.companyClient);

        if (data.companyClient != null){
          updateCompanyInfo(data.companyClient);
        }                
      },
      error: function (e) {
        console.log(e.responseText);
      },
    });

  });

});
function cleanClientData(){
  $('#names').val('');
  $('#fatherLastName').val(''); 
  $('#motherLastName').val('');
  $('#phone').val(''); 
}
function updateClientInfo (personClient){
  $('#names').val(personClient.names);
  $('#fatherLastName').val(personClient.fatherLastName); 
  $('#motherLastName').val(personClient.motherLastName);
  $('#phone').val(personClient.phone); 
}

function updateClientStatus (personClient){
  $('#status').removeClass('text-danger');
  $('#status').removeClass('text-success');

  if (personClient == null){
    $('#status').text(' No es cliente');
    $('#status').addClass('text-danger');
  }
  else {
    $('#status').text(' Sí es cliente');
    $('#status').addClass('text-success');
  }
}

function cleanCompanyData(){
  $('#businessName').val(''); 
  $('#phoneCompany').val(''); 
}
function updateCompanyInfo (companyClient){
  $('#businessName').val(companyClient.businessName);
  $('#phoneCompany').val(companyClient.phone); 
}

function updateCompanyStatus (companyClient){
  $('#statusCompany').removeClass('text-danger');
  $('#statusCompany').removeClass('text-success');

  if (companyClient == null){
    $('#statusCompany').text(' No es cliente');
    $('#statusCompany').addClass('text-danger');
  }
  else {
    $('#statusCompany').text(' Sí es cliente');
    $('#statusCompany').addClass('text-success');
  }
}
</script>
@endsection