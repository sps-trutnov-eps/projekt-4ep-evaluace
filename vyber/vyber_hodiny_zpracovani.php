<?php
require_once "../config.php";

session_start();

$trida = $_SESSION["trida"];
$predmet = $_SESSION["predmet"];
$skupina = $_SESSION["skupina"];
$tridaID = $_SESSION["tridaID"];
$predmetID = $_SESSION["predmetID"];

$hodina = $_POST["hodina"];


$spojeni = mysqli_connect(dbhost, dbuser, dbpass, dbname);

$dotazDotaznik = "SELECT * FROM eval_dotazniky WHERE trida_id = '$tridaID' AND predmet_id = '$predmetID'
AND skupina = '$skupina' AND datum = '$hodina'";


$dotaznik = mysqli_query($spojeni, $dotazDotaznik);

$_SESSION["dotaznik"] = $dotaznik;


mysqli_close($spojeni);

?>