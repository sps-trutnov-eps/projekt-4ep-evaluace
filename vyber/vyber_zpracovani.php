<?php
require_once "../../config.php";
$trida = $_POST["trida"];
$nazev = $_POST["predmet"];
$nazev = $_POST["předmět"];

$spojeni = mysqli_connect(dbhost, dbuser, dbpass, dbname);
$data = mysqli_query($spojeni, "SELECT * FROM eval_predmety WHERE nazev = '$nazev'");
$data = mysqli_query($spojeni, "SELECT * FROM eval_tridy WHERE trida = '$trida'");


$data = mysqli_query($spojeni,"SELECT * FROM eval_predmety");
$data = mysqli_query($spojeni,"SELECT * FROM eval_tridy");

            
while($neco = mysqli_fetch_assoc($data))
{
    if($jmeno == $neco["jmeno"])
    {
        $nazev = $neco["nazev"];
        $jmeno = $neco["jmeno"];
        $text = $neco["text"];
        $id = $neco["id"];
        echo"<p><form method='post' action='upraveniClanku.php'>
        <input type='hidden' value='$id' name='id'/><br />
        <input type='text' value='$nazev' name='nazev'/><br />
        <input type='text' value='$text' name='text'/><br />
        <input type='submit' value='Upravit'/>";
    }
}


if($trida == 0)
{
    echo "<p>Vyberte prosím třídu</p>";
}
elseif($predmet == 0)
{
    echo "<p>Vyberte prosím předmět</p>";
}
else
{
    echo "<p>Bezva</p>";
}
mysqli_close($spojeni);
