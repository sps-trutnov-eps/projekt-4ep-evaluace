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
    require_once "../config.php";

    $x = 1;

    $spojeni = mysqli_connect(dbhost, dbuser, dbpass, dbname);
    $predmety = mysqli_query($spojeni, "SELECT * FROM eval_predmety");
    $tridy = mysqli_query($spojeni, "SELECT * FROM eval_tridy");

?>

<div id="stranka">
    <header>
        <h1>Vyberte svůj třídu a předmět</h1>
    </header>
    <main>
    
<form method="post" action="vyber_zpracovani.php">

<label for="trida">Třída</label><br />
    <select class="vyber" name="trida">
            <?php
            //$x = 1;

            foreach($tridy as $trida){
                echo "<option value=".$trida["id"].">".$trida["trida"]."</option>";
                //$x = $x + 1;
            }
            // je samozrejme nutne aby v databazi neco bylo
            ?>
    </select>

<label for="predmet">Předmět</label>
    <select class="vyber" name="predmet">
            <?php
            //$x = 1;

            foreach($predmety as $predmet){
                echo "<option value=".$predmet["id"].">".$predmet["nazev"]."</option>";
                //$x = $x + 1;
            }
            ?>
    </select>


<label for="skupina">Skupina</label><br>
    <select class="vyber" name="skupina">
        <option value="1">1.</option>
        <option value="2">2.</option>
    </select>

<input id="submit" type="submit" value="Potvrdit"/>

</form>
</main>
</div>

    <footer>
        <p>&copy; 4.EP 2020</p>
    </footer>
</body>
</html>