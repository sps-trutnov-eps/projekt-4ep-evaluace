<!DOCTYPE html>
<html lang="en">
<head>
    <title>Evaulace</title>
</head>
<body>
<main>
<?php
require_once "../config.php";

if (isset($_POST["datum"]))$datum = $_POST["datum"];
if (isset($_POST["predmet"]))$predmet = $_POST["predmet"];
session_start();
$ucitel = $_SESSION["ucitel"];

$spojeni = mysqli_connect(dbhost, dbuser, dbpass, dbname);
echo"
<datalist id='datum'>
";
$data_dotazniky = mysqli_query($spojeni,"SELECT DISTINCT datum FROM `eval_hodiny` WHERE ucitel_id = (SELECT id FROM eval_ucitele WHERE email = '$ucitel')"); 
while($datum = mysqli_fetch_assoc($data_dotazniky))
{
    $date = $datum["datum"]; 
    echo"<option value='$date'>";
}
echo"
</datalist>
<datalist id='predmet'>
";
$data_predmety = mysqli_query($spojeni,"SELECT DISTINCT p.nazev FROM eval_predmety p INNER JOIN eval_hodiny h ON h.predmet_id = p.id WHERE h.ucitel_id = (SELECT id FROM eval_ucitele WHERE email = '$ucitel')"); 
while($predmety = mysqli_fetch_assoc($data_predmety))
{  
    $nazev = $predmety["nazev"];
    echo"<option value='$nazev'>";
}
echo"
</datalist>
<datalist id='tridy'>
";
$data_tridy = mysqli_query($spojeni,"SELECT DISTINCT t.trida FROM eval_tridy t INNER JOIN eval_hodiny h ON h.trida_id = t.id WHERE h.ucitel_id = (SELECT id FROM eval_ucitele WHERE email = '$ucitel')"); 
while($tridy = mysqli_fetch_assoc($data_tridy))
{  
    $trida = $tridy["trida"];
    echo"<option value='$trida'>";
}
echo"
</datalist>
<datalist id='skupina'>
";
$data_dotazniky = mysqli_query($spojeni,"SELECT DISTINCT skupina FROM eval_hodiny WHERE ucitel_id = (SELECT id FROM eval_ucitele WHERE email = '$ucitel')"); 
while($datum = mysqli_fetch_assoc($data_dotazniky))
{
    $skupina = $datum["skupina"]; 
    echo"<option value='$skupina'>";
}
echo"
</datalist>
<div>
<form method='post' action='eval_vasledky_vypis.php'>
    <label for='datum'>Vyberte datum:</label><br>
    <input type='list' list='datum' name='datum'/><br>
    <label for='predmet'>Vyberte předmět:</label><br>
    <input type='list' list='predmet' name='predmet'/><br>
    <label for='tridy'>Vyberte třídu:</label><br>
    <input type='list' list='tridy' name='tridy'/><br>
    <label for='skupina'>Vyberte skupinu:</label><br>
    <input type='list' list='skupina' name='skupina'/><br>
    <input type='submit' name='Potvrdit'><br>
</form>
</div>
<div>";
$ucitel = 'senkyr';
$data_vysledky = mysqli_query($spojeni,"SELECT u.email, t.trida, p.nazev, h.datum, h.temaHodiny, h.zruseno FROM eval_hodiny h INNER JOIN eval_ucitele u ON h.ucitel_id = u.id LEFT JOIN eval_tridy t ON h.trida_id = t.id LEFT JOIN eval_predmety p ON h.predmet_id = p.id  WHERE ucitel_id = (SELECT id FROM eval_ucitele WHERE email = '$ucitel')"); 
while($vysledky = mysqli_fetch_assoc($data_vysledky))
{
    $vysledek = $vysledky["email"] . " " . $vysledky["trida"] . " " . $vysledky["nazev"] . " " . $vysledky["temaHodiny"]; 
    echo"<p>$vysledek</p>";
}
echo"
</div>";
mysqli_close($spojeni);
?>
</main>    
</body>
</html>