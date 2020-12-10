<?php

require_once "../config.php";

$email = $_POST["email"];
$passwd = $_POST["passwd"];

$spojeni = mysqli_connect(dbhost, dbuser, dbpass, dbname);
$data = mysqli_query($spojeni, "SELECT * FROM `eval_ucitele` WHERE email = '$email'");

if(mysqli_num_rows($data) == 0)
{
    echo "<p>Tento email: <b>$email</b> neexistuje.</p>";
}
else
{
    $email = mysqli_fetch_assoc($data);

    if($email["passwd"] == $passwd)
    {
        session_start();
        $_SESSION['idUcitel'] = $email["id"];
        header("location:ucitel_rozvrh.html");
    }
    else
    {
        echo "<p>Neplatné heslo pro uživatele <b>$email</b>.</p>";
    }
}

mysqli_close($spojeni);
