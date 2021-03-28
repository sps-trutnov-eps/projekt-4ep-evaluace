<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <title>T5_Vyplnění dotazníku</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
</head>

<body>
<?php
    require_once "../../config.php";
    $spojeni = mysqli_connect(dbhost, dbuser, dbpass, dbname);
    session_start();
    $idHodiny = $_SESSION["hodinaID"];
    if(isset($_COOKIE["idHodiny"]) && $idHodiny == $_COOKIE["idHodiny"]){
        header("location:../t3_student/vyber.php");
    }else{
        $cas = mysqli_fetch_assoc(mysqli_query($spojeni, "SELECT * FROM eval_formulare WHERE idHodiny = $idHodiny"));
        $cas = strtotime($cas["cas"]);
        date_default_timezone_set( 'CET' );
        $ted = strtotime(date("Y-m-d H:i:s"));
        $rozdil = $cas - $ted;
        if($rozdil > 0){
            setcookie("idHodiny", $idHodiny, time() + $rozdil,"/");
            setcookie("casdeletu", $rozdil, time() + $rozdil,"/");
        }else{
            header("location:../t3_student/vyber.php");
        }
    }
    ?>
    <header>
        <h1>UI pro vyplnění otázek pomocí formuláře k danné hodině</h1>
    </header>
    <?php
    $idVzoru = mysqli_fetch_assoc(mysqli_query($spojeni, "SELECT * FROM eval_formulare WHERE idHodiny = $idHodiny"));
    $idVzoru = $idVzoru["idVzoru"];
    $formular = mysqli_fetch_assoc(mysqli_query($spojeni, "SELECT * FROM eval_formulare_vzory WHERE id = $idVzoru"));
    $formular = $formular["otazka"];
    //echo($formular);
    $objekt = json_decode($formular);
    //echo($objekt);
    ?>
    <form action="json.php" method="POST">
        <?php
        echo "<table>";
        switch ($objekt->moznostHodnoceni) {
            case "like":
                echo "<th>Jak bys ohodnotil tuto hodinu?</th>";
                echo "<td><input type='radio' name='hodnoceniHodiny' value='Like'><label for='Like'>Like</label></td>";
                echo "<td><input type='radio' name='hodnoceniHodiny' value='Dislike'><label for='Dislike'>Dislike</label></td>";
                break;
            case "hvezdicky":
                echo "Hvězdičky";
                echo "<td><input type='radio' name='hodnoceniHodiny' value='1'><label for='1'>1</label></td>";
                echo "<td><input type='radio' name='hodnoceniHodiny' value='2'><label for='2'>2</label></td>";
                echo "<td><input type='radio' name='hodnoceniHodiny' value='3'><label for='3'>3</label></td>";
                echo "<td><input type='radio' name='hodnoceniHodiny' value='4'><label for='4'>4</label></td>";
                echo "<td><input type='radio' name='hodnoceniHodiny' value='5'><label for='5'>5</label></td>";
                /*kód pro vytvoření hvězdiček*/
                break;
        }
        echo "</table>";
        $cisloOtazky = 0; //číslování otázek
        foreach ($objekt->otazky as $otazka) {
            $cisloOtazky++;
            echo "<table>";
            switch ($otazka->typ) {
                case "text":
                    $nadpis = $otazka->text;
                    echo "<th id='$cisloOtazky'>$nadpis</th>";
                    echo "<td><textarea name='odpoved' id='$cisloOtazky' cols='30' rows='5' placeholder='Tvá odpověď přijde sem...'></textarea></td>";
                    break;
                case "anoNe":
                    $nadpis = $otazka->text;
                    echo "<th id='$cisloOtazky'>$nadpis</th>";
                    echo "<td><input type='radio' id='$cisloOtazky' name='$otazka->text' value='Ano'><label for='Ano'>Ano</label></td>";
                    echo "<td><input type='radio' id='$cisloOtazky' name='$otazka->text' value='Ne'><label for='Ne'>Ne</label></td>";
                    break;
                case "vyber":
                    $nadpis = $otazka->text;
                    echo "<th id='$cisloOtazky'>$nadpis</th>";
                    if ($otazka->pocetZaskrtnutelnych > 1) {
                        /*Možnost vícero odpovědí*/
                        echo "$otazka->pocetZaskrtnutelnych možnosti odpovědi";
                    } else {
                        $cisloOdpovedi = 1; //číslování možností, kvůli zjištění o jakou odpověď se jednalo
                        foreach ($otazka->moznosti as $moznost) {
                            echo "<td><input type='radio' id='$cisloOdpovedi' name='$cisloOtazky' value='$moznost->text'><label for='$moznost->text'>$moznost->text</label></td>";
                            $cisloOdpovedi++;
                        }
                    }
            }
            echo "</table>";
        }
        ?>
        <input type="submit" value="Odeslat">
    </form>
    <footer>
    <address> &copy; 2020-2021 | 4.EP | #SPŠ101 </address>
    *Image by <a style="font-size: 14pt; border: none; padding: 0; margin: 0;" href="https://pixabay.com/users/chiplanay-1971251/?utm_source=link-attribution&amp;utm_medium=referral&amp;utm_campaign=image&amp;utm_content=4232859">chiplanay</a> from <a style="font-size: 14pt; border: none; padding: 0; margin: 0;" href="https://pixabay.com/?utm_source=link-attribution&amp;utm_medium=referral&amp;utm_campaign=image&amp;utm_content=4232859">Pixabay</a>
    </footer>
</body>

</html>