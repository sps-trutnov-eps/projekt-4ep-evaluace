<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>SPŠ eval - registrace</title>
</head>
<body>

<div id="stranka">
    
    <header>
        <h1>SPŠ eval - registrace učitele</h1>
        <p>Pokud jste učitel, registrujte se zde do systému SPŠ eval.</p>
    </header>

    <main>
        <form action="register.php" method="post">
            <p>Email: <input class="input_register" type="email" name="email" placeholder="ucitel@spstrutnov.cz" required></p>
            <input type="submit" value="Ověřit">
        </form>

        <div id="flash_message">
            <?php
                session_start();
                if(isset($_SESSION["flash_ok"]))
                    echo "<p class=\"flash_ok\">" . $_SESSION["flash_ok"] . "</p>";
                if(isset($_SESSION["flash_err"]))
                    echo "<p class=\"flash_err\">" . $_SESSION["flash_err"] . "</p>";
                session_destroy();
            ?>
        </div>
    </main>

    <footer>
        <p>&copy; 2020 SPŠ eval (modul registrace - &copy; Lukáš Jarolímek)</p>
    </footer>
</div>

</body>
</html>