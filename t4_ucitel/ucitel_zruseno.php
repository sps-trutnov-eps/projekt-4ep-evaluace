<?php

require_once "../../config.php";

$predmet = $_POST["predmet"];
$trida = $_POST["trida"];
$datum = $_POST["datum"];
session_start();
$ucitel = $_SESSION['idUcitel'];

$spojeni = mysqli_connect(dbhost, dbuser, dbpass, dbname);

$data = mysqli_query($spojeni, "SELECT id FROM eval_predmety WHERE nazev = '$predmet'");
while ($radek = mysqli_fetch_assoc($data)) {
    $id = $radek['id'];
}

$data2 = mysqli_query($spojeni, "SELECT id FROM eval_tridy WHERE nazev = '$trida'");
while ($radek = mysqli_fetch_assoc($data2)) {
    $idT = $radek['id'];
}

$data3 = mysqli_query($spojeni, "SELECT * FROM eval_hodiny WHERE idUcitele = '$ucitel' AND datum = '$datum' AND idPredmetu = '$id' AND idTridy = '$idT'");
while($radek = mysqli_fetch_assoc($data3)) {
    $zruseno = $radek['zruseno'];
}

if ($zruseno == 0) {
    mysqli_query($spojeni, "UPDATE eval_hodiny SET zruseno = '1' WHERE idUcitele = '$ucitel' AND datum = '$datum' AND idPredmetu = '$id' AND idTridy = '$idT'");

    $vsechno = mysqli_query($spojeni, "SELECT * FROM eval_hodiny WHERE idUcitele = '$ucitel' AND idPredmetu = '$id' AND idTridy = '$idT' AND datum > '$datum'");
    $pocetRadku = mysqli_num_rows($vsechno);

    $zkouska = mysqli_query($spojeni, "SELECT * FROM eval_hodiny WHERE idUcitele = '$ucitel' AND idPredmetu = '$id' AND idTridy = '$idT' AND datum = (SELECT max(datum) FROM eval_hodiny WHERE idUcitele = '$ucitel' AND idPredmetu = '$id' AND idTridy = '$idT' AND datum > '$datum')");
    while ($radek = mysqli_fetch_assoc($zkouska)) {
        $posledni = $radek['datum'];
    }
    $zkouska2 = mysqli_query($spojeni, "SELECT * FROM eval_hodiny WHERE idUcitele = '$ucitel' AND idPredmetu = '$id' AND idTridy = '$idT' AND datum = (SELECT max(datum) FROM eval_hodiny WHERE idUcitele = '$ucitel' AND idPredmetu = '$id' AND idTridy = '$idT' AND datum < '$posledni')");
    while ($radek = mysqli_fetch_assoc($zkouska2)) {
        $predposledni = $radek['datum'];
    }

    $data4 = mysqli_query($spojeni, "SELECT * FROM eval_hodiny WHERE idUcitele = '$ucitel' AND datum = '$predposledni' AND idPredmetu = '$id' AND idTridy = '$idT'");
    while ($radek = mysqli_fetch_assoc($data4)) {
        $temaHodiny = $radek['temaHodiny'];
    }

    mysqli_query($spojeni, "UPDATE eval_hodiny SET temaHodiny = '$temaHodiny' WHERE idUcitele = '$ucitel' AND datum = '$posledni' AND idPredmetu = '$id' AND idTridy = '$idT'");

    for ($i=$pocetRadku; $i > 0; $i--) {
        $zkouska = mysqli_query($spojeni, "SELECT * FROM eval_hodiny WHERE idUcitele = '$ucitel' AND idPredmetu = '$id' AND idTridy = '$idT' AND datum = (SELECT max(datum) FROM eval_hodiny WHERE idUcitele = '$ucitel' AND idPredmetu = '$id' AND idTridy = '$idT' AND datum = '$predposledni')");
        while ($radek = mysqli_fetch_assoc($zkouska)) {
            $posledni = $radek['datum'];
            $posledniZruseno = $radek['zruseno'];
        }
        $zkouska2 = mysqli_query($spojeni, "SELECT * FROM eval_hodiny WHERE idUcitele = '$ucitel' AND idPredmetu = '$id' AND idTridy = '$idT' AND datum = (SELECT max(datum) FROM eval_hodiny WHERE idUcitele = '$ucitel' AND idPredmetu = '$id' AND idTridy = '$idT' AND datum < '$posledni')");
        while ($radek = mysqli_fetch_assoc($zkouska2)) {
            $predposledni = $radek['datum'];
        }
        $data4 = mysqli_query($spojeni, "SELECT temaHodiny FROM eval_hodiny WHERE idUcitele = '$ucitel' AND datum = '$predposledni' AND idPredmetu = '$id' AND idTridy = '$idT'");
        while ($radek = mysqli_fetch_assoc($data4)) {
            $temaHodiny = $radek['temaHodiny'];
        }
        if ($posledniZruseno == 1) {
        }
        else {
            mysqli_query($spojeni, "UPDATE eval_hodiny SET temaHodiny = '$temaHodiny' WHERE idUcitele = '$ucitel' AND datum = '$posledni' AND idPredmetu = '$id' AND idTridy = '$idT'");
        }
    }
} else {
    mysqli_query($spojeni, "UPDATE eval_hodiny SET zruseno = '0' WHERE idUcitele = '$ucitel' AND datum = '$datum' AND idPredmetu = '$id' AND idTridy = '$idT'");
}




mysqli_close($spojeni);