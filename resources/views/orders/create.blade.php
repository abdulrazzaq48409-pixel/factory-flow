<!DOCTYPE html>
<html>
<head>
    <title>Add Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background:#121212; color:white;">

<div class="container mt-5">

    <h1 class="mb-4">Add New Order</h1>

    <form action="/orders" method="POST">
        @csrf

        <div class="mb-3">
            <label>Customer Name</label>
            <input type="text" name="customer_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Product Name</label>
            <input type="text" name="product_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Quantity</label>
            <input type="number" name="quantity" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Price</label>
            <input type="number" step="0.01" name="price" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Order Date</label>
            <input type="date" name="order_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option>Pending</option>
                <option>Processing</option>
                <option>Packed</option>
                <option>Shipped</option>
                <option>Delivered</option>
            </select>
        </div>

        <button class="btn btn-success">Save Order</button>
        <a href="/orders" class="btn btn-secondary">Back</a>

    </form>

</div>

</body>
</html>