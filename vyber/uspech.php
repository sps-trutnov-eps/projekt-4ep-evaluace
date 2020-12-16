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
       
       session_start();
       $idHodiny = $_SESSION["dotaznik"];

?>

<div id="kontejner">
    <header>
        <h1>Vše v pohodě</h1>
        <?php
        echo "<p>Vaše hodina má  " . $idHodiny . " id.</p>"; 
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