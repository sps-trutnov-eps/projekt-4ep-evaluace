<?php

require_once "../../config.php";

$spojeni = mysqli_connect(dbhost, dbuser, dbpass, dbname);

$predmety = mysqli_query($spojeni, "SELECT id, nazev FROM eval_predmety");
$tridy = mysqli_query($spojeni, "SELECT id, nazev FROM eval_tridy");

mysqli_close($spojeni);

$json = '{"data1":[';
    foreach($predmety as $radek)
        $json .= '{"nazev":"'.$radek["nazev"].'","id":"'.$radek["id"].'"},';

    $json = substr($json, 0, strlen($json) - 1);
$json .= '],';

$json .= '"data2":[';
    foreach($tridy as $radek)
        $json .= '{"nazev":"'.$radek["nazev"].'","id":"'.$radek["id"].'"},';

    $json = substr($json, 0, strlen($json) - 1);
$json .= ']}';

echo $json;