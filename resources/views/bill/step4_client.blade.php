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

<form role="form" action="{{ action('BillController@client_process') }}" method="POST">
<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="row">
  <div class="col-lg-6">
    @include('bill.block1_shipping')
    @include('bill.block2_items')
  </div>

  <div class="col-lg-6">
    @include('bill.block3_receivedAmount')
    <div class="panel panel-primary">

      <div class="panel-heading">
        <h3 class="panel-title">4. Cliente</h3>
      </div>      

      <div class="panel-body">
        @include('bill.tabClient_person')

        <div class="row">
          <div class="col-md-12 text-center">
            <div class="form-group">
              <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" aria-hidden="true" ></span> Registrar</button>
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


});

</script>
@endsection