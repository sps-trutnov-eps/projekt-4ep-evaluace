<?php

require_once "../../config.php";

session_start();
$ucitel = $_SESSION['idUcitel'];

$spojeni = mysqli_connect(dbhost, dbuser, dbpass, dbname);

//$data = mysqli_query($spojeni, "SELECT predmet, trida, skupina FROM eval_hodiny WHERE ucitel_id = '"$ucitel"' AND skolniHodina = '"$skolniHodina"'");
//UDĚLAT SQL PŘÍKAZ

mysqli_close($spojeni);

$json = '{"data":[';
    foreach($data as $radek)
        $json .= '{"'.$radek["predmet"].'","'.$radek["trida"].'","'.$radek["skupina"].'"},';

    $json = substr($json, 0, strlen($json) - 1);
$json .= ']}';

echo $json;