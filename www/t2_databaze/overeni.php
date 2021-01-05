<?php

if(isset($_GET["code"]) && !empty($_GET["code"]))
    $code = trim($_GET["code"]);
else
    die("Chyba: nesprávný požadavek.");

include_once "../../config.php";

$spojeni = mysqli_connect(dbhost, dbuser, dbpass, dbname);

if(!$spojeni)
    die("Chyba pripojeni k databazi - " . mysqli_connect_error());

$sql = "SELECT id, email FROM eval_ucitele WHERE auth_code='$code'";
$res = mysqli_query($spojeni, $sql);

if(mysqli_num_rows($res) != 1) 
    die("Chyba: neplatný ověřovací kód.");

$userinf = mysqli_fetch_assoc($res);

?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>SPŠ eval - registrace</title>
</head>
<body>

<div id="stranka">

    <header>
        <h1>SPŠ eval - nastavení hesla</h1>
        <p>Nastavte si svoje heslo k účtu <?php echo $userinf["email"] ?>. </p>
    </header>

    <main>
        <form action="reg_over.php" method="post">
            <table class="overeni">
                <tr>
                    <td>Heslo: </td>
                    <td><input type="password" name="heslo" required></td>
                    <td>Heslo znovu: </td>
                    <td><input type="password" name="heslo_again" required></td>
                </tr>
            </table>
            <input type="hidden" name="code" value="<?php echo $code ?>">
            
            <br><input type="submit" value="Registrovat se">
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