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

$spojeni = mysqli_connect(dbhost, dbuser, dbpass, dbname);
$data = mysqli_query($spojeni,"SELECT * FROM 'eval_otazky'"); 
$data = mysqli_query($spojeni,"SELECT * FROM 'eval_odpovedi'");
echo"
<datalist id='datum'>
";
$data_dotazniky = mysqli_query($spojeni,"SELECT * FROM `eval_hodiny`"); 
while($datum = mysqli_fetch_assoc($data_dotazniky))
{
    $date = $datum["datum"]; 
    echo"<option value='$date'>";
}
echo"
</datalist>
<datalist id='predmet'>
";
$data_predmety = mysqli_query($spojeni,"SELECT p.nazev FROM eval_predmety p INNER JOIN eval_hodiny h ON h.predmet_id = p.id"); 
while($predmety = mysqli_fetch_assoc($data_predmety))
{  
    $predmet = $predmety["predmet"];
    echo"<option value='$predmet'>";
}
echo"
</datalist>";
mysqli_close($spojeni);
?>
<form method='post' action='eval_vasledky_vypis.php'>
    <input type='list' list='datum' name='datum'/><br>
    <input type='list' list='predmet' name='predmet'/><br>
    <input type='submit' name='Potvrdit'><br>
</form>
</main>    
</body>
</html>