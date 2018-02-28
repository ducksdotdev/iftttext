<!DOCTYPE html>
<html lang="en">
<head>
    <title>IFTTTEXT</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
</head>
<body>
@auth
    <div class="wrapper" id="app">
        <nav>
            <a href="{{ route('home') }}"><i class="ion ion-chatbubble"></i></a>
            <a href="{{ route('settings') }}"><i class="ion ion-gear-a"></i></a>
        </nav>
        @yield('content')
    </div>
@else
    @yield('content')
@endauth
<script src="{{ asset('plugins/socket.io/socket.io.min.js') }}"></script>
<script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>
