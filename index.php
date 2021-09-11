<?session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <h2>Регистрация</h2>
    <form name="regform" class="forma" id="form" action="/php/registration.php" method="post">
        <p>Заполните поля для регистрации на сайте</p> 
        <p>Введите логин: </p>
        <input type="text" name = "login">
        <p>Введите пароль: </p>
        <input type='password' name='password'>
        <p>Повторите введенный пароль: </p>
        <input type='password' name='password2'>
        <p>Введите email</p>
        <input type='text' name='email'>
        <input type='submit' value='OK' name='submit'>
    </form>
</body>
</html>