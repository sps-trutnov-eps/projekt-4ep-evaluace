<?php
require_once "../../config.php";

$obor = $_POST["obor"];
$rocnik = $_POST["rocnik"];
$predmet = $_POST["predmet"];

$spojeni = mysqli_connect(dbhost, dbuser, dbpass, dbname);

if($obor == 0)
{
    echo "<p>Vyberte prosím obor</p>";
}
elseif($rocnik == 0)
{
    echo "<p>Vyberte prosím ročník</p>";
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