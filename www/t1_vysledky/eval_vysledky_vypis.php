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

if (isset($_POST["datum_od"]))$datum_od_post = $_POST["datum_od"]; //kontrola pro existenci proměnných je v ní někde chyba ale nedokázal jsem zatím najít řešení i přesto že neexistuje tak se zapíše a pak je z toho dále problém
if (isset($_POST["datum_do"]))$datum_do_post = $_POST["datum_do"];
if (isset($_POST["predmet"]))$predmet_post = $_POST["predmet"];
if (isset($_POST["tridy"]))$tridy_post = $_POST["tridy"];
if (isset($_POST["skupina"]))$skupina_post = $_POST["skupina"];

session_start();//kontrola přihlášení učitele
if (isset($_SESSION["idUcitel"]))
$ucitelID = $_SESSION["idUcitel"];
else
header("Location: ../t4_ucitel/ucitel_prihlaseni.php");

$spojeni = mysqli_connect(dbhost, dbuser, dbpass, dbname); // připojení k db
//začátek generování listů pro formulář
echo"
<datalist id='datum'>
";
//získávání dat pro formuláře z daných míst v db
$data_dotazniky = mysqli_query($spojeni,"SELECT DISTINCT datum FROM `eval_hodiny` WHERE idUcitele = '$ucitelID'"); 
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
$data_predmety = mysqli_query($spojeni,"SELECT DISTINCT p.nazev FROM eval_predmety p INNER JOIN eval_hodiny h ON h.idPredmetu = p.id WHERE h.idUcitele = '$ucitelID'"); 
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
$data_tridy = mysqli_query($spojeni,"SELECT DISTINCT t.nazev FROM eval_tridy t INNER JOIN eval_hodiny h ON h.idTridy = t.id WHERE h.idUcitele = '$ucitelID'"); 
while($tridy = mysqli_fetch_assoc($data_tridy))
{  
    $trida = $tridy["nazev"];
    echo"<option value='$trida'>";
}
//generování listů pro formulář
echo"
</datalist>
<datalist id='skupina'>
";
//získávání dat pro formuláře z daných míst v db
$data_dotazniky = mysqli_query($spojeni,"SELECT DISTINCT skupina FROM eval_hodiny WHERE idUcitele = '$ucitelID'"); 
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
    <label for='datum_od'>Vyberte datum od:</label><br>
    <input type='list' list='datum' name='datum_od'/><br>
    <label for='datum_do'>Vyberte datum od:</label><br>
    <input type='list' list='datum' name='datum_do'/><br>
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
$filtr = "";
if(isset($datum_od_post) AND $datum_od_post != NULL)
{  
    if(isset($datum_do_post) AND $datum_do_post != NULL)
    {
        $filtr = $filtr . " AND h.datum BETWEEN '" . $datum_od_post . "' AND '" . $datum_do_post . "'";
    }
    else
    {
        $filtr = $filtr . " AND h.datum >= '" . $datum_od_post . "'";
    }
}
if(isset($datum_do_post) AND $datum_do_post != NULL)
{
    if(isset($datum_od_post) AND $datum_od_post != NULL){}
    else
    {        
        $filtr = $filtr . " AND h.datum <= '" . $datum_do_post . "'";
    }
}
if(isset($predmet_post) AND $predmet_post != NULL)
{
    $filtr = $filtr . " AND p.nazev = '" . $predmet_post . "'";
}
if(isset($tridy_post) AND $tridy_post != NULL)
{
    $filtr = $filtr . " AND t.nazev = '" . $tridy_post . "'";
}
if(isset($skupina_post) AND $skupina_post != NULL)
{
    if($filtr != "")
    {
        $filtr = $filtr . " AND h.skupina = '" . $skupina_post . "'";
    }
}
//získávání vyfiltrovaných dat pro vísledky po zprovoznění filtru
$data_vysledky = mysqli_query($spojeni,"SELECT u.email, t.nazev AS trida, p.nazev AS obor, h.datum, h.temaHodiny, h.zruseno, h.id FROM eval_hodiny h INNER JOIN eval_ucitele u ON h.idUcitele = u.id LEFT JOIN eval_tridy t ON h.idTridy = t.id LEFT JOIN eval_predmety p ON h.idPredmetu = p.id  WHERE idUcitele = '$ucitelID'$filtr"); 
//generování jednotlivých výsledků jako formuláře s hidden informací o daném výsledku pro poslání na další stránku kde se zobrazí výsledek v detailu
$i = 0;//proměnná pro odpočet
$oznaceni = "vysledek";//název pod kterým se budou posílat
echo"
<form method='post' action='eval_vysledek_detail.php'>
    <input type='hidden' name='oznaceni' value='$oznaceni'>
    <input type='checkbox' id='vse' onclick='chechbox_all(this);'/>
    <label for='vse'>Označit vše</label><br>";
while($vysledky = mysqli_fetch_assoc($data_vysledky))
{
    //vybrání proměnných
    $vysledek_id = $vysledky["id"];
    $vysledek_datum = $vysledky["datum"];
    $vysledek_email = $vysledky["email"];
    $vysledek_trida = $vysledky["trida"];
    $vysledek_obor = $vysledky["obor"];
    $vysledek_tema = $vysledky["temaHodiny"];
    //spojování textu do "srozumitelného" řeťezce pro identifikaci
    $vysledek = $vysledek_datum . " | " . $vysledek_trida . " | " . $vysledek_obor . " - " . $vysledek_tema; 
    //zobrazení "odkazu" ve formě formuláře pro zobrazení detailu
    $i++;//opočet výsledků
    echo"
        <input type='checkbox' id='$oznaceni$i' name='$oznaceni$i' value='$vysledek_id'/>
        <label for='$oznaceni$i'>$vysledek</label><br>";
}
//konec formuláře s konečným číslem výsledků
echo"
<input type='hidden' name='pocet' value='$i'>
<label>Celkem nalezeno:$i výsledků</label><br>
<input type='submit' value='Přejít na detail'>
</form>";
//věci pro css
echo"
</div>
</th>
</tr>
</table>
</div>";
//uzavření spojení s db
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