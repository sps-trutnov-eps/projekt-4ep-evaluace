<?php

require_once "../config.php";

$spojeni = mysqli_connect(dbhost,dbuser, dbpass, dbname);
session_start();

$like = $_POST["option"]; // like & dislike
$hodnoceni = $_POST["hodnoceni"]; // text hodnocení
?>