<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Za to může Honza</title>
</head>
<body>
    <?php
    require_once "../config.php";
    $spojeni = mysqli_connect(dbhost, dbuser,dbpass,dbname);
    session_start();
    //$_POST["něco"]; //-> tady přijde id formuláře
    //$formular = mysqli_query($spojeni, "SELECT * FROM databaze WHERE neco = 'neco'"); //-> tady se vytáhne formulář a uloží se
    //json_decode($formular);
    $data = '[
        {
            "typ": "otevrena",
            "text": "Otevřená otázka"
        },
        {
            "typ": "moznosti",
            "text": "Uzavřená otázka s jednou možností",
            "pocetOdp": "1",
            "moznosti": [
                { "text": "První možnost" },
                { "text": "Druhá možnost" },
                { "text": "Třetí možnost" }
            ]
        }
    ]';
    
    $objekt = json_decode($data);    
    $cisloOtazky = 0; //číslování otázek
    foreach($objekt as $otazka){
        $cisloOtazky ++;
        echo "<table>";
        switch($otazka->typ){
            case "otevrena":
                $nadpis = $otazka->text;
                echo "<th id='$cisloOtazky'>$nadpis</th>";
                echo "<td><textarea name='odpoved' id='$cisloOtazky' cols='30' rows='5' placeholder='Tvá odpověď přijde sem...'></textarea></td>";
                break;
            case "moznosti":
                $nadpis = $otazka->text;
                echo "<th id='$cisloOtazky'>$nadpis</th>";
                $cisloOdpovedi = 1; //číslování možností, kvůli zjištění o jakou odpověď se jednalo
                foreach($otazka->moznosti as $moznost){
                    echo "<td><input type='radio' id='$cisloOdpovedi' name='$cisloOtazky' value='$moznost->text'><label for='$moznost->text'>$moznost->text</label></td>";
                    $cisloOdpovedi ++;
                }
                break;
            case "hvezdicky":
                $nadpis = $otazka->text;
                break;
            default:
                /*Honzo nefunguje ti to!*/
        }
        echo "</table>";
    }
    ?>
</body>
</html>