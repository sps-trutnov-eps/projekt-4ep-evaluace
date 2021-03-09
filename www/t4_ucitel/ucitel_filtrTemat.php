<?php

require_once "../../config.php";

session_start();
$ucitel = $_SESSION['idUcitel'];
$predmet = $_POST['predmet'];
$trida = $_POST['trida'];
$Od = $_POST['Od'];
$Do = $_POST['Do'];

$spojeni = mysqli_connect(dbhost, dbuser, dbpass, dbname);

$data = mysqli_query($spojeni, "SELECT p.nazev AS predmet, t.nazev AS trida, h.skupina AS skupina, h.datum AS datum, h.temaHodiny AS temaHodiny, h.id AS idHodiny FROM (eval_hodiny h LEFT JOIN eval_predmety p ON h.idPredmetu = p.id) LEFT JOIN eval_tridy t ON h.idTridy = t.id WHERE h.idUcitele = '$ucitel' AND p.nazev = '$predmet' AND t.nazev = '$trida' AND h.datum >= '$Od' AND h.datum <= '$Do' ORDER BY datum");

$data2 = mysqli_query($spojeni, "SELECT idHodiny FROM eval_formulare");

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

$json .= '], "idHodiny":[';
    foreach($data as $radek) {
        $json .= '"'.$radek["idHodiny"].'",';
    }

$json .= '], "dotaznik":[';
    foreach($data as $radek1) {
        foreach($data2 as $radek2) {
            if($radek1["idHodiny"] == $radek2["idHodiny"]) {
                $json .= '1';
                break;
            }
        }
        $json .= '0,';
    }

$json .= ']}';

echo $json;