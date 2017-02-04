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
  <div class="col-md-6">
    <div class="panel panel-primary text-center">

      <div class="panel-heading">
        <h3 class="panel-title">Ventas del mes</h3>
      </div>

      <div class="panel-body ">      
        <label id="totalAmount"></label>
      </div>

    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
      <canvas id="myChart"></canvas>
  </div>
</div>


@endsection

@section('script')
<script src="{{ asset('js/chart.js') }}"></script>
<script type="text/javascript">
$(document).ready(function(){
  var salesAmount = [];
  var hours = [];
  var totalAmount = 0;

  var myUrl=  "{{ url('bill/saleMonth') }}";
  $.ajax({        
    type: "GET",   
    url: myUrl,
    dataType : "JSON",
    success: function(data){
      console.log('data');
      
      //initialize
      for (i = 1; i <= data.numDays; i++) {
        hours.push(i);
        salesAmount.push(0);
      }        

      //get values
      $.each(data.days, function(k, value){
        totalAmount = totalAmount + value.total; //amount of month
        salesAmount[value.dia - 1] = salesAmount[value.dia - 1] + value.total; //amount of one day
      });
      
      //set total amount of month
      $("#totalAmount").text("S/ "+ totalAmount.toFixed(2));
      //create the chart
      var ctx = $("#myChart");
      var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: hours ,
            datasets: [{
                label: 'Ventas del dia' ,
                data: salesAmount,
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(75, 192, 192, 0.2)'
                ],
                borderColor: [                    
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
          responsive: true,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
      });

    },
    error: function (e) {
      console.log(e.responseText);
    }
  });



  

});

</script>
@endsection