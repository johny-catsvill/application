<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Вход</title>
</head>
<body id="app">

<form action="{{ route('auth') }}" method="post">
    {{ csrf_field() }}

    <input type="text" name="login">

    <input type="password" name="password">

    <input type="submit" name="submit" value="Войти">
</form>

</body>
</html>
