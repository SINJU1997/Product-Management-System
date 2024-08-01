<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container-fluid">
        <div class="container d-flex justify-content-between mt-5">
            <h1 class="text-center mb-5">Products</h1>
            <div>
                <a href="{{ route('cart') }}" class="btn btn-warning">Cart</a>
            </div>
        </div>
        <div class="d-flex justify-content-between mb-5">
            @foreach($products as $product)
            <div class="card" style="width: 18rem;">
                <img src="{{ asset('images/' . $product['image']) }}" class="card-img-top" alt="..." height="250">
                <div class="card-body">
                    <h5 class="card-title">{{ $product['product_name'] }}</h5>
                    <p class="card-text m-0">$ {{ $product['price'] }}</p>
                    <p class="card-text">Stock: {{ $product['stock'] }}</p>
                    @if($product['stock'] > 0)
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                        <button type="submit" class="btn btn-primary d-block m-auto">Add to cart</button>
                    </form>
                    @else
                    <button class="btn btn-secondary d-block m-auto" disabled>Out of Stock</button>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <a href="/dashboard" class="btn btn-info">Go to Home</a>
</body>

</html>
