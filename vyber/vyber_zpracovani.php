<?php
require_once "../../config.php";
$trida = $_POST["trida"];
$predmet = $_POST["predmet"];

$spojeni = mysqli_connect(dbhost, dbuser, dbpass, dbname);

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