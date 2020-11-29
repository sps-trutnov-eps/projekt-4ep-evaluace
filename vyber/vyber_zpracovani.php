<?php
require_once "../../config.php";

$tridaID = $_POST["trida"]
$predmetID = $_POST["predmet"];
$skupina = $_POST["skupina"];

$spojeni = mysqli_connect(dbhost, dbuser, dbpass, dbname);

$dotazTrida = "SELECT trida FROM eval_tridy WHERE id = '$tridaID'";
$dotazPredmet = "SELECT nazev FROM eval_predmety WHERE id = '$predmetID'";

$trida = mysqli_query($spojeni, $dotazTrida);
$predmet = mysqli_query($spojeni, $dotazPredmet);

session_start();

$_SESSION["trida"] = $trida;
$_SESSION["predmet"] = $predmet;
$_SESSION["skupina"] = $skupina;
$_SESSION["tridaID"] = $tridaID;
$_SESSION["predmetID"] = $predmetID;

header("location:vyber_hodiny.php");





mysqli_close($spojeni);

?>