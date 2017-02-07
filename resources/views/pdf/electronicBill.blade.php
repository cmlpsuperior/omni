<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">

	<title>Imprimir {{ $bill->billType->name }}</title>
	<style type= "text/css">
		@page { margin: 10px 25px 0px 10px; }
		table{
		   border-collapse: collapse; 
		   width: 100%;
		}
		
		table, td, th{		    
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
	<h3>{{ strtoupper($bill->billType->name) }}</h3>
	<h4>N° {{ $bill->idBill }}</h4>
	<br>

	<p><strong>Fecha:</strong> {{ $bill->registerDate }}</p>
	<br>
	<p><strong>Zona:</strong> {{ $bill->zone->name}}</p>
	<p><strong>Direc:</strong> {{ $bill->shippingAddress }}</p>
	<br>
	@if ( $bill->billType->name == 'Pedido electronico' )
	<p><strong>Cliente:</strong> {{ $bill->name}}</p>
	<p><strong>Telef.:</strong> {{ $bill->phone }}</p>
	<br>

	@elseif ( $bill->billType->name == 'Boleta electronica' )
	<p><strong>DNI:</strong> {{ $bill->documentNumber}}</p>
	<p><strong>Cliente:</strong> {{ $bill->name}}</p>
	<p><strong>Telef.:</strong> {{ $bill->phone }}</p>
	<br>

	@elseif ( $bill->billType->name == 'Factura electronica' )
	<p><strong>RUC:</strong> {{ $bill->documentNumber}}</p>
	<p><strong>Razón:</strong> {{ $bill->name}}</p>
	<p><strong>Direc:</strong> {{ $bill->legalAddress}}</p>
	<p><strong>Telef.:</strong> {{ $bill->phone }}</p>
	<br>
	
	@endif

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
        	@foreach ($bill->items as $item)
            <tr>
	            <td>{{ $item->pivot->quantity }}</td>
	            <td>{{ substr ( $item->unit->name,0,3) }}</td>
	            <td>{{ $item->name }}</td>
	            <td id="moneda">{{ number_format($item->pivot->unitPrice, 1, '.',"")  }}</td>
	            <td id="moneda">{{ number_format($item->pivot->quantity*$item->pivot->unitPrice, 1, '.',"") }}</td>
	        </tr> 
	        @endforeach
        </tbody>
    </table>
	
	<p>***********************************</p>
	<br>
    <h4>Total: S/ {{ number_format($bill->totalAmount, 2, '.'," ") }}</h4>
    <br>
    
    @if ($bill->receivedAmount - $bill->totalAmount >= 0)
    <h3>PAGADO</h3>
    @else
    <h3>COBRAR:</h3>
    <h3>S/ {{ $bill->totalAmount - $bill->receivedAmount }}</h3>
    @endif

	<script type="text/javascript">
		print();
	</script>
</body>
</html>>

