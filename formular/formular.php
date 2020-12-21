<<<<<<< HEAD
<!DOCTYPE html>
<html lang="cz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Formulář</title>
</head>
<main>
    <header>
        <h1>Formulář</h1>
    </header>

    <body>

    <?php
     require_once '../config.php'; // zde bude umístění config.php

     $table = mysqli_connect(dbhost, dbuser, dbpass, dbname);

     $formularIdRozvrh = $_POST[]; // rozvrh pošle info jaký formular se má vypsat

     $formular = mysqli_query($table, "SELECT FROM WHERE = $formularIdRozvrh"); // vybere všechny informace k formuláři který se má vypsat
     $row = mysqli_num_rows($formular); // počet nalezených formuláří s id

     if($row == 1)
     {

       //jedna velká forma a skládat ji?(zde začátek form?)

       $formularDotazu = json_decode($formular,true);
       $nazevDotazniku = "Zde nám zdělte váš názor";

       echo "<form action='' method='post' id ='formularFORM'>";


       foreach($formularDotazu as $otazka)
       {

           switch ($otazka->typ) {
            
            case 'like':
                echo "
                <table><tr>
                <th>$nazevDotazniku</th>
                <td><input type='radio' id='like' value='like' name='option'><label for=''>Like</label></td>
                <td><input type='radio' id='dislike' value='dislike' name='option'><label for=''>Dislike</label></td>
                </tr></table>
                "
                ;
                break;

            case 'hvezda':
                echo "
                <table><tr>
                <th>$nazevDotazniku</th>
                <td><input type='radio' id='1' value='1' name='hvezda'></td>
                <td><input type='radio' id='2' value='2' name='hvezda'></td>
                <td><input type='radio' id='3' value='3' name='hvezda'></td>
                <td><input type='radio' id='4' value='4' name='hvezda'></td>
                <td><input type='radio' id='5' value='5' name='hvezda'></td>
                </tr></table>
                "
                ;
                break;

            case 'bezHodnoceni':
                echo "
                <table><tr>
                <th>$nazevDotazniku<th>
                </tr><table>
                "
                ;
                break;

                //OTAZKY DO SAMOSTATNEHO SWITCH vv

            case 'text':
                echo "
                <table><tr>
                <th>'.$otazka->text.'<th>
                </tr><table>
                "
                ;
                break;

            case 'anoNe':
                echo "
                <table><tr>
                <th>'.$otazka->text.'</th>
                <td><input type='radio' id='like' value='like' name='option'><label for=''>Like</label></td>
                <td><input type='radio' id='dislike' value='dislike' name='option'><label for=''>Dislike</label></td>
                </tr></table>
                "
                ;
            break;

            case 'vyber':
                echo "
                <table><tr>
                <th>'.$otazka->text.'<th>";

                $cisloMoznosti = 0;

                foreach($vyber->moznost as $moznosti)

                    echo"
                    <td><input type='checkbox' id='$cisloMoznosti' name='$cisloMoznosti' value='$cisloMoznosti'><label for='$cisloMoznosti'> '.$moznost->text.'</label><br></td>

                    "                    
                    ;

                $cisloMoznosti++;

                break;

                $cisloMoznosti = 0;
                echo "</tr></table>";

            default:
                echo "                
                <table><tr>
                <th>Někde se stala chyba<th>
                </tr><table>";
                break;
        }

       }

        echo "</form>";

     }
     else
     {
        echo "Jak se vám tohle povedlo?";
     }
     

    ?>

    <footer>
        <i>&copy; Günther, Provazník, Sobotka, Vojtěch, Vaněk 2020</i>
    </footer>
</main>
</html>

=======
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulář</title>
</head>
<body>
<?php
    require_once "../config.php";
    $spojeni = mysqli_connect(dbhost, dbuser,dbpass,dbname);
    //$_POST["něco"]; //-> tady přijde id formuláře
    //$formular = mysqli_query($spojeni, "SELECT * FROM databaze WHERE neco = 'neco'"); //-> tady se vytáhne formulář a uloží se
    //json_decode($formular);
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

$objekt = json_decode($data);
?>
<form action="./json.php" method="POST" name>
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
>>>>>>> t5_vyplneni_sobotka
