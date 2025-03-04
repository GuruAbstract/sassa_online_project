<html>
<head>

    <title>@yield('title') </title>
    <style>
        body{
            color: white;
            background-color: red;
        }
    </style>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="">
@yield('message')

</div>

<script src="{{ asset("js/jquery3.2.1.js")}}"></script>

</body>
</html>



