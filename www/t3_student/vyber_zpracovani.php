<?php

require_once "../../config.php";

$kod = $_POST["kod"];

$spojeni = mysqli_connect(dbhost, dbuser, dbpass, dbname);

$dotaz_formulare = "SELECT * FROM eval_formulare WHERE kod = '$kod'";
$data = mysqli_query($spojeni, $dotaz_formulare);

$formular = mysqli_fetch_assoc($data);
date_default_timezone_set('Europe/Prague');

// Zobrazí datum a id hodiny
echo "<script>console.log('".$formular["id"]."')</script>";
echo "<script>console.log('fghfggh')</script>";
echo "<script>console.log('".date("Y\-m\-d")."')</script>";
//echo "<script>console.log('".$nejvetsi[0]."')</script>";

// Neodpovídá žádný záznam
if(empty($formular) == true)
{
    header("location:nenaslo.php");
}

if(date("Y-m-d H:i:s") <= $formular["cas"])
{
    session_start();
    if($formular["pocet"] > 0)
    {
        $Novy_pocet = $formular["pocet"] - 1;
        $id = $formular["id"];
        mysqli_query($spojeni, "UPDATE eval_formulare SET pocet='$Novy_pocet' WHERE id='$id'");
        $_SESSION["hodinaID"] = $id;

        echo "<script>console.log('vse ok')</script>";

        $_SESSION["hodinaID"] = $formular["idHodiny"];
        header("location: ../t5_vyplneni/formular.php");
    }
    else
    {
        header("location: nenaslo.php");
    }
}
elseif(date("Y-m-d H:i:s") > $formular["cas"])
{
    header("location: nenaslo.php");
}
else
{
    header("location:error.php");
}

mysqli_close($spojeni);

?>