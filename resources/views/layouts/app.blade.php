<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', '') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .required_sign{
            color:red;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', '') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">
                            <li class="nav-item auth">
                                <a class="nav-link" href="{{ route('chat') }}">Dashboard</a>
                            </li>
                            <li class="nav-item auth">
                                <a class="nav-link" href="#" onclick="logout()">Logout</a>
                            </li>
                            <li class="nav-item noauth">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                            <li class="nav-item noauth">
                                <a class="nav-link" href="{{ route('register') }}">Register</a>
                            </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
    <script>
        $(document).ready(function () {
            const token = localStorage.getItem('auth_token');
            if (token == '' || token == null || token == 'null') {
                $('.noauth').show();
                $('.auth').hide();
            } else {
                $('.noauth').hide();
                $('.auth').show();
            }
        });

        function logout(){
            $.ajax({
                url: "{{ route('logout') }}",
                type: "GET",
                success: function (response) {
                    localStorage.setItem('auth_token', '');
                    $('#login-alert').removeClass('d-none alert-danger').addClass('alert-success').text(response.message);
                    setTimeout(() => {
                        window.location.href = "{{ route('login')}}";
                    }, 2000);
                },
                error: function (xhr) {
                    $('#login-alert').removeClass('d-none alert-success').addClass('alert-danger').text(xhr.responseJSON.message);
                }
            });
        }
    </script>
    
</body>
</html>
