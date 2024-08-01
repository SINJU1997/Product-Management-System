<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products List - Admin</title>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</head>

<body>

    <div class="mt-5 container">
        <h3 class="text-center text-info mb-5">Products List</h3>
        @if(session('success'))
        <div style="color:red; text-align:center; margin-top:10px;">
            {{ session('success') }}
        </div>
        @endif
        <table class="table text-center">
            <thead>
                <tr>
                    <th scope="col">Product Name</th>
                    <th scope="col">Photo</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Price</th>
                    <th scope="col">Added by</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <th>{{ $product['product_name'] }}</th>
                    <th><img src="{{asset('./images/'.$product['image'])}}" width="100" height="100"></th>
                    <th>{{ $product['stock'] }}</th>
                    <th>{{ $product['price'] }}</th>
                    <th>{{ $product['added_by'] }}</th>
                    <th>
                        <a href="/product-edit/{{ $product['id'] }}" class="btn btn-info">Edit</a>
                        <a href="/product-delete/{{ $product['id'] }}" class="btn btn-danger">Delete</a>
                        <a href="/stock-edit/{{ $product['id'] }}" class="btn btn-dark">Manage Stock</a>
                    </th>
                </tr>
                @endforeach
            </tbody>
        </table>
        <a href="/add-product" class="btn btn-success">Add Product</a>
        <a href="/admin-dashboard">Go to Home</a>
    </div>
</body>

</html>