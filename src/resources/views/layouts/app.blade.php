<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mogitate</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
    <link rel="stylesheet" href="{{ asset('css/edit.css') }}">


</head>
<body>
    <header class="site-header">
       <div class="container">
        <h1>mogitate</h1>
    </header>

    @yield('content')
</body>
</html>
