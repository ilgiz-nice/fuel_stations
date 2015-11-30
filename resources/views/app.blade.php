<!DOCTYPE html>
<html lang="ru">
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
@yield('nav')

@yield('content')

<script src="js/index.js"></script>
<script src="js/jquery-2.1.4.min.js"></script>
<script src="js/printThis.js"></script>
</body>
</html>