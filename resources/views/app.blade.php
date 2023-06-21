<!DOCTYPE html>
<html lang="{{ app()->getlocale()}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{config("app.name")}} - @yield("title")</title>
    <link rel="stylesheet" href="{{asset("assets/css/bootstrap.css")}}">
</head>
<body>
    @include('layouts.header')
    <main>
        <div class="container">
            @yield('content')
        </div>
    </main>

    <div class="sticky-message" style="position:fixed; top:100px; right:30px"></div>

    <script src="{{asset("assets/js/jquery-3.6.4.min.js")}}"></script>
    <script src="{{asset("assets/js/bootstrap.bundle.js")}}"></script>
    @yield('page-scripts')
    <script src="{{asset("assets/js/script.js")}}"></script>
</body>
</html>