<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Доступ запрещён</title>
    <style>
        body{
            font-family: sans-serif;
            display:flex;
            justify-content:center;
            align-items:center;
            min-height:100vh;
            margin:0;
            text-align:center;
        }
    </style>
</head>
<body>

<div>
    <h1>403</h1>
    <h2>Доступ запрещён</h2>

    <p>
        У вас недостаточно прав для просмотра этой страницы.
    </p>

    <a href="{{ route('platform.index') }}">
        Вернуться в админку
    </a>
</div>

</body>
</html>