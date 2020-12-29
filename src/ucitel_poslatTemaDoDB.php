<?php

require_once "../../config.php";

$predmet = $_POST["predmet"];
$trida = $_POST["trida"];
$datum = $_POST["datum"];
$tema = $_POST["tema"];
session_start();
$ucitel = $_SESSION['idUcitel'];

$spojeni = mysqli_connect(dbhost, dbuser, dbpass, dbname);

$data = mysqli_query($spojeni, "SELECT id FROM eval_predmety WHERE nazev = '$predmet'");
while ($radek = mysqli_fetch_assoc($data)) {
    $predmetId = $radek['id'];
}

$data2 = mysqli_query($spojeni, "SELECT id FROM eval_tridy WHERE nazev = '$trida'");
while ($radek = mysqli_fetch_assoc($data2)) {
    $tridaId = $radek['id'];
}

mysqli_query($spojeni, "UPDATE eval_hodiny SET temaHodiny = '$tema' WHERE ucitel_id = '$ucitel' AND datum = '$datum' AND predmet_id = '$predmetId' AND trida_id = '$tridaId'");

mysqli_close($spojeni);