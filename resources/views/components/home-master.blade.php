<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Perfect Pay</title>
    <link rel="stylesheet" href="{{asset('site/style.css')}}">
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            @yield('content')
        </div>
    </div>
</div>


<script src="{{asset('site/jquery.js')}}"></script>
<script src="{{asset('site/bootstrap.js')}}"></script>
<script src="{{asset('js/app.js')}}"></script>
<script src="https://kit.fontawesome.com/100867461c.js" crossorigin="anonymous"></script>
</body>
</html>
