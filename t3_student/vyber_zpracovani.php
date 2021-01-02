<?php
require_once "../../config.php";

$tridaID = $_POST["trida"];
$predmetID = $_POST["predmet"];
$skupina = $_POST["skupina"];

$spojeni = mysqli_connect(dbhost, dbuser, dbpass, dbname);

$dotazHodiny = "SELECT * FROM eval_hodiny WHERE trida_id = '$tridaID' AND predmet_id = '$predmetID' AND skupina = '$skupina'";
$data = mysqli_query($spojeni, $dotazHodiny);

$dotazHodiny2 = "SELECT * FROM eval_hodiny WHERE trida_id = '$tridaID' AND predmet_id = '$predmetID' AND skupina = '$skupina' LIMIT 1";

$dotazniky = mysqli_fetch_all($data);
session_start();

$i = 0;
$nejvetsi;


///////////////////////////////////////////////////////////// normální vyplnění dotazníku
if (isset($_POST['classic']) == true)
{



while($i <= count($dotazniky))
{

    if(empty($dotazniky[$i-1]) == false)
    {
        if(empty($dotazniky[$i]) == false)
        {
            if ($dotazniky[$i][5] > $dotazniky[$i-1][5])
            {
                if ($dotazniky[$i][5] > $nejvetsi[5])
                {
                    $nejvetsi = $dotazniky[$i];
                }
            }
        }
        else
        {
            
        }
    }
    else
    {
        $nejvetsi = $dotazniky[$i];
    }

    $i++;

}
// Zobrazí datum a id hodiny
//echo "<script>console.log('".$nejvetsi[5]."')</script>";
//echo "<script>console.log('".$nejvetsi[0]."')</script>";




$hodinaID = $nejvetsi[0];

$dotaz3 = "SELECT * FROM eval_formulare WHERE idHodiny = '$hodinaID'";
$data5 = mysqli_query($spojeni, $dotaz3);
$formular = mysqli_fetch_assoc($data5);
$formularID = $formular["id"];

$_SESSION["formularID"] = $formularID;
$_SESSION["hodinaID"] = $hodinaID;

if(empty($dotazniky) == true)
{
    //echo "<script>console.log('classic nefunguje')</script>";
    header("location:error.php");
}

else
{
    //echo "<script>console.log('classic funguje')</script>";
    header("location:../t5_vyplneni/formular.php");
}

}

/////////////////////////////////////////////////////////////////////////// vyplnění celkového dotazníku (za pololetí)

else if (isset($_POST['special']) == true)
{


$data2 = mysqli_query($spojeni, $dotazHodiny2);
$pomocnyDotaznik = mysqli_fetch_assoc($data2);

$ucitelID = $pomocnyDotaznik["ucitel_id"];

$dotaz1 = "SELECT * FROM eval_formulare_vzory WHERE idUcitel = '$ucitelID' ORDER BY id DESC LIMIT 1";
$data3 = mysqli_query($spojeni, $dotaz1);
$vzor = mysqli_fetch_assoc($data3);
$vzorID = $vzor["id"];


$dotaz2 = "SELECT * FROM eval_nezarazene WHERE idVzoru = '$vzorID' ORDER BY id DESC LIMIT 1";
$data4 = mysqli_query($spojeni, $dotaz2);
$dotaznikNez = mysqli_fetch_assoc($data4);
$dotaznikID = $dotaznikNez["id"];

$_SESSION["NezID"] = $dotaznikID;

if(empty($dotaznikNez) == true)
{
    //echo "<script>console.log('special nefunguje')</script>";
    header("location:error.php");
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


mysqli_close($spojeni);

?>