<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>

    <style>
        body{
            font-family: Arial, sans-serif;
            padding:40px;
        }

        h1{
            color:#0d6efd;
        }

        table{
            width:100%;
            border-collapse: collapse;
            margin-top:30px;
        }

        table, th, td{
            border:1px solid #ccc;
        }

        th, td{
            padding:12px;
            text-align:left;
        }

        .total{
            margin-top:20px;
            font-size:22px;
            font-weight:bold;
            text-align:right;
        }
    </style>
</head>

<body>

<h1>FactoryFlow Invoice</h1>

<p><strong>Invoice ID:</strong> {{ $order->id }}</p>
<p><strong>Date:</strong> {{ date('d-m-Y') }}</p>

<table>
<tr>
    <th>Customer</th>
    <th>Product</th>
    <th>Quantity</th>
    <th>Price</th>
</tr>

<tr>
    <td>{{ $order->customer_name }}</td>
    <td>{{ $order->product_name }}</td>
    <td>{{ $order->quantity }}</td>
    <td>{{ $order->total_price }}</td>
</tr>
</table>

<div class="total">
Total: Rs {{ $order->total_price }}
</div>

</body>
</html>