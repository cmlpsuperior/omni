<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">

	<title>Imprimir proforma</title>
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
	
		h1, h3, h4, h5{
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
	<h3>PROFORMA</h3>
	<h4>N° {{ $proForma->idProForma }}</h4>
	<br>

	<p><strong>Fecha:</strong> {{ $proForma->registerDate }}</p>
	<br>
	<p><strong>Zona:</strong> {{ $proForma->zone->name}}</p>
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
        	@foreach ($proForma->items as $item)
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
	            <td id="moneda">{{ number_format($proForma->totalAmount, 1, '.','') }}</td>
	        </tr>
            <tr>
	            <td></td>	            
	            <td></td>
	            <td id="moneda">Flete</td>
	            <td></td>
	            <td id="moneda">{{ number_format($proForma->freight, 1, '.','') }}</td>
	        </tr>
	        <tr>
	            <td></td>	            
	            <td></td>
	            <td id="moneda">Descuento</td>
	            <td></td>
	            <td id="moneda">({{ number_format($proForma->discount, 1, '.','') }})</td>
	        </tr> 
        </tfoot>
    </table>
	<br>
    <h3>Total final: S/ {{ number_format($proForma->finalAmount, 2, '.',' ') }}</h3>
    <br>

    <h4>PROFORMA</h4>
    
	<script type="text/javascript">
		print();
	</script>
</body>
</html>>

