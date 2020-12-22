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

mysqli_query($spojeni, "INSERT INTO eval_hodiny (ucitel_id, predmet_id, trida_id, skupina, datum, skolniHodina) VALUES ('$ucitel', '$predmet', '$trida', '$skupina', '$datum', '$skolniHodina')");

mysqli_close($spojeni);