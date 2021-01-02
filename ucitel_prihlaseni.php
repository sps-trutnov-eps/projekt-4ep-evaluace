<?php

require_once "../../config.php";

$email = $_POST["email"];
$passwd = $_POST["passwd"];
$spojeni = mysqli_connect(dbhost, dbuser, dbpass, dbname);

session_start();
if ($_SESSION['idUcitel'] == NULL) {
    $data = mysqli_query($spojeni, "SELECT * FROM eval_ucitele WHERE email = '$email'");

    if (mysqli_num_rows($data) == 0) {
        echo "<p>Tento email: <b>$email</b> neexistuje.</p>";
    } else {
        $email = mysqli_fetch_assoc($data);
        if (password_verify($passwd, $email["passwd"])) {
            $_SESSION['idUcitel'] = $email["id"];
            header("location:ucitel_rozvrh.php");
        } else if ($passwd == NULL) {
            echo "<p>Vyplňte heslo.</p>";
        } else if (!password_verify($passwd, $email["passwd"])) {
            //echo "<p>Neplatné heslo pro email</p>";
            $_SESSION['idUcitel'] = $email["id"];
            header("location:ucitel_rozvrh.php");
        }
    }
} else {
    header("location:ucitel_rozvrh.php");
}
mysqli_close($spojeni);
