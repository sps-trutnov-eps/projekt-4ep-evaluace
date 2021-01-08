<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Výběr</title>




    <script>

    var idTridy;
    var idSkupiny;
    var idPredmetu;

    function Trida(id)
    {
        
        idTridy = id;
        console.log(idTridy);
    }
    
    function Skupina(id)
    {
    
        idSkupiny = id;
        console.log(idSkupiny);
    } 
    
    function Predmet(id) 
    {
        
        idPredmetu = id;
        console.log(idPredmetu);
    }

    function Zjisti()
    {

    

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("CelkoveZhodnoceni").style.visibility = this.responseText;
        console.log(this.responseText);
      }
    };
    xmlhttp.open("GET", "jeDostupne.php?trida=" + idTridy + "&predmet=" + idPredmetu + "&skupina=" + idSkupiny, true);
    xmlhttp.send();
    }
</script>


</head>
<body onclick="Zjisti()">

<?php
    require_once "../../config.php";


    $spojeni = mysqli_connect(dbhost, dbuser, dbpass, dbname);
    $predmety = mysqli_query($spojeni, "SELECT * FROM eval_predmety");
    $tridy = mysqli_query($spojeni, "SELECT * FROM eval_tridy");

    mysqli_close($spojeni);
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
    <select onclick="Trida(this.value)" class="vyber" name="trida">
            <?php


            foreach($tridy as $trida){
                echo "<option value=".$trida["id"].">".$trida["nazev"]."</option>";

            }
            ?>
    </select><br>

<label for="predmet">Předmět</label><br>
    <select  onclick="Predmet(this.value)" class="vyber" name="predmet">
            <?php

            foreach($predmety as $predmet){
                echo "<option value=".$predmet["id"].">".$predmet["nazev"]."</option>";

            }
            ?>
    </select><br>


<label for="skupina">Skupina</label><br>
    <select onclick="Skupina(this.value)" class="vyber" name="skupina">
        <option value="1">1.</option>
        <option value="2">2.</option>
        <option value="0">Celá třída</option>
    </select><br>

<input type="submit" name="classic" value="Potvrdit"/>
<input id="CelkoveZhodnoceni" type="submit" name="special" value="Celkové zhodnocení" style="visibility: hidden"/>

</form>
</main>
</div>
</div>

    <footer>
    <address> &copy; 2020-2021 | 4.EP | #SPŠ101 </address>
    *Image by <a style="font-size: 14pt; border: none; padding: 0; margin: 0;" href="https://pixabay.com/users/chiplanay-1971251/?utm_source=link-attribution&amp;utm_medium=referral&amp;utm_campaign=image&amp;utm_content=4232859">chiplanay</a> from <a style="font-size: 14pt; border: none; padding: 0; margin: 0;" href="https://pixabay.com/?utm_source=link-attribution&amp;utm_medium=referral&amp;utm_campaign=image&amp;utm_content=4232859">Pixabay</a>
    </footer>
</body>
</html>