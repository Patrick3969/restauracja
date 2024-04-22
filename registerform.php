<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="register.php" method="GET" class="login_container">
        <h2>Rejestracja</h2>
        <label>Login: <input type="text" id="login" name="login" pattern="[a-zA-Z0-9_-]{4,20}" title="Login powinien składać się z liter, cyfr, '-', '_', i mieć od 4 do 20 znaków." required></label>
        <label>Hasło: <input type="password" id="password" name="password" pattern=".{6,}" title="Hasło powinno mieć co najmniej 6 znaków." required></label>
        <input type="submit" value="Wyślij" class="submit">
        <h3><?php echo @$_COOKIE["register_error"]; ?></h3>
        <a href="loginform.php">Zaloguj się</a>
    </form>
</body>
</html>
