<?php
require_once "../config.php";

$tridaID = $_POST["trida"];
$predmetID = $_POST["predmet"];
$skupina = $_POST["skupina"];

$spojeni = mysqli_connect(dbhost, dbuser, dbpass, dbname);

$dotazHodiny = "SELECT * FROM eval_hodiny WHERE trida_id = '$tridaID' AND predmet_id = '$predmetID' AND skupina = '$skupina'";
$data = mysqli_query($spojeni, $dotazHodiny);

$dotazniky = mysqli_fetch_all($data);

$i = 0;
$nejvetsi;


///////////////////////////////////////////////////////////// normální vyplnění dotazníku
if (isset($_POST['classic']))
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
echo "<script>console.log('".$nejvetsi[5]."')</script>";
echo "<script>console.log('".$nejvetsi[0]."')</script>";

session_start();


$hodinaID = $nejvetsi[0];

$dotaz3 = "SELECT * FROM eval_formulare WHERE idHodiny = '$hodinaID'";
$data5 = mysqli_query($spojeni, $dotaz3);
$formular = mysqli_fetch_assoc($data5);
$formularID = $formular["id"];

$_SESSION["formularID"] = $formularID;
$_SESSION["hodinaID"] = $hodinaID;

if(empty($dotazniky) == true)
{
    header("location:error.php");
}

else
{
    header("location:uspech.php");
}

}

/////////////////////////////////////////////////////////////////////////// vyplnění celkového dotazníku (za pololetí)

if (isset($_POST['special']))
{

$data2 = mysqli_query($spojeni, $dotazHodiny);
$pomocnyDotaznik = mysqli_fetch_assoc($data2);

$ucitelID = $pomocnyDotaznik["ucitel_id"];

$dotaz1 = "SELECT * FROM eval_formulare_vzory WHERE idUcitel = '$ucitelID'";
$data3 = mysqli_query($spojeni, $dotaz1);
$vzor = mysqli_fetch_assoc($data3);
$vzorID = $vzor["id"];


$dotaz2 = "SELECT * FROM eval_nezarazene WHERE idVzoru = '$vzorID'";
$data4 = mysqli_query($spojeni, $dotaz2);
$dotaznikNez = mysqli_fetch_assoc($data4);
$dotaznikID = $dotaznikNez["id"];

$_SESSION["NezID"] = $dotaznikID;

if(empty($dotaznikNez) == true)
{
    header("location:error.php");
}

else
{
    header("location:uspech.php");
}




}
/////////////////////////////////////////////////////////////////////////// chyba
else
{
    header("location:error.php");
}
//echo "<script>console.log('".$dotazniky["id"]."')</script>";
//echo "<script>console.log('".$dotazniky["skolniHodina"]."')</script>";


mysqli_close($spojeni);

?>