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

