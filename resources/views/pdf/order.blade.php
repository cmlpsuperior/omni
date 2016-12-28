<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">

	<title>Imprimir Pedido</title>
	<style type= "text/css">
		@page { margin: 10px 25px 0px 10px; }
		table{
		   border-collapse: collapse; width: 100%;
		}
		
		td, th{
		    padding:1px;
		    text-align: left;
		}

		thead{
		   width:100%;
		   position:fixed;
		   height:109px;
		}

		h1, h3, h4{
			text-align: center;
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
	<h4>De: Edgar Espinoza Castañeda</h4>
	<span>Tef. 392-1315 / RPC 954-774-675</span>
	
	<h4>Pedido N° {{ $order->idOrder }}</h4>
	
	<p><strong>Fecha:</strong> {{ $order->registerDate}}</p>
	<p><strong>Cliente:</strong> {{ $order->name }}</p>	
	<p><strong>Dirección:</strong> {{ $order->address}}, {{ $order->zone->name}}</p>
	<br>
	<p>***********************************</p>
	<table >
        <thead>
         	<tr>
         		<th>Cant</th>
                <th>Uni</th>
                <th>Material</th>				                
                <th id="moneda">PU</th>
                <th id="moneda">Subtotal</th>
            </tr>
        </thead>

        <tbody>

        	@foreach ($order->items as $item)
            <tr>
	            <td>{{ $item->pivot->quantity }}</td>
	            <td>{{ substr ( $item->unit->name,0,3) }}</td>
	            <td>{{ $item->name }}</td>
	            <td id="moneda">{{ number_format($item->pivot->unitPrice, 1, '.'," ")  }}</td>
	            <td id="moneda">{{ number_format($item->pivot->quantity*$item->pivot->unitPrice, 1, '.'," ") }}</td>
	        </tr> 
	        @endforeach

        </tbody>
    </table>
	<br>
	<p>***********************************</p>

    <h3>Monto: S/ {{ number_format($order->totalAmount, 1, '.'," ") }}</h3>
	<h4>Deuda: S/ {{ number_format($debt, 1, '.'," ") }}</h4>

	<script type="text/javascript">
		print();
	</script>
</body>
</html>>

