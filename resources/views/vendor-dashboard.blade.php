<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor - Dashboard</title>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</head>

<body>
    <div class=" container d-flex justify-content-between mt-3">
        <h1>Welcome {{$userName}}</h1>
        <form action="/logout" method="post">
            @csrf
            <button type="submit" class="btn btn-danger text-white mt-4">Logout</button>
        </form>
    </div>
    <div style="width: 200px;" class="m-auto mt-5">
    </div>
    <div class="mt-5 container">
    @if(session('success'))
        <div style="color:red; text-align:center; margin-top:10px;">
            {{ session('success') }}
        </div>
        @endif
        <h3 class="text-center text-info mb-5">Products List</h3>
       
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
                @if($product->user_id == $userId)
                <tr>
                    <td>{{ $product->product_name }}</td>
                    <td><img src="{{ asset('./images/'.$product->image) }}" width="100" height="100"></td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->added_by }}</td>
                    <td>
                        <a href="/product-edit-vendor/{{ $product->id }}" class="btn btn-info">Edit</a>
                        <a href="/product-delete-vendor/{{ $product->id }}" class="btn btn-danger">Delete</a>
                        <a href="/stock-edit-vendor/{{ $product['id'] }}" class="btn btn-dark">Manage Stock</a>
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>

        </table>
        <a href="/add-product-vendor" class="btn btn-success">Add Product</a>

    </div>
</body>

</html>