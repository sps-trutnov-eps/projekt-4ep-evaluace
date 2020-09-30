<!DOCTYPE html>
<html lang="cs">
    <head>
        <title>Blog</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width; initial-scale=1.0" />
    </head>
    <body>
        <h1>Vítejte</h1>
        <?php
            require_once "config.php";

            $spojeni = mysqli_connect(dbhost, dbuser, dbpass, dbname);
            echo '<p style="border-bottom: 2px dotted black"><a href="prihlaseni_formular.html">Přihlášení...</a> | <a href="registrace_formular.html">Registrace...</a></p>';

            $pole[] = array();

            $i = 0;

            $data = mysqli_query($spojeni, "SELECT * FROM clanky ORDER BY id DESC");
            $radek_s_max_id = mysqli_fetch_assoc($data);

            session_start();

            $_SESSION["prihlasen"] = false;

            while ($i != $radek_s_max_id["id"] + 1)
            {
                $data = mysqli_query($spojeni, "SELECT * FROM clanky WHERE id = '$i'");
                if (mysqli_num_rows($data) > 0)
                {
                $clanekVsehovsudy = mysqli_fetch_assoc($data);
                $id = $clanekVsehovsudy["id"];
                $pole[$i] = $id;
                $nazev = $clanekVsehovsudy["nazev"];
                $jmeno = $clanekVsehovsudy["jmeno"];
                echo "<a id='$id' href='clanek.php?id=$id'style='font-size: 20pt; text-decoration: none; color: black;'>$nazev</a>" . "<br>" . "<br>" . "<a style='font-style: italic;'>$jmeno</a>" . "<br>" . "<br>" . "<br>";
                }
                $i = $i + 1;
            }

            $_SESSION["pole"] = $pole;

            mysqli_close($spojeni);
        ?>
    </body>
</html>
