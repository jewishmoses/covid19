<!doctype html>
<html lang="en" class="text-gray-900 leading-tight">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @livewireStyles
</head>
<body class="min-h-screen bg-gray-100 p-5">
    @yield('content')
    @livewireScripts
</body>
</html>
