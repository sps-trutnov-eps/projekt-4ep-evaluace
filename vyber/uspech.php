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

       session_start();



       $idHodiny = $_SESSION["hodinaID"];
       $idNez = $_SESSION["NezID"];

       $spojeni = mysqli_connect(dbhost, dbuser, dbpass, dbname);

    $dotaz = "SELECT * FROM eval_hodiny WHERE id = '$idHodiny'";
    $data = mysqli_query($spojeni, $dotaz);

    $dotaznik = mysqli_fetch_assoc($data);


    $dotaz2 = "SELECT * FROM eval_nezarazene WHERE id = '$idNez'";
    $data2 = mysqli_query($spojeni, $dotaz2);

    $dotaznik2 = mysqli_fetch_assoc($data2);

?>

<div id="kontejner">
    <header>
        <h1>Vše v pohodě</h1>
        <?php
        echo "<p>" . $dotaznik["id"] . "</p>"; 
        echo "<p>" . $dotaznik["ucitel_id"] . "</p>"; 
        echo "<p>" . $dotaznik["predmet_id"] . "</p>"; 
        echo "<p>" . $dotaznik["skupina"] . "</p>"; 
        echo "<p>" . $dotaznik["datum"] . "</p>"; 


        echo "<p>" . $dotaznik2["id"] . "</p>"; 
        echo "<p>" . $dotaznik2["povoleno_od"] . "</p>"; 
        echo "<p>" . $dotaznik2["povoleno_do"] . "</p>"; 
        echo "<p>" . $dotaznik2["idVzoru"] . "</p>"; 

        ?>
    </header>
    <main>
    <a href="vyber.php">Zpět</a>

    </main>
</div>
    <footer>
        <p>&copy; 4.EP 2020</p>
    </footer>
</body>
</html>