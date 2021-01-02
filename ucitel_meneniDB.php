<?php

require_once "../../config.php";

$predmet = $_POST["predmet"];
$trida = $_POST["trida"];
$skupina = $_POST["skupina"];
$skolniHodina = $_POST["skolniHodina"];
$datum = $_POST["datum"];
session_start();
$ucitel = $_SESSION['idUcitel'];

$spojeni = mysqli_connect(dbhost, dbuser, dbpass, dbname);

mysqli_query($spojeni, "UPDATE eval_hodiny SET idPredmetu = '$predmet', idTridy = '$trida', skupina = '$skupina' WHERE idUcitele = '$ucitel' AND datum = '$datum' AND skolniHodina = '$skolniHodina'");

mysqli_close($spojeni);