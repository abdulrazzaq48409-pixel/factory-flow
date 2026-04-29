<!DOCTYPE html>
<html>
<head>
    <title>FactoryFlow Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background:#121212; color:white;">

<div class="container py-4">

    <div class="d-flex flex-column flex-md-row justify-content-between gap-2 mb-4">
        <h1 class="mb-0">FactoryFlow Dashboard</h1>

        <div class="d-flex flex-wrap gap-2">
            <a href="/orders/create" class="btn btn-primary btn-sm">Add Order</a>
            <a href="/orders/export" class="btn btn-success btn-sm">Excel</a>
            <a href="/products" class="btn btn-info btn-sm">Inventory</a>
            <a href="/logout" class="btn btn-danger btn-sm">Logout</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row g-3 mb-4">

        <div class="col-md-3">
            <div class="card bg-primary text-white p-3">
                <h6>Total Orders</h6>
                <h2>{{ $totalOrders }}</h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-success text-white p-3">
                <h6>Revenue</h6>
                <h2>{{ $totalRevenue }}</h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-warning text-dark p-3">
                <h6>Total Profit</h6>
                <h2>{{ $totalProfit }}</h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-light text-dark p-3">
                <h6>Quantity</h6>
                <h2>{{ $totalQty }}</h2>
            </div>
        </div>

    </div>

    <div class="table-responsive">
        <table class="table table-dark table-bordered align-middle">

            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Product</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Status</th>
                <th>Action</th>
            </tr>

            @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->customer_name }}</td>
                <td>{{ $order->product_name }}</td>
                <td>{{ $order->quantity }}</td>
                <td>{{ $order->price }}</td>

                <td>
                    <span class="badge bg-secondary">{{ $order->status }}</span>
                </td>

                <td class="d-flex flex-wrap gap-1">
                    <a href="/orders/{{ $order->id }}/edit" class="btn btn-warning btn-sm">Edit</a>
                    <a href="/orders/{{ $order->id }}/invoice" class="btn btn-info btn-sm">PDF</a>
                    <a href="/orders/{{ $order->id }}/whatsapp" class="btn btn-success btn-sm">WhatsApp</a>

                    <form action="/orders/{{ $order->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach

        </table>
    </div>

</div>

</body>
</html>