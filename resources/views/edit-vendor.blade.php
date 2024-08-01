<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Vendor - Admin</title>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</head>

<body>
    <h1 class="text-center">Edit Vendor</h1>
    <div class="container">
        <form action="/vendor-editing/{{$user['id']}}" method="post">
            @csrf
            @method('put')
            <div class="mb-3">
                <label for="exampleInputEmail0" class="form-label">Name</label>
                <input type="text" class="form-control" id="exampleInputEmail0" name="name" value="{{$user['name']}}">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail0" class="form-label">Email</label>
                <input type="text" class="form-control" id="exampleInputEmail0" name="email" value="{{$user['email']}}">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail0" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputEmail0" name="password" >
            </div>
            
            <button type="submit" class="btn btn-primary">Add Vendor</button>
            
        </form>
        <a href="/admin-dashboard">Go to Home</a>
    </div>
    
</body>

</html>