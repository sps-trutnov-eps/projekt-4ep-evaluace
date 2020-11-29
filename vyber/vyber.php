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

    $x = 1;

    $spojeni = mysqli_connect(dbhost, dbuser, dbpass, dbname);
    $predmety = mysqli_query($spojeni, "SELECT nazev FROM eval_predmety");
    $tridy = mysqli_query($spojeni, "SELECT trida FROM eval_tridy");

?>

<div id="kontejner">
    <header>
        <h1>Vyberte svůj obor, třídu a předmět</h1>
    </header>
    <main>
    
<form method="post" action="vyber_zpracovani.php">

<label for="trida">Třída</label><br />
    <select class="vyber" name="trida">
            <?php
            $x = 1;

            foreach($tridy as $trida){
                echo "<option value='$x'>".$trida["trida"]."</option>";
                $x = $x + 1;
            }
            // je samozrejme nutne aby v databazi neco bylo
            ?>
    </select>

<label for="predmet">Předmět</label>
    <select class="vyber" name="predmet">
            <?php
            $x = 1;

            foreach($predmety as $predmet){
                echo "<option value='$x'>".$predmet["nazev"]."</option>";
                $x = $x + 1;
            }
            ?>
    </select>


<label for="skupina">Skupina</label>
    <select class="vyber" name="skupina" size="2">
        <option value="1">1.</option>
        <option value="2">2.</option>
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