<!DOCTYPE html>
<html lang="cs">
<head>
    <title>Evaulace</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="export_excel.js" charset="utf-8"></script>
    <meta charset="utf-8" />
</head>
<body>
<header>
    <h1>Vysledky</h1>
</header>
<div id="stranka">
<main>
<button id="btnExport" onclick="fnExcelReport();">EXPORT</button>
<?php
require_once "../../config.php"; // získání configu

if (isset($_POST["oznaceni"]))$oznaceni = $_POST["oznaceni"];//kontrola pro existenci proměnné
if (isset($_POST["pocet"]))$pocet = $_POST["pocet"];
$x = 1; //proměnná pro while
$i = 0; //odpočet
while ($x) { //získání všech poslaných id
    $i++;
    if (isset($_POST["$oznaceni$i"]))$idHodiny_post[$i] = $_POST["$oznaceni$i"];
    if($i >= $pocet)$x = 0;
}

session_start();//kontrola přihlášení učitele
/*
if (isset($_SESSION["idUcitel"]))
$ucitelID = $_SESSION["idUcitel"];
else
header("Location: ../t4_ucitel/ucitel_prihlaseni.html");*/
$ucitelID = 2;

$spojeni = mysqli_connect(dbhost, dbuser, dbpass, dbname);//připojení k db
//vytvoření tabulky a jejích názvů
echo"
<table id='Detail'>
<tr><th>Otázka</th><th>Odpověď</th><th>Datum</th><th>Třída</th><th>Skupina</th><th>Předmět</th><th>Téma hodiny</th><th>Hodina</th><th>Konání</th></tr>";
foreach($idHodiny_post as $idHodiny){//vypsání všech výsledků
    $data_vysledky = mysqli_query($spojeni,"SELECT h.datum, h.skupina, h.skolniHodina AS hodina, h.temaHodiny AS tema, h.zruseno, o.odpoved, fv.otazka, p.nazev AS predmet, t.nazev AS trida FROM eval_odpovedi o INNER JOIN eval_formulare f ON o.idFormulare = f.id INNER JOIN eval_formulare_vzory fv  ON f.idVzoru = fv.id INNER JOIN eval_hodiny h ON f.idHodiny = h.id INNER JOIN eval_predmety p ON h.idPredmetu = p.id INNER JOIN eval_tridy  t ON h.idTridy = t.id WHERE h.id = '$idHodiny'");
    //postupné procházení výsledků
    while($vysledky = mysqli_fetch_assoc($data_vysledky))
    {
        //získávání proměnných
        $vysledek_datum = $vysledky["datum"];
        $vysledek_skupina = $vysledky["skupina"];
        $vysledek_hodina = $vysledky["hodina"];
        $vysledek_tema = $vysledky["tema"];
        $vysledek_zruseno = $vysledky["zruseno"];
        $vysledek_odpoved = $vysledky["odpoved"];
        $vysledek_otazka = $vysledky["otazka"];
        $vysledek_predmet = $vysledky["predmet"];
        $vysledek_trida = $vysledky["trida"];
        //srozumitelnější zrušeno
        if ($vysledek_zruseno)
        $vysledek_zruseno = "zrušeno";
        else
        $vysledek_zruseno = "proběhla";
        //zapisování řádků
        echo"<tr><td>$vysledek_otazka</td><td>$vysledek_odpoved</td><td>$vysledek_datum</td><td>$vysledek_trida</td><td>$vysledek_skupina</td><td>$vysledek_predmet</td><td>$vysledek_tema</td><td>$vysledek_hodina</td><td>$vysledek_zruseno</td></tr>";
    }
}
//konec tabulky
echo"
</table>";
//uzavření spojení s db
mysqli_close($spojeni);
?>
<iframe id="txtArea1" style="display:none"></iframe>
</main>
</div>
<footer>
<address> &copy; 2020-2021 | 4.EP | #SPŠ101 </address>
 *Image by <a href="https://pixabay.com/users/chiplanay-1971251/?utm_source=link-attribution&amp;utm_medium=referral&amp;utm_campaign=image&amp;utm_content=4232859">chiplanay</a> from <a href="https://pixabay.com/?utm_source=link-attribution&amp;utm_medium=referral&amp;utm_campaign=image&amp;utm_content=4232859">Pixabay</a>
</footer>
</body>
</html>