<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Management - Vendor</title>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
    <h1 class="text-center text-success">Edit Stock</h1>
    <div class="container mt-5">
        <form action="/stock-editing-vendor/{{$product['id']}}" method="post">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="exampleInputEmail0" class="form-label">User Id</label>
                <input type="text" class="form-control" id="exampleInputEmail0" name="user_id" readonly value="{{ $userId }}">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="product_name" readonly value="{{ $product['product_name'] }}">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail3" class="form-label">No. of Stock</label>
                <input type="text" class="form-control" id="exampleInputEmail3" name="stock" 
                value="{{ $product['stock'] }}">
            </div>
            <button type="submit" class="btn btn-primary">Update Stock</button>
        </form>
    </div>
</body>

</html>