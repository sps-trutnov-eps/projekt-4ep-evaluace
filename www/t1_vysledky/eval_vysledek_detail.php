<!DOCTYPE html>
<html lang="cs">
<head>
    <title>Evaulace</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="export_excel.js"></script>
</head>
<body>
<header>
    <h1>Vysledky</h1>
</header>
<div id="stranka">
<main>
<?php
require_once "../../config.php"; // získání configu

if (isset($_POST["idHodiny"]))$idHodiny_post = $_POST["idHodiny"]; //kontrola pro existenci proměnné

session_start();//kontrola přihlášení učitele
/*if (isset($_SESSION["idUcitel"]))
$ucitelID = $_SESSION["idUcitel"];
else
header("Location: ../t4_ucitel/ucitel_prihlaseni.php");*/
$ucitelID = 2;

$spojeni = mysqli_connect(dbhost, dbuser, dbpass, dbname); //připojení k db

$data_vysledky = mysqli_query($spojeni,"SELECT * FROM `eval_hodiny` WHERE id = '$idHodiny_post'");

while($vysledky = mysqli_fetch_assoc($data_vysledky))
{
    $vysledek_datum = $vysledky["datum"];
    $vysledek_trida = $vysledky["trida"];
    $vysledek_obor = $vysledky["obor"];
    $vysledek_tema = $vysledky["temaHodiny"];
    //spojování textu do "srozumitelného" řeťezce pro identifikaci
    $vysledek = $vysledek_datum . " " . $vysledek_trida . " " . $vysledek_obor . " " . $vysledek_tema; 
    //zobrazení "odkazu" ve formě formuláře pro zobrazení detailu
    echo"
    <form method='post' action='eval_vysledek_detail.php'>
        <input type='submit' value='$vysledek'>
        <input type='hidden' name='idHodiny' value='$vysledek_id'/></br>
    </form>";
}
//uzavření spojení s db
mysqli_close($spojeni);
?>
<button id="btnExport" onclick="fnExcelReport();"> EXPORT </button>
</main>
</div>
<footer>
<address> &copy; 2020-2021 | 4.EP | #SPŠ101 </address>
 *Image by <a href="https://pixabay.com/users/chiplanay-1971251/?utm_source=link-attribution&amp;utm_medium=referral&amp;utm_campaign=image&amp;utm_content=4232859">chiplanay</a> from <a href="https://pixabay.com/?utm_source=link-attribution&amp;utm_medium=referral&amp;utm_campaign=image&amp;utm_content=4232859">Pixabay</a>
</footer>
</body>
</html>