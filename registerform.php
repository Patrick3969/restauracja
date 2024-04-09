<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="register.php" method="GET" class="login_container">
        <h2>Rejestracja</h2>
        <label>login: <input type="text" name="login"></label>
        <label>hasło: <input type="password" name="password"></label>
        <input type="submit" value="wyślij" class="submit">
        <h3><?php
                echo @$_COOKIE["register_error"];
            ?></h3>
        <a href="loginform.php">zaloguj się</a>
    </form>
</body>
</html>