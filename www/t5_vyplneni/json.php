<?php
session_start();

$idHodiny = $_SESSION["hodinaID"]

$poslanaData = $_POST;
$encodeJson = array();
foreach($poslanaData as $odpoved){
    $encodeJson[] = array("odpoved" => "$odpoved");
}

$data = $encodeJson = json_encode($encodeJson);

$idFormulare = mysqli_query($spojeni, "SELECT idVzoru FROM eval_formulare WHERE idHodiny = $idHodiny");
mysqli_query($spojeni, "INSERT INTO eval_odpovedi (odpoved, IDformulare) VALUES ('$data', '$idFormulare')");


