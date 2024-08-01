<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer - Dashboard</title>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</head>

<body>
    <div class="container d-flex justify-content-between mt-3">
        <h1>Welcome {{$userName}}</h1>

        <form action="/logout" method="post">
            @csrf
            <button type="submit" class="btn btn-danger text-white mt-4">Logout</button>
        </form>
    </div>
    <div style="width: 200px;" class="m-auto mt-5">
        <a href="/products-users" class="btn btn-success">Shop</a>
        <a href="/cart" class="btn btn-warning">Cart</a>
    </div>
</body>

</html>