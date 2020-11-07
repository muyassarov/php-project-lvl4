<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="/css/app.css" />

    <title>Task Manager - @yield('title')</title>
</head>
<body>

    <div class="container-fluid">
    @yield('content')
    </div>
<script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>
