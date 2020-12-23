<?php

require_once "../../config.php";

session_start();
$ucitel = $_SESSION['idUcitel'];
$predmet = $_POST['predmet'];
$Od = $_POST['Od'];
$Do = $_POST['Do'];

$spojeni = mysqli_connect(dbhost, dbuser, dbpass, dbname);

$data = mysqli_query($spojeni, "SELECT p.nazev AS predmet, t.nazev AS trida, h.skupina AS skupina, h.datum AS datum, h.temaHodiny AS temaHodiny FROM (eval_hodiny h LEFT JOIN eval_predmety p ON h.predmet_id = p.id) LEFT JOIN eval_tridy t ON h.trida_id = t.id WHERE h.ucitel_id = '$ucitel' AND p.nazev = '$predmet' AND h.datum >= '$Od' AND h.datum <= '$Do' ORDER BY datum");

mysqli_close($spojeni);


$json = '{"predmet":[';
    foreach($data as $radek) {
        $json .= '"'.$radek["predmet"].'",';
    }

$json .= '], "trida":[';
    foreach($data as $radek) {
        $json .= '"'.$radek["trida"].'",';
    }

$json .= '], "skupina":[';
    foreach($data as $radek) {
        $json .= '"'.$radek["skupina"].'",';
    }

$json .= '], "datum":[';
    foreach($data as $radek) {
        $json .= '"'.$radek["datum"].'",';
    }

$json .= '], "temaHodiny":[';
    foreach($data as $radek) {
        $json .= '"'.$radek["temaHodiny"].'",';
    }

$json .= ']}';

echo $json;