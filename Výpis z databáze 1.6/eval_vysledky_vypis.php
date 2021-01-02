<!DOCTYPE html>
<html lang="en">
<head>
    <title>Evaulace</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>Vysledky</h1>
</header>
<div id="stranka">
<main>
<?php
require_once "../config.php"; // získání configu

if (isset($_POST["datum"]))$datum_post = $_POST["datum"]; //kontrola pro existenci proměnných je v ní někde chyba ale nedokázal jsem uzatím najít řešení i přesto že neexistuje tak se zapíše a pak je z toho dále problém
if (isset($_POST["predmet"]))$predmet_post = $_POST["predmet"];
if (isset($_POST["tridy"]))$tridy_post = $_POST["tridy"];
if (isset($_POST["skupina"]))$skupina_post = $_POST["skupina"];
session_start();
//$ucitel = $_SESSION["ucitel"]; funkční ale na testování samostatného modulu zakomemtováno
$ucitel = 'senkyr'; // test

$spojeni = mysqli_connect(dbhost, dbuser, dbpass, dbname); // připojení k db
//začátek generování listů pro formulář
echo"
<datalist id='datum'>
";
//získávání dat pro formuláře z daných míst v db
$data_dotazniky = mysqli_query($spojeni,"SELECT DISTINCT datum FROM `eval_hodiny` WHERE ucitel_id = (SELECT id FROM eval_ucitele WHERE email = '$ucitel')"); 
while($datum = mysqli_fetch_assoc($data_dotazniky))
{
    $date = $datum["datum"]; 
    echo"<option value='$date'>";
}
//generování listů pro formulář
echo"
</datalist>
<datalist id='predmet'>
";
//získávání dat pro formuláře z daných míst v db
$data_predmety = mysqli_query($spojeni,"SELECT DISTINCT p.nazev FROM eval_predmety p INNER JOIN eval_hodiny h ON h.predmet_id = p.id WHERE h.ucitel_id = (SELECT id FROM eval_ucitele WHERE email = '$ucitel')"); 
while($predmety = mysqli_fetch_assoc($data_predmety))
{  
    $nazev = $predmety["nazev"];
    echo"<option value='$nazev'>";
}
//generování listů pro formulář
echo"
</datalist>
<datalist id='tridy'>
";
//získávání dat pro formuláře z daných míst v db
$data_tridy = mysqli_query($spojeni,"SELECT DISTINCT t.trida FROM eval_tridy t INNER JOIN eval_hodiny h ON h.trida_id = t.id WHERE h.ucitel_id = (SELECT id FROM eval_ucitele WHERE email = '$ucitel')"); 
while($tridy = mysqli_fetch_assoc($data_tridy))
{  
    $trida = $tridy["trida"];
    echo"<option value='$trida'>";
}
//generování listů pro formulář
echo"
</datalist>
<datalist id='skupina'>
";
//získávání dat pro formuláře z daných míst v db
$data_dotazniky = mysqli_query($spojeni,"SELECT DISTINCT skupina FROM eval_hodiny WHERE ucitel_id = (SELECT id FROM eval_ucitele WHERE email = '$ucitel')"); 
while($datum = mysqli_fetch_assoc($data_dotazniky))
{
    $skupina = $datum["skupina"]; 
    echo"<option value='$skupina'>";
}
//generování posledního listu a formulářů a věci pro css
echo"
</datalist>
<div id='vysledkytabulka'>
<table>
<tr>
<th>
<div id='vysledky1'>
<form method='post' action='eval_vysledky_vypis.php'>
    <label for='datum'>Vyberte datum:</label><br>
    <input type='list' list='datum' name='datum'/><br>
    <label for='predmet'>Vyberte předmět:</label><br>
    <input type='list' list='predmet' name='predmet'/><br>
    <label for='tridy'>Vyberte třídu:</label><br>
    <input type='list' list='tridy' name='tridy'/><br>
    <label for='skupina'>Vyberte skupinu:</label><br>
    <input type='list' list='skupina' name='skupina'/><br>
    <input type='submit' value='Potvrdit'><br>
</form>
</div> 
</th>
<th>
<div id='vysledky2'>";
$filtr = "";/* nefunkčí kvůli předchozí kontrole z postu nenalezeno řešení prozatím
if(isset($datum_post))
{
    $filtr = $filtr . " AND h.datum = '" . $datum_post . "'";
}
if(isset($predmet_post))
{
    $filtr = $filtr . " AND p.nazev = '" . $predmet_post . "'";
}
if(isset($tridy_post))
{
    $filtr = $filtr . " AND t.trida = '" . $tridy_post . "'";
}
if(isset($skupina_post))
{
    if($filtr != "")
    {
        $filtr = $filtr . " AND h.skupina = '" . $skupina_post . "'";
    }
}*/
//získávání vyfiltrovaných dat pro vísledky po zprovoznění filtru
$data_vysledky = mysqli_query($spojeni,"SELECT u.email, t.trida, p.nazev, h.datum, h.temaHodiny, h.zruseno, h.id FROM eval_hodiny h INNER JOIN eval_ucitele u ON h.ucitel_id = u.id LEFT JOIN eval_tridy t ON h.trida_id = t.id LEFT JOIN eval_predmety p ON h.predmet_id = p.id  WHERE ucitel_id = (SELECT id FROM eval_ucitele WHERE email = '$ucitel')$filtr"); 
//generování jednotlivých výsledků jako formuláře s hidden informací o daném výsledku pro poslání na další stránku kde se zobrazí výsledek v detailu
while($vysledky = mysqli_fetch_assoc($data_vysledky))
{
    $vysledky_id = $vysledky["id"];
    $vysledky_datum = $vysledky["datum"];
    $vysledky_email = $vysledky["email"];
    $vysledky_trida = $vysledky["trida"];
    $vysledky_nazev = $vysledky["nazev"];
    $vysledky_tema = $vysledky["temaHodiny"];
    //spojování textu do "srozumitelného" řeťezce pro identifikaci
    $vysledek = $vysledky_email . " " . $vysledky_trida . " " . $vysledky_nazev . " " . $vysledky_tema; 
    //zobrazení "odkazu" ve formě formuláře pro zobrazení detailu
    echo"
    <form method='post' action='eval_vysledek_detail.php'>
        <input type='submit' value='$vysledek'>
        <input type='hidden' name='idHodiny' value='$vysledky_id'/></br>
    </form>";
}
//věci pro css
echo"
</div>
</th>
</tr>
</table>
</div>";
mysqli_close($spojeni);
?>
</main>
</div>
<footer>
<address> &copy; 2020-2021 | 4.EP | #SPŠ101 </address>
 *Image by <a href="https://pixabay.com/users/chiplanay-1971251/?utm_source=link-attribution&amp;utm_medium=referral&amp;utm_campaign=image&amp;utm_content=4232859">chiplanay</a> from <a href="https://pixabay.com/?utm_source=link-attribution&amp;utm_medium=referral&amp;utm_campaign=image&amp;utm_content=4232859">Pixabay</a>
</footer>
</body>
</html>