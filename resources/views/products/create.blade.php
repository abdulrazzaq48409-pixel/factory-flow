<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background:#121212; color:white;">

<div class="container mt-5">

    <h1 class="mb-4">Add Product</h1>

    <form action="/products" method="POST">
        @csrf

        <div class="mb-3">
            <label>Product Name</label>
            <input type="text" name="product_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Stock</label>
            <input type="number" name="stock" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Buy Price</label>
            <input type="number" step="0.01" name="buy_price" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Sell Price</label>
            <input type="number" step="0.01" name="sell_price" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Supplier</label>
            <input type="text" name="supplier" class="form-control">
        </div>

        <div class="mb-3">
            <label>Low Stock Alert</label>
            <input type="number" name="low_stock_alert" class="form-control" value="10">
        </div>

        <button class="btn btn-success">Save Product</button>
        <a href="/products" class="btn btn-secondary">Back</a>

    </form>

</div>

</body>
</html>