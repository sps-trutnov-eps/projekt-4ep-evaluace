<?php
require_once "../config.php";

$tridaID = $_POST["trida"];
$predmetID = $_POST["predmet"];
$skupina = $_POST["skupina"];

$spojeni = mysqli_connect(dbhost, dbuser, dbpass, dbname);

$dotazTrida = "SELECT trida FROM eval_tridy WHERE id = '$tridaID'";
$dotazPredmet = "SELECT nazev FROM eval_predmety WHERE id = '$predmetID'";

/*
$trida = mysqli_query($spojeni, $dotazTrida);
$predmet = mysqli_query($spojeni, $dotazPredmet);
*/

$dotazHodiny = "SELECT * FROM eval_dotazniky WHERE trida_id = '$tridaID' AND predmet_id = '$predmetID' AND skupina = '$skupina'";
$data = mysqli_query($spojeni, $dotazHodiny);

$dotazniky = mysqli_fetch_assoc($data);

session_start();
/*
$_SESSION["trida"] = $trida;
$_SESSION["predmet"] = $predmet;
$_SESSION["skupina"] = $skupina;
$_SESSION["tridaID"] = $tridaID;
$_SESSION["predmetID"] = $predmetID;
*/
$_SESSION["dotazniky"] = $dotazniky;

if(empty($dotazniky["datum"]) == true)
{
    header("location:error.php");
}

else
{
    header("location:vyber_hodiny.php");
}

//echo "<script>console.log('".date("Y-m-d")."')</script>";
echo "<script>console.log('".$dotazniky["datum"]."')</script>";
echo "<script>console.log('".$dotazniky["skolniHodina"]."')</script>";


mysqli_close($spojeni);

?>