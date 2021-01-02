<?php


require_once "../config.php";

$tridaID = $_GET["trida"];
$predmetID = $_GET["predmet"];
$skupina = $_GET["skupina"];


$spojeni = mysqli_connect(dbhost, dbuser, dbpass, dbname);

$dotazHodiny = "SELECT * FROM eval_hodiny WHERE trida_id = '$tridaID' AND predmet_id = '$predmetID' AND skupina = '$skupina' LIMIT 1";

$data2 = mysqli_query($spojeni, $dotazHodiny);
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

$od = $dotaznikNez["povoleno_od"];
$do = $dotaznikNez["povoleno_do"];
$ted = date("Y-m-d");



if(empty($dotaznikNez) == false)
{
    if($ted > $od)
    {
        if($ted < $do)
        {
            $viditelnost = "visible";
            echo $viditelnost;
            /*
            echo $pomocnyDotaznik["ucitel_id"];
            echo $vzorID;
            echo $dotaznikID;
            */
        }

        else
        {
            $viditelnost = "hidden";
            echo $viditelnost;
            /*
            echo $pomocnyDotaznik["ucitel_id"];
            echo $vzorID;
            echo $dotaznikID;
            */
        }
    }

    else
    {
        $viditelnost = "hidden";
        echo $viditelnost;
        /*
        echo $pomocnyDotaznik["ucitel_id"];
        echo $vzorID;
        echo $dotaznikID;
        */
    }

}

else
{
    $viditelnost = "hidden";
    echo $viditelnost;
    /*
    echo $pomocnyDotaznik["ucitel_id"];
    echo $vzorID;
    echo $dotaznikID;
    */
}



mysqli_close($spojeni);


?>