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


    $spojeni = mysqli_connect(dbhost, dbuser, dbpass, dbname);
    $predmety = mysqli_query($spojeni, "SELECT * FROM eval_predmety");
    $tridy = mysqli_query($spojeni, "SELECT * FROM eval_tridy");

?>

    <header>
        <h1>Vyberte svoji třídu a předmět</h1>
    </header>
    <div id="stranka">
    <div id="student">

    <main>
    
<form method="post" action="vyber_zpracovani.php">

<br>

<label for="trida">Třída</label><br />
    <select class="vyber" name="trida">
            <?php
            

            foreach($tridy as $trida){
                echo "<option value=".$trida["id"].">".$trida["trida"]."</option>";
                
            }
            // je samozrejme nutne aby v databazi neco bylo
            ?>
    </select><br>

<label for="predmet">Předmět</label><br>
    <select class="vyber" name="predmet">
            <?php

            foreach($predmety as $predmet){
                echo "<option value=".$predmet["id"].">".$predmet["nazev"]."</option>";

            }
            ?>
    </select><br>


<label for="skupina">Skupina</label><br>
    <select class="vyber" name="skupina">
        <option value="1">1.</option>
        <option value="2">2.</option>
        <option value="0">Celá třída</option>
    </select><br>

<input type="submit" name="classic" value="Potvrdit"/>
<input type="submit" name="special" value="Celkové zhodnocení" style="visibility: hidden"/>

</form>
</main>
</div>
</div>

    <footer>
    <address> &copy; 2020-2021 | 4.EP | #SPŠ101 </address>
    *Image by <a href="https://pixabay.com/users/chiplanay-1971251/?utm_source=link-attribution&amp;utm_medium=referral&amp;utm_campaign=image&amp;utm_content=4232859">chiplanay</a> from <a href="https://pixabay.com/?utm_source=link-attribution&amp;utm_medium=referral&amp;utm_campaign=image&amp;utm_content=4232859">Pixabay</a>
    </footer>
</body>
</html>