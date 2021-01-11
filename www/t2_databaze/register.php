<?php

/* registrace ucitele - register.php v 0.1 */
/* (c) 2020 Lukas Jarolimek - lukas@ljarolimek.cz */

/* 
    * Overi zda se email nachazi v databazi, pokud ano, odesle aktivacni link
    * na email.
*/

include_once "../../config.php";

$spojeni = mysqli_connect(dbhost, dbuser, dbpass, dbname);

if(!$spojeni)
    die("Chyba pripojeni k databazi - " . mysqli_connect_error());

function isInDb($email)
{
    global $spojeni;
    $sql = "SELECT id FROM eval_ucitele WHERE email='$email'";

    $check = mysqli_query($spojeni, $sql);
    if(mysqli_num_rows($check) != 0)
        return true;
    return false;
}

function generateCode()
{
    $num = rand(1, 9);
    return md5($num);
}

function insertCodeToDb($code, $email)
{
    global $spojeni;
    $sql = "UPDATE eval_ucitele SET auth_code='$code' WHERE email='$email'";
    if(mysqli_query($spojeni, $sql))
        return true;
    return false;
}

function getUser($email)
{
    global $spojeni;
    $sql = "SELECT * FROM eval_ucitele WHERE email='$email'";

    $check = mysqli_query($spojeni, $sql);
    if(mysqli_num_rows($check) != 0)
        return mysqli_fetch_assoc($check);
    return false;
}

function sendEmail($email, $code)
{
    $app_url = "http://jarolimek.epsilon.spstrutnov.cz/eval";

    $headers = "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: <no-reply@sps-eval.spstrutnov.cz>' . "\r\n";

    $subject = "Ověření registrace učitele v aplikaci SPŠ eval";
    $body = "Klikněte zde pro registrace: <a href=\"$app_url/t2_databaze/overeni.php?code=$code\">ověřit</a>";
    if(mail($email, $subject, $body, $headers))
        return true;
    return false;
    
}

$email = trim($_POST["email"]);

if(!isset($email) || empty($email))
    die("Chyba: nebyl správně vyplněn email.");

$code = generateCode();
session_start();

if(isInDb($email))
{
    $user = getUser($email);

    if($user["auth_code"] != "")
    {
        $_SESSION["flash_err"] = "Chyba: ověřovací email byl již zaslán a čeká na ověření.";
    }
    elseif($user["passwd"] != "") 
    {
        $_SESSION["flash_ok"] = "Dobrá zpráva, jste již registrován.";
    }
    else 
    {
        if(insertCodeToDb($code, $email))
        {
            sendEmail($email, $code);
            $_SESSION["flash_ok"] = "Potrzovací odkaz byl odeslán na email $email.";
        }
    }
}
else
{
    $_SESSION["flash_err"] =  "Chyba: váš email $email není v systému registrován.";
}

header("location: registrace.php");

mysqli_close($spojeni);