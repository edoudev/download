<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>download - edou.dev</title>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
    @routes
    <script src="{{ mix('/js/app.js') }}" defer></script>
</head>

<body class="overflow-hidden">
    @inertia
</body>

</html>