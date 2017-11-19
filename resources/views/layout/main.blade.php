<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('bootstrap4/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ asset('css/loader-1.css') }}">
    @yield('customstyle')
</head>
<body>

<div class="container">
    <div class="alert alert-dark text-center" style="border-radius: 0; background-color: #114993; color: white" role="alert">
        <div class="row">
            <div class="col-md-10 ">
                <h4>Welcome to Algorism Property Listing Web Application</h4>
            </div>
            <div class="col-md-2">
                @yield('nav')
            </div>
        </div>

    </div>
    @yield('content')

    <div class="alert alert-dark text-center" style="border-radius: 0; margin-bottom: 0; background-color: #114993; color: white; position: fixed; bottom: 0; z-index: 1030; width: 100%; left: 0;right: 0;" role="alert">
        <h6>Developed by Oseni Adefemi &copy; 2017</h6>
    </div>
</div>

<script src=" {{ asset('js/jquery-3.2.1.min.js') }}"></script>
<script src=" {{ asset('bootstrap4/js/bootstrap.js') }}"></script>
<script src=" {{ asset('js/sweetalert.js') }}"></script>

@yield('customscript')
</body>
</html>