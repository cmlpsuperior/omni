@extends ('app')
@section ('main')

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Tablero de control
        </h1>
    </div>
</div>

<div class="row">
  <canvas width="400" height="400" id="myChart"></canvas>
</div>
@endsection

@section('script')
<script src="{{ asset('js/chart.js') }}"></script>
<script type="text/javascript">
$(document).ready(function(){
  var myUrl=  "{{ url('bill/saleMonth') }}";
  $.ajax({        
    type: "GET",   
    url: myUrl,
    dataType : "JSON",
    success: function(data){
      console.log(data.bills);
    },
    error: function (e) {
      console.log(e.responseText);
    }
  });
  var chart = document.getElementById("myChart").getContext("2d");


});

</script>
@endsection