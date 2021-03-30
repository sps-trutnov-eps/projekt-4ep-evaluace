<?php
require_once "../../config.php";

$kod = $_POST["kod"];


$spojeni = mysqli_connect(dbhost, dbuser, dbpass, dbname);

$dotaz_formulare = "SELECT * FROM eval_formulare WHERE kod = '$kod'";
$data = mysqli_query($spojeni, $dotaz_formulare);

$formular = mysqli_fetch_assoc($data);
session_start();


date_default_timezone_set('Europe/Prague');


///////////////////////////////////////////////////////////// normální vyplnění dotazníku
/*
if (isset($_POST['classic']) == true)
{
*/


// Zobrazí datum a id hodiny
echo "<script>console.log('".$formular["id"]."')</script>";
echo "<script>console.log('fghfggh')</script>";
echo "<script>console.log('".date("Y\-m\-d")."')</script>";
//echo "<script>console.log('".$nejvetsi[0]."')</script>";




/// Neodpovídá žádný záznam

if(empty($formular) == true)
{
    //echo "<script>console.log('classic nefunguje')</script>";
    header("location:nenaslo.php");
}

if(date("Y\-m\-d") <= $formular["cas"])
{


    if($formular["pocet"] > 0)
    {
        $Novy_pocet = $formular["pocet"] - 1;
        $id = $formular["id"];
        mysqli_query($spojeni, "UPDATE eval_formulare SET pocet='$Novy_pocet' WHERE id='$id'");
        $_SESSION["hodinaID"] = $id;

        echo "<script>console.log('vse ok')</script>";
            header("location:../t5_vyplneni/formular.php");
    }
    else
    {

        //echo "<script>console.log('spatny pocet')</script>";
        header("location:nenaslo.php");
    }

}
elseif(date("Y\-m\-d") > $formular["cas"])
{

    //echo "<script>console.log('spatny datum')</script>";
    header("location:nenaslo.php");
}

else
{
    
    //echo "<script>console.log('vse spatne')</script>";

    header("location:error.php");
}
/*
}
/*
/////////////////////////////////////////////////////////////////////////// vyplnění celkového dotazníku (za pololetí)
/*
else if (isset($_POST['special']) == true)
{



if(empty($formular) == true)
{
    //echo "<script>console.log('special nefunguje')</script>";
    header("location:nenaslo.php");
}

else
{
    //echo "<script>console.log('special funguje')</script>";
    header("location:../t5_vyplneni/formular.php");
}




}
/////////////////////////////////////////////////////////////////////////// chyba
else
{
    //echo "<script>console.log('nic nefunguje')</script>";
    header("location:error.php");
}
//echo "<script>console.log('".$dotazniky["id"]."')</script>";
//echo "<script>console.log('".$dotazniky["skolniHodina"]."')</script>";

*/
mysqli_close($spojeni);

?>