<?php

$poslanaData = $_POST;
$encodeJson = array();
foreach($poslanaData as $odpoved){
    $encodeJson[] = array("odpoved" => "$odpoved");
}

echo $encodeJson = json_encode($encodeJson);