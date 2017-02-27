<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">

	<title>Imprimir comprobante</title>
	<style type= "text/css">
		@page { margin: 10px 25px 0px 10px; }
		table{
		   border-collapse: collapse; 
		   width: 100%;
		}
		
		table thead tr th{		    
			border: 0px;
			padding: 0px;
			margin: 0px;
		    padding-bottom: 10px ;
		    text-align: left;
		}
		table tbody tr td{		    
			border: 0px;
			padding: 0px;
			margin: 0px;
		    padding-bottom: 10px ;
		    text-align: left;
		}		

		h1, h3, h4{
			text-align: center;
			border: 0px;
			margin: 0px;
			padding: 0px;
		}
		#moneda{
			text-align: right;
		}
		p{
			margin: 1px 0px 1px 0px;
		}
		
		img {
		  margin: 1px 1px 1px 25px;
		}

		span {
			display: block;
			text-align: center;
		}
		
	</style>

</head>	
<body>
	
	<img class="center" src="{{ asset('img/minicargador.jpg') }}" />	
	
	<h1>Ferretería Espinoza</h1>
	<span>De: Edgar Espinoza Castañeda</span>
	<br>
	<span>Tef. 392-1315 / RPC 954-774-675</span>

	<br>
	<h3>COMPROBANTE</h3>
	<h4>N° {{ $sale->idSale }}</h4>
	<br>

	<p><strong>Fecha:</strong> {{ $sale->registerDate }}</p>
	<br>
	<p><strong>Zona:</strong> {{ $sale->zone->name}}</p>
	<p><strong>Direc:</strong> - </p>

	<br>
	<p><strong>DNI/RUC:</strong> - </p>
	<p><strong>Cliente:</strong> - </p>
	<br>

	<p>***********************************</p>
	<table >
        <thead>
         	<tr>
         		<th>Ct</th>
                <th>Un</th>
                <th>Material</th>				                
                <th id="moneda">PU</th>
                <th id="moneda">Subto</th>
            </tr>
        </thead>

        <tbody>
        	@foreach ($sale->items as $item)
            <tr>
	            <td>{{ $item->pivot->quantity }}</td>
	            <td>{{ substr ( $item->unit->name,0,3) }}</td>
	            <td>{{ $item->name }}</td>
	            <td id="moneda">{{ number_format($item->pivot->unitPrice, 1, '.','')  }}</td>
	            <td id="moneda">{{ number_format($item->pivot->quantity*$item->pivot->unitPrice, 1, '.','') }}</td>
	        </tr> 
	        @endforeach
        </tbody>
    </table>
	
	<p>***********************************</p>
	<table >
        <thead>
         	<tr>
         		<th></th>
                <th></th>
                <th></th>				                
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tfoot>
        	<tr>
	            <td></td>	            
	            <td></td>
	            <td id="moneda">Monto</td>
	            <td></td>
	            <td id="moneda">{{ number_format($sale->totalAmount, 1, '.','') }}</td>
	        </tr>
            <tr>
	            <td></td>	            
	            <td></td>
	            <td id="moneda">Flete</td>
	            <td></td>
	            <td id="moneda">{{ number_format($sale->freight, 1, '.','') }}</td>
	        </tr>
	        <tr>
	            <td></td>	            
	            <td></td>
	            <td id="moneda">Descuento</td>
	            <td></td>
	            <td id="moneda">{{ number_format($sale->discount, 1, '.','') }}</td>
	        </tr> 
        </tfoot>
    </table>
	<br>
    <h4>Total final: S/ {{ number_format($sale->finalAmount, 2, '.',' ') }}</h4>
    <br>

    @if ($sale->totalPayment >= $sale->finalAmount)
    <h4>PAGADO</h4>
    @else 
    <h3>COBRAR</h3>
    <h3>S/ {{ number_format($sale->finalAmount - $sale->totalPayment, 2, '.',' ') }} </h3>
    @endif
    
	<script type="text/javascript">
		print();
	</script>
</body>
</html>>

