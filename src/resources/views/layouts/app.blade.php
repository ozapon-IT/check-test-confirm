<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/common/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common/base.css') }}">
    @yield('css')
</head>

<body>
    <!-- ヘッダー -->
    @yield('header')

    <!-- メインコンテンツ -->
    <main>
        @yield('content')
    </main>
</body>

</html>
