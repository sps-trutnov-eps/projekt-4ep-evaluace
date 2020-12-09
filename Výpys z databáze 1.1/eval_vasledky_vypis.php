<!DOCTYPE html>
<html lang="en">
<head>
    <title>Evaulace</title>
</head>
<body>
<main>
<?php
require_once "../../config.php";

$datum = $_POST["datum"];
$predmet = $_POST["predmet"];

$spojeni = mysqli_connect(dbhost, dbuser, dbpass, dbname);
$data = mysqli_query($spojeni,"SELECT * FROM 'eval_otazky'"); 
$data = mysqli_query($spojeni,"SELECT * FROM 'eval_odpovedi'");
echo"
<datalist id='datum'>
";
$data_dotazniky = mysqli_query($spojeni,"SELECT 'datum' FROM 'eval_rozvrh'"); 
while($datum = mysqli_fetch_assoc($data_dotazniky))
{
    echo"<option value='$datum'>";
}
echo"
</datalist>
<datalist id='predmet'>
";
$data_predmety = mysqli_query($spojeni,"SELECT 'nazev' FROM 'eval_predmety'"); 
while($predmet = mysqli_fetch_assoc($data_predmety))
{  
    echo"<option value='$predmet'>";
}
echo"
</datalist>";
mysqli_close($spojeni);
?>
<form method='post' action='eval_vasledky_vypis.php'>
    <input type='list' list='datum' name='datum'/><br>
    <input type='list' list='predmet' name='permet'/><br>
</form>
</main>    
</body>
</html>