<!DOCTYPE html>
<html lang="en">
<head>
    <title>IFTTTEXT</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
</head>
<body>
<div class="wrapper" id="app">
    @yield('content')
</div>
<script src="{{ asset('plugins/socket.io/socket.io.min.js') }}"></script>
<script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>
