<?php
require_once "../../config.php";
$trida = $_POST["trida"];
$predmet = $_POST["predmet"];

$spojeni = mysqli_connect(dbhost, dbuser, dbpass, dbname);
$data = mysqli_query($spojeni, "SELECT * FROM eval_predmety WHERE nazev = '$nazev'");
$data = mysqli_query($spojeni, "SELECT * FROM eval_tridy WHERE trida = '$trida'");

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
