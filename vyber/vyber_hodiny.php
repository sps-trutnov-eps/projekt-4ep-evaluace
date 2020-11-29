<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/student.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Výběr</title>
</head>
<body>

<?php
require_once "../../config.php";

session_start();

$tridaID = $_SESSION["tridaID"];
$predmetID = $_SESSION["predmetID"];
$skupina = $_SESSION["skupina"];

$spojeni = mysqli_connect(dbhost, dbuser, dbpass, dbname);

$dotazHodiny = "SELECT skolniHodina FROM eval_dotazniky WHERE trida_id = '$tridaID' AND predmet_id = '$predmet_id' AND skupina = '$skupina'";

$hodiny = mysqli_query($spojeni, $dotazHodiny);

?>

<div id="kontejner">
    <header>
        <h1>Vyberte hodinu.</h1>
    </header>
    <main>
    
<form method="post" action="vyber_hodiny_zpracovani.php">

<label for="hodina">Hodina</label><br />
    <select class="vyber" name="hodina">
            <?php

            foreach($hodiny as $hodina){

                echo "<option value='$hodina'>".$hodina."</option>";

            }
            //  výběr určité hodiny, nutno otestovat
            ?>
    </select>



<input type="submit" value="Potvrdit"/>

</form>
</div>
</main>
    <footer>
        <p>&copy; 4.EP 2020</p>
    </footer>
</body>
</html>

<?php
mysqli_close($spojeni);

?>
