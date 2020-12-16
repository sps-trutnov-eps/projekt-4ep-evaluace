<?php

require_once "../../config.php";

session_start();
$ucitel = $_SESSION['idUcitel'];

$spojeni = mysqli_connect(dbhost, dbuser, dbpass, dbname);

$predmety = mysqli_query($spojeni, "SELECT  FROM eval_hodiny WHERE ucitel_id = "$ucitel" OR skolniHodina = "$skolniHodina"");

mysqli_close($spojeni);

$json = '{"data":[';
    foreach($predmety as $radek)
        $json .= '"'.$radek["nazev"].'",';

    $json = substr($json, 0, strlen($json) - 1);
$json .= ']}';

echo $json;

//ZATÍM NEFUNKČNÍ!!!!!!!!!!!!!!!!!!