<!DOCTYPE html>
<html>
<head>
    <title>Edit Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background:#121212; color:white;">

<div class="container mt-5">

    <h1 class="mb-4">Edit Order</h1>

    <form action="/orders/{{ $order->id }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Customer Name</label>
            <input type="text" name="customer_name" class="form-control" value="{{ $order->customer_name }}" required>
        </div>

        <div class="mb-3">
            <label>Product Name</label>
            <input type="text" name="product_name" class="form-control" value="{{ $order->product_name }}" required>
        </div>

        <div class="mb-3">
            <label>Quantity</label>
            <input type="number" name="quantity" class="form-control" value="{{ $order->quantity }}" required>
        </div>

        <div class="mb-3">
            <label>Price</label>
            <input type="number" step="0.01" name="price" class="form-control" value="{{ $order->price }}" required>
        </div>

        <div class="mb-3">
            <label>Order Date</label>
            <input type="date" name="order_date" class="form-control" value="{{ $order->order_date }}" required>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option {{ $order->status=='Pending' ? 'selected' : '' }}>Pending</option>
                <option {{ $order->status=='Processing' ? 'selected' : '' }}>Processing</option>
                <option {{ $order->status=='Packed' ? 'selected' : '' }}>Packed</option>
                <option {{ $order->status=='Shipped' ? 'selected' : '' }}>Shipped</option>
                <option {{ $order->status=='Delivered' ? 'selected' : '' }}>Delivered</option>
            </select>
        </div>

        <button class="btn btn-warning">Update Order</button>
        <a href="/orders" class="btn btn-secondary">Back</a>

    </form>

</div>

</body>
</html>