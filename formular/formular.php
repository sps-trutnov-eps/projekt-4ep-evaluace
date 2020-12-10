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

     if (mysqli_connect_errno()) 
     { 
        echo "Připojení do databáze selhalo."; 
     } 
     else
     {
        //ZBYTEK KÓDU SEM
     }

     $formularIdRozvrh = $_POST[]; // rozvrh pošle info jaký formular se má vypsat

     $formular = mysqli_query($table, "SELECT FROM WHERE = $formularIdRozvrh"); // vybere všechny informace k formuláři který se má vypsat
     $row = mysqli_num_rows($formular); // počet nalezených formuláří s id

     if($row == 1)
     {

        // ZDE BUDE ROZEBRÁN STRING OD ZLESÁKA A UTVOŘEN Z TOHO FORMULÁŘ

        $formularDotazu = json_decode($formular,true);
        $nazevDotazniku = "Zde nám zdělte váš názor";

        //prvni Ano/Ne, hvezdy, Bez Hodnoceni

       //jedna velká forma a skládat ji?(zde začátek form?)
       echo "<form action='' method='post' id ='formularFORM'>";

       foreach($formularDotazu as $otazka)
       {

           switch ($otazka->typ) {
            
            case 'AnoNe':
                echo "
                <table><tr>
                <th>$nazevDotazniku</th>
                <td><input type='radio' id='like' value='like' name='option'><label for=''>Like</label></td>
                <td><input type='radio' id='dislike' value='dislike' name='option'><label for=''>Dislike</label></td>
                </tr></table>
                "
                ;
                break;

            case 'Hvezda':
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

            case 'BezHodnoceni':
                echo "
                <table><tr>
                <th>$nazevDotazniku<th>
                </tr><table>
                "
                ;
                break;

            case 'text':
                echo "
                <table><tr>
                <th>'.$otazka->text.'<th>
                </tr><table>
                "
                ;
                break;
                

                    

            default:
                echo "                
                <table><tr>
                <th>Někde se stala chyba<th>
                </tr><table>";
                break;
        }

       }

        echo "</form>"

     }
     else
     {
        echo "Jak se vám tohle povedlo?";
     }
     

    ?>

    <p>Příklad jak to bude vypadat.</p>


    <!-- 

    Následující kód bude nahrazen kódem který autmaticky píše otázky podle dat.
    @Vojtech @Sobotka

    -->

        <form action="formular.php" method="post">
            <table>
                <th>
                    Zde nám zdělte váš názor
                </th>
                <tr>
                    <td><input type="radio" id="like" value="like" name="option"><label for="">Like</label></td>
                    <td><input type="radio" id="dislike" value="dislike" name="option"><label for="">Dislike</label></td>
                </tr>
                <tr>
                    <td colspan="2"><textarea placeholder="Zde napište vaše případné poznámky." name="text" id="text" style="resize: none;" maxlength="250" cols="40" rows="10"></textarea></td>
                </tr>
                
                <tr>
                    <td><input type="submit" value="Odeslat"><td>
                </tr>
            </table>
        </form>
    </body>





    <footer>
        <i>&copy; Günther, Provazník, Sobotka, Vojtěch, Vaněk 2020</i>
    </footer>
</main>
</html>

