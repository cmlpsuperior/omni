<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">

	<title>Imprimir Pedido</title>
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
		  margin: 1px 1px 1px 75px;
		}

		span {
			display: block;
			text-align: center;
		}
		
	</style>

</head>	
<body>
	
	<img class="center" src="{{ asset('img/chino.jpg') }}" />	
	
	<h1>Ferretería Espinoza</h1>
	<span>De: Edgar Espinoza Castañeda</span>
	<br>
	<span>Tef. 392-1315 / RPC 954-774-675</span>

	<br>
	<h4>Pedido N° {{ $order->idOrder }}</h4>
	<br>

	<p><strong>Fecha:</strong> {{ $order->registerDate }}</p>
	<br>
	<p><strong>Cliente:</strong> @if ( $order->name != null) {{ $order->name }} @else - @endif</p>
	<p><strong>Teléfono:</strong> @if ( $order->phone != null) {{ $order->phone }} @else - @endif</p>	
	<p><strong>Dirección:</strong> {{ $order->address}}</p>
	<p><strong>Zona:</strong> {{ $order->zone->name}}</p>
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
        	@foreach ($order->items as $item)
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
    <h3>Total: S/ {{ number_format($order->totalAmount, 2, '.'," ") }}</h3>
    <br>
    @if ($debt > 0)
		<h3>COBRAR:</h3>
		<h3>S/ {{ number_format($debt, 2, '.'," ") }}</h3>
	@else 
		<h3>PAGADO</h3>
	@endif
	<script type="text/javascript">
		print();
	</script>
</body>
</html>>

