



<?php
require_once "../config.php";

session_start();

$dotazniky = $_SESSION["dotazniky"];


?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/student.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Výběr</title>
</head>
<body>


<div id="stranka">
    <header>
    <?php




    ?>
        <h1>Vyberte hodinu.</h1>
    </header>
    <main>
    
<form method="post" action="vyber_hodiny_zpracovani.php">

<label for="hodina">Hodina</label><br />
    <select class="vyber" name="hodina">
            <?php
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            foreach($dotazniky["datum"] as $dotaznik){

                echo "<option value='".$dotaznik/*["skolniHodina"]*/."'>".$dotaznik/*["ucitel_id"]*/."</option>";

            }
            //  výběr určité hodiny, nutno otestovat
            ?>
    </select>



<input type="submit" value="Potvrdit"/>

</form>
</main>
</div>
    <footer>
        <p>&copy; 4.EP 2020</p>
    </footer>
</body>
</html>

<?php
/*
mysqli_close($spojeni);

?>
*/
