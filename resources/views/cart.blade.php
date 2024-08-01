<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <h1 class="text-center my-5">Your Cart</h1>
        @if(Session::has('cart') && count(Session::get('cart')) > 0)
        <div class="row">
            @foreach(Session::get('cart') as $productId => $item)
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="{{ asset('images/' . $item['image']) }}" class="card-img-top" alt="..." height="250">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item['product_name'] }}</h5>
                        <p class="card-text m-0">$ {{ $item['price'] }}</p>
                        <p class="card-text">Quantity: {{ $item['quantity'] }}</p>
                        <form action="{{ route('cart.remove') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $productId }}">
                            <button type="submit" class="btn btn-danger d-block m-auto">Remove</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-4">
            <h4>Total Price: ${{ $totalPrice }}</h4>
        </div>
        @else
        <p class="text-center">Your cart is empty.</p>
        @endif
    </div>
    <a href="/dashboard" class="btn btn-info">Go to Home</a>
</body>

</html>
