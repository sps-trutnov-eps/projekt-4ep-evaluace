<!DOCTYPE html>
<html lang="cz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulář</title>
</head>
<body>

<?php
    require_once "../../../config.php";
    $spojeni = mysqli_connect(dbhost, dbuser,dbpass,dbname);
    session_start();

    $idHodiny = $_SESSION["hodinaID"];
    
    $idVzoru = mysqli_query($spojeni, "SELECT idVzoru FROM eval_formulare WHERE idHodiny = $idHodiny");
    $formular = mysqli_query($spojeni, "SELECT otazka FROM eval_formulare_vzory WHERE id = $idVzoru");

    $objekt = json_decode($formular);


$data = '
{
    "moznostHodnoceni": "like",
    "otazky": [
        {
            "typ": "text",
            "text": "Otázka 1"
        },
        {
            "typ": "vyber",
            "text": "Otázka 2",
            "pocetZaskrtnutelnych": 1,
            "moznosti": [
                {
                    "text": "Výběr 1"
                },
                {
                    "text": "Výběr 2"
                },
                {
                    "text": "Výběr 3"
                }
            ]
        },
        {
            "typ": "anoNe",
            "text": "Otázka 3"
        }
    ]
}';

//$objekt = json_decode($data); test


?>
<form action="json.php" method="POST" name>
<?php
echo "<table>";
switch($objekt->moznostHodnoceni){
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
    default:       
}
echo "</table>";
$cisloOtazky = 0; //číslování otázek
foreach($objekt->otazky as $otazka){
    $cisloOtazky ++;
    echo "<table>";
    switch($otazka->typ){
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
            if($otazka->pocetZaskrtnutelnych > 1){
                /*Možnost vícero odpovědí*/
                echo "$otazka->pocetZaskrtnutelnych možnosti odpovědi";
            }
            else{
                $cisloOdpovedi = 1; //číslování možností, kvůli zjištění o jakou odpověď se jednalo
                foreach($otazka->moznosti as $moznost){
                    echo "<td><input type='radio' id='$cisloOdpovedi' name='$cisloOtazky' value='$moznost->text'><label for='$moznost->text'>$moznost->text</label></td>";
                    $cisloOdpovedi ++;
                }
            }
    }
    echo "</table>";
}
?>
<input type="submit" value="Odeslat">
</form>

</body>
</html>

