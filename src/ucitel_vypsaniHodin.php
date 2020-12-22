<?php

require_once "../../config.php";

session_start();
$ucitel = $_SESSION['idUcitel'];
$skolniHodina = $_POST['skolniHodina'];

$spojeni = mysqli_connect(dbhost, dbuser, dbpass, dbname);

$data = mysqli_query($spojeni, "SELECT p.nazev AS predmet, t.nazev AS trida, h.skupina AS skupina FROM (eval_hodiny h LEFT JOIN eval_predmety p ON h.predmet_id = p.id) LEFT JOIN eval_tridy t ON h.trida_id = t.id WHERE h.ucitel_id = '$ucitel' AND skolniHodina = '$skolniHodina' GROUP BY p.nazev, t.nazev, h.skupina");

mysqli_close($spojeni);

$json = '{"data":[';
    foreach($data as $radek)
        $json .= '"'.$radek["predmet"].'","'.$radek["trida"].'","'.$radek["skupina"].'"';

$json .= ']}';

echo $json;