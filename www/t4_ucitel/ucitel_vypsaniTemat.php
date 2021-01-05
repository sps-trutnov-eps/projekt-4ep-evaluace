<?php

require_once "../../config.php";

session_start();
$ucitel = $_SESSION['idUcitel'];
$skolniHodina = $_POST['skolniHodina'];

$spojeni = mysqli_connect(dbhost, dbuser, dbpass, dbname);

$data2 = mysqli_query($spojeni, "SELECT p.nazev AS predmet, t.nazev AS trida FROM (eval_hodiny h LEFT JOIN eval_predmety p ON h.idPredmetu = p.id) LEFT JOIN eval_tridy t ON h.idTridy = t.id WHERE h.idUcitele = '$ucitel' AND skolniHodina = '$skolniHodina' GROUP BY predmet, trida");

while ($radek = mysqli_fetch_assoc($data2)) {
    $konkretniPredmet = $radek['predmet'];
    $konkretniTrida = $radek['trida'];
}

$data = mysqli_query($spojeni, "SELECT p.nazev AS predmet, t.nazev AS trida, h.skupina AS skupina, h.datum AS datum, h.temaHodiny AS temaHodiny, h.zruseno AS zruseno, h.id AS idHodiny FROM (eval_hodiny h LEFT JOIN eval_predmety p ON h.idPredmetu = p.id) LEFT JOIN eval_tridy t ON h.idTridy = t.id WHERE h.idUcitele = '$ucitel' AND p.nazev = '$konkretniPredmet' AND t.nazev ='$konkretniTrida' ORDER BY datum");

mysqli_close($spojeni);


$json = '{"predmet":[';
    foreach($data as $radek) {
        $json .= '"'.$radek["predmet"].'",';
    }

$json .= '], "zruseno":[';
    foreach($data as $radek) {
        $json .= '"'.$radek["zruseno"].'",';
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

$json .= '], "idHodiny":['; 
    foreach($data as $radek) { 
        $json .= '"'.$radek["idHodiny"].'",'; 
    } 

$json .= ']}';

echo $json;