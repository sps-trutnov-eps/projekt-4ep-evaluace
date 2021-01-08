<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Výběr</title>
</head>
<body>
<?php
       
       require_once "../../config.php";

       session_start();

       $idHodiny = 0;
       $idNez = 0;

        

        

       $spojeni = mysqli_connect(dbhost, dbuser, dbpass, dbname);


?>

<div id="kontejner">
    <header>
        <h1>Vše v pohodě, zde bude stránka týmu 5</h1>
        <?php
        if(isset($_SESSION["hodinaID"]) == true)
        {
            
            
        $idHodiny = $_SESSION["hodinaID"];

        $dotaz = "SELECT * FROM eval_hodiny WHERE id = '$idHodiny'";
        $data = mysqli_query($spojeni, $dotaz);

        $dotaznik = mysqli_fetch_assoc($data);

        
        echo "<p>Clasic:</p>";
        echo "<p> id dotazníku: " . $dotaznik["id"] . "</p>"; 
        echo "<p> id učitele: " . $dotaznik["ucitel_id"] . "</p>"; 
        echo "<p> id předmětu: " . $dotaznik["predmet_id"] . "</p>"; 
        echo "<p> skupina: " . $dotaznik["skupina"] . "</p>"; 
        echo "<p> datum hodiny: " . $dotaznik["datum"] . "</p>"; 
        echo "<p>Konec</p>";
        }

        if(isset($_SESSION["NezID"]) == true)
        {
        $idNez = $_SESSION["NezID"];

        $dotaz2 = "SELECT * FROM eval_nezarazene WHERE id = '$idNez'";
        $data2 = mysqli_query($spojeni, $dotaz2);

        $dotaznik2 = mysqli_fetch_assoc($data2);
        
        echo "<p>Special:</p>";
        echo "<p> id dotazníku: " . $dotaznik2["id"] . "</p>"; 
        echo "<p> povoleno od: " . $dotaznik2["povoleno_od"] . "</p>"; 
        echo "<p> povoleno do: " . $dotaznik2["povoleno_do"] . "</p>"; 
        echo "<p> id vzoru: " . $dotaznik2["idVzoru"] . "</p>"; 
        echo "<p>Konec</p>";
        }

        $_SESSION = array();
        session_destroy();

        session_start();

        if ($idNez != 0)
        {
            if(empty($idNez) == false)
            {
            $_SESSION["CelkovyDotaznikID"] = $idNez;
            }
        }

        if ($idHodiny != 0)
        {
            if(empty($idHodiny) == false)
            {
            $_SESSION["DotaznikID"] = $idHodiny;
            }
        }



        mysqli_close($spojeni);
        ?>
    </header>
    <main>
        <div id="rozcesti">
            <a href="vyber.php">Zpět</a>
        </div>
    </main>
</div>
    <footer>
        <p>&copy; 4.EP 2020</p>
    </footer>
</body>
</html>