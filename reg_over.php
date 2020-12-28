<?php

if(isset($_POST["code"]) && !empty($_POST["code"]))
    $code = trim($_POST["code"]);
else
    die("Chyba: nesprávný požadavek.");

include_once "../config.php";

$spojeni = mysqli_connect(dbhost, dbuser, dbpass, dbname);

if(!$spojeni)
    die("Chyba pripojeni k databazi - " . mysqli_connect_error());

$sql = "SELECT id, email FROM eval_ucitele WHERE auth_code='$code'";
$res = mysqli_query($spojeni, $sql);

if(mysqli_num_rows($res) != 1) 
{
    $_SESSION["flash_err"] = "Chyba: neplatný ověřovací kód.";
    header("location: overeni.php?code=$code");
    die();
}

$userinf = mysqli_fetch_assoc($res);

$heslo = $_POST["heslo"];
$again = $_POST["heslo_again"];
session_start();

if($heslo != $again) 
{
    $_SESSION["flash_err"] = "Chyba: hesla se neshodují.";
    header("location: overeni.php?code=$code");
    die();
}
$pass = password_hash($heslo, PASSWORD_DEFAULT);

$set = "UPDATE eval_ucitele SET passwd='$pass', auth_code='' WHERE auth_code='$code'";
if(mysqli_query($spojeni, $set))
    $_SESSION["flash_ok"] = "Heslo nastaveno - registrace proběhla v pořádku.";
else
    $_SESSION["flash_err"] = "Chyba při nastavování hesla.";

mysqli_close($spojeni);
header("location: registrace.php");

?>