<?php
session_start();
require_once "../../config.php";
$spojeni = mysqli_connect(dbhost, dbuser, dbpass, dbname);
    //odstranit po debugu
    $idHodiny = 153;//$_SESSION["hodinaID"];
    //odstranit po debugu
$poslanaData = $_POST;
$encodeJson = array();
foreach($poslanaData as $odpoved){
    $encodeJson[] = array("odpoved" => "$odpoved");
}
$data = $encodeJson = json_encode($encodeJson);
$idFormulare = mysqli_fetch_assoc(mysqli_query($spojeni, "SELECT * FROM eval_formulare WHERE idHodiny = $idHodiny"));
$idFormulare = $idFormulare["idVzoru"];
mysqli_query($spojeni, "INSERT INTO eval_odpovedi (odpoved, idFormulare) VALUES ('$data', '$idFormulare')");
session_destroy();
header('Location: ../index.html');