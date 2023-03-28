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
            <div class="col-8 mx-auto">
                <div class="card shadow">
                    <div class="card-body">
                        <h4 class="text-center">Welcome to Todo Application</h4>
                        <div class="flex text-center gap-2">
                            @auth
                                <a href="{{ url('/todo') }}"
                                    class="btn btn-success">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}"
                                    class="btn">Log
                                    in</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}"
                                        class="btn">Register</a>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
