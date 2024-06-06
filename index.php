<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gra terenowa</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="icon.svg" type="image/svg+xml">
    
</head>

<body>
    <div class="container">
        <img src="https://wzs.zator.pl/wp-content/uploads/2023/07/logo_WZS.png" alt="Logo WZS">
    </div>
    <h2>Logowanie</h2>
    <form action="login.php" method="post">
        <label for="username">Nazwa użytkownika:</label>
        <input class="username" type="text" id="username" name="username"><br>
        <label for="password">Hasło:</label><br>
        <input class="pass" type="password" id="password" name="password"><br>
        <input class="login" type="submit" value="Zaloguj">
    </form>
</body>

</html>

<!-- <?php
// Hasło do zahashowania
$haslo = '12345';

// Hashowanie hasła
$hashowaneHaslo = password_hash($haslo, PASSWORD_DEFAULT);

// Wyświetlenie zahashowanego hasła
echo "Zahashowane hasło: " . $hashowaneHaslo;
?> -->
