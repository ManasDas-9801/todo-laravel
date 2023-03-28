<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Todo-App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-4 py-5 p-5">
        <div class="row">
            <div class="col-5 mx-auto">
                <div class="card shadow">
                    <div class="card-body">
                        @if (session()->has('errors'))
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <br />
                        @endif
                        <form action="{{ route('register') }}" method="post">
                            @csrf
                            <div class="form-group mb-2">
                                <label for="Name" class="mb-2">Name:</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="form-group mb-2">
                                <label for="Email" class="mb-2">Email:</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                            <div class="form-group mb-2">
                                <label for="Passowrd" class="mb-2">Password:</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="form-group mb-2">
                                <label for="cPassowrd" class="mb-2">Password:</label>
                                <input type="password" name="password_confirmation" class="form-control">
                            </div>
                            <input type="submit" name="Register" class="form-control btn btn-success">
                        </form>
                        <div class="flex text-center gap-2">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn btn-success">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="btn"> Already Account login Here!! Log
                                    in</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>

</html>
