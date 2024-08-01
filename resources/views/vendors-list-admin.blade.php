<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor's List - Admin</title>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</head>

<body>
    <h1 class="text-center">Registered Vendors</h1>
    @if(session('success'))
    <div style="color:red; text-align:center; margin-top:10px;">
        {{ session('success') }}
    </div>
    @endif
    <div class="mt-5 container">
        <table class="table text-center">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($vendors as $vendor)
                <tr>
                    <th>{{ $vendor['name'] }}</th>
                    <th>{{ $vendor['email'] }}</th>
                    <th>
                        <a href="/edit-vendor/{{ $vendor['id'] }}" class="btn btn-info">Edit</a>
                        <a href="/delete-vendor/{{ $vendor['id'] }}" class="btn btn-danger">Delete</a>
                    </th>
                </tr>
                @endforeach
            </tbody>
        </table>
        <a href="/add-vendors" class="btn btn-success">Add New Vendor</a>
        <a href="/admin-dashboard">Go to Home</a>
    </div>
</body>

</html>