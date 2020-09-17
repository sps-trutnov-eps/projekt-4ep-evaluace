<?php

require_once "../config.php";

$spojeni = mysqli_connect(dbhost,dbuser, dbpass, dbname);
session_start();

$datum = date(); // datum
$hodina = ""; // předmět
$ucitel = ""; // učitel
$like = $_POST["option"]; // like & dislike
$hodnoceni = $_POST["hodnoceni"]; // text hodnocení

// Názvy řádků v tabulce do té doby, než se dohodneme na názvu v databázi
$nazevTabulky = ``;

$datumTabulka = ``;
$hodinaTabulka = ``;
$ucitelTabulka = ``;
$likeTabulka = ``;
$hodnoceniTabulka = ``;

//vložení dat do tabulky
mysqli_query($spojeni, "INSERT INTO $nazevTabulky($datumTabulka,$hodinaTabulka,$ucitelTabulka,$likeTabulka,$hodnoceniTabulka) VALUES ($datum,$hodina,$ucitel,$like,$hodnoceni,)");


header();

?>