<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <title>T6_Zadání formuláře</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
</head>

<body>
    <header>
        <h1>UI pro přidání otázek k danné hodině</h1>
    </header>
    <div id="stranka">
        <?php
        //session upravit na testbedu
        require_once "../../config.php";
        $spojeni = mysqli_connect(dbhost, dbuser, dbpass, dbname);
        session_start();
        $cisloHodiny = $_GET['id'];
        if (isset($_SESSION["idUcitel"]))
            $ucitelID = $_SESSION["idUcitel"];
        else
            header("Location: ../t4_ucitel/ucitel_prihlaseni.html");

        if(!isset($_GET['id']))
            header("Location: ../t4_ucitel/ucitel_rozvrh.php");
        else{
            $hodina = $_GET['id'];
            $sql = "SELECT * FROM eval_formulare WHERE idHodiny = $hodina";
            $data = mysqli_query($spojeni, $sql);
            if(mysqli_num_rows($data) > 0)
                header("Location: ../t4_ucitel/ucitel_rozvrh.php");
        }
        ?>
        <div id="formular">
            <input type="hidden" id='vyberHodiny' value="">
            <!--<div id="datum">
                <div id='startdate'>
                    <label for="start">Počáteční datum výběru:</label>
                    <input onchange="zmenacasu()" type="date" id="start" name="end" value="">
                </div>
                <div id='enddate'>
                    <label for="end">Konečné datum výběru:</label>
                    <input onchange="zmenacasu()" type="date" id="end" name="end" value="" min="" max=""><br>
                </div>
            </div>-->
            <div id="selekty">
                <select name="sablony" onchange="zmenaformulare()" id="formulareSablonySELECT">
                    <option value="">Použijte některý uložený formulář</option>
                    <?php
                    $sql = "SELECT id,nazev FROM eval_formulare_vzory WHERE idUcitel = $ucitelID AND nazev != ''";
                    $formulareSeznam = mysqli_query($spojeni, $sql);
                    if (mysqli_num_rows($formulareSeznam) > 0)
                        while ($radekFormualre = mysqli_fetch_array($formulareSeznam, MYSQLI_ASSOC)) {
                            $idFormulare = $radekFormualre["id"];
                            $nazevFormulare = $radekFormualre["nazev"];
                            echo "<option value='" . $idFormulare . "'>" . $nazevFormulare . "</option>";
                        }
                    ?>
                </select>
                <!--<select name="vyber" id="vyberHodiny">
                    <option value="">Vyberte hodinu pro formulář</option>
                    <?php/*

                    //odstranit po debugu !!!!!
                    $_SESSION["idUcitel"] = 2; //odstranit po debugu !!!!!
                    //odstranit po debugu !!!!!

                    if (isset($_SESSION["idUcitel"])) {
                        $sql = "SELECT * FROM eval_hodiny WHERE idUcitele = $ucitelID";
                        $data = mysqli_query($spojeni, $sql);
                        $sql = "SELECT * FROM eval_predmety";
                        $predmety = mysqli_query($spojeni, $sql);
                        $sql = "SELECT * FROM eval_tridy";
                        $tridy = mysqli_query($spojeni, $sql);
                        //echo "<option value=''>" . var_dump($predmety[1]["nazev"]) . "</option>";
                        if (mysqli_num_rows($data) > 0)
                            while ($radek = mysqli_fetch_array($data, MYSQLI_ASSOC)) {
                                $idPredmet = $radek["idPredmetu"];
                                $idHodiny = $radek["id"];
                                $sql = "SELECT * FROM eval_formulare WHERE idHodiny = $idHodiny";
                                $hodinaVyplnena = mysqli_query($spojeni, $sql);
                                if (mysqli_num_rows($hodinaVyplnena) < 1) {
                                    $hodina = $radek["skolniHodina"];
                                    $idTrida = $radek["trida_id"];
                                    while ($predmet = mysqli_fetch_array($predmety, MYSQLI_ASSOC)) {
                                        if ($predmet["id"] == $idPredmet) {
                                            $finalPredmet = $predmet["nazev"];
                                            break;
                                        }
                                    }
                                    while ($trida = mysqli_fetch_array($tridy, MYSQLI_ASSOC)) {
                                        if ($trida["id"] == $idTrida) {
                                            $finalTrida = $trida["nazev"];
                                            break;
                                        }
                                    }
                                    $datumHodiny = date("d.m.Y", strtotime($radek["datum"]));
                                    echo "<option value='" . $idHodiny . "' class='" . $radek["datum"] . "'>" . $hodina . ". hodina | " . $datumHodiny  . " | " . $finalTrida . " | " .  $finalPredmet  . "</option>";
                                }
                            }
                    } else {
                    }
                    */?>
                </select>-->
            </div>
            <form id='formularOtazky'>
                <div id="vyberCelkovehoHodnoceniHodiny"><br>
                    <h3>Vyberte možnost celkového hodnocení</h3>
                    <input onchange="kontrolaUpravyVybranehoFormulareZmena(false)" type='radio' id='like' name='formularVyberFormulare' value='like'>
                    <label for='like'>Like/Dislike</label><br>
                    <input onchange="kontrolaUpravyVybranehoFormulareZmena(false)" type='radio' name='formularVyberFormulare' id='hvezda' value='hvezda'>
                    <label for='hvezda'>Hvězdové ohodnocení</label><br>
                    <input onchange="kontrolaUpravyVybranehoFormulareZmena(false)" type='radio' name='formularVyberFormulare' id='bezHodnoceni' value='bezHodnoceni'>
                    <label for='bezHodnoceni'>Bez celkového hodnocení</label><br>
                </div>
                <div id="otazky"></div>
                <div id="checkbox">
                    <button type="button" id="pridatOtazku" onclick="pridatDalsiOtazku()">Přídat další otázku</button><br>
                    <!--pokud je vybraný některý již uložený formulář nenabízet tuto možnost, možná ?-->
                    <input onclick="pridatNazevFormulare()" type="checkbox" id="ulozitFormular" name="ulozitFormular" value="true">
                    <!--pokud je vybraný některý již uložený formulář nenabízet tuto možnost-->
                    <label for="ulozitFormular" id="ulozitLabel">Uložit tento formulář</label><br>
                </div>
                <div>
                    <input type="range" min="5" max="30" value="5" class="slider" id="rozsahCas">
                    <p>Čas: <span id="cas"></span> minut</p>
                    <input type="range" min="1" max="30" value="15" class="slider" id="rozsahPouziti">
                    <p>Počet použití: <span id="pouziti"></span></p>
                </div>
                <div id="odeslat">
                    <input id="odeslatFormular" type='submit' value='Odeslat' />
                </div>
            </form>
        </div>
        <script src="script_dotaznik.js"></script>
    </div>
    <footer>
        <address> &copy; 2020-2021 | 4.EP | #SPŠ101 </address>
        *Image by <a href="https://pixabay.com/users/chiplanay-1971251/?utm_source=link-attribution&amp;utm_medium=referral&amp;utm_campaign=image&amp;utm_content=4232859">chiplanay</a> from <a href="https://pixabay.com/?utm_source=link-attribution&amp;utm_medium=referral&amp;utm_campaign=image&amp;utm_content=4232859">Pixabay</a>
    </footer>
</body>

</html>