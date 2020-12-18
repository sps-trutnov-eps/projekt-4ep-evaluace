<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="otazky.css"/>
</head>

<body>
<div id="stranka">
    <?php
    //session upravit na testbedu
        require_once "../../config.php";
        $spojeni = mysqli_connect(dbhost, dbuser, dbpass, dbname);
        session_start();
        if(isset($_SESSION["idUcitel"]))
            $ucitelID = $_SESSION["idUcitel"];
    ?>
    <h1>UI pro přidání otázek k danné hodině</h1>
    <div id="formular">
    <div id="datum">
            <label for="start">Počáteční datum výběru:</label>
            <input onchange="zmenacasu()" type="date" id="start" name="end" value="">
            &nbsp;<label for="end">Konečné datum výběru:</label>
            <input onchange="zmenacasu()" type="date" id="end" name="end" value="" min="" max=""><br>
            </div>
            <select name="sablony" onchange="zmenaformulare()" id="formulareSablonySELECT">
                <option value="">Použijte některý uložený formulář</option>
                <?php
                    $sql = "SELECT id,nazev FROM eval_formulare_vzory WHERE idUcitel = $ucitelID AND nazev != ''";
                    $formulareSeznam = mysqli_query($spojeni, $sql);
                    if (mysqli_num_rows($formulareSeznam) > 0)
                        while ($radekFormualre = mysqli_fetch_array($formulareSeznam, MYSQLI_ASSOC)) {
                            $idFormulare = $radekFormualre["id"];
                            $nazevFormulare = $radekFormualre["nazev"];
                            echo "<option value='" . $idFormulare ."'>" . $nazevFormulare . "</option>";
                        }
                ?>
            </select>
            <select name="vyber" id="vyberHodiny">
                <option value="">Vyberte hodinu pro formulář</option>
                <?php

                //odstranit po debugu !!!!!
                $_SESSION["idUcitel"] = 2;//odstranit po debugu !!!!!
                //odstranit po debugu !!!!!

                if (isset($_SESSION["idUcitel"])) {
                    $sql = "SELECT * FROM eval_hodiny WHERE ucitel_id = $ucitelID";
                    $data = mysqli_query($spojeni, $sql);
                    $sql = "SELECT * FROM eval_predmety";
                    $predmety = mysqli_query($spojeni, $sql);
                    $sql = "SELECT * FROM eval_tridy";
                    $tridy = mysqli_query($spojeni, $sql);
                    //echo "<option value=''>" . var_dump($predmety[1]["nazev"]) . "</option>";
                    if (mysqli_num_rows($data) > 0)
                        while ($radek = mysqli_fetch_array($data, MYSQLI_ASSOC)) {
                            $idPredmet = $radek["predmet_id"];
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
                                        $finalTrida = $trida["trida"];
                                        break;
                                    }
                                }
                                $datumHodiny = date("d.m.Y", strtotime($radek["datum"]));
                                echo "<option value='" . $idHodiny . "' class='" . $radek["datum"] . "'>" . $hodina . ". hodina | " . $datumHodiny  . " | " . $finalTrida . " | " .  $finalPredmet  . "</option>";
                            }
                        }
                }
                else{
                    //header("location:"/*kam ho mám poslat -> (_!_) ?*/);
                }
                ?>
            </select>
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
                    <input onclick ="pridatNazevFormulare()" type="checkbox" id="ulozitFormular" name="ulozitFormular" value="true">
                <!--pokud je vybraný některý již uložený formulář nenabízet tuto možnost-->
                <label for="ulozitFormular" id="ulozitLabel">Uložit tento formulář</label><br>
                </div>
                <input id="odeslatFormular" type='submit' value='Odeslat' />
            </form>
    </div>
    <footer>
        <address>2019 &copy; 4.EP</address>
    </footer>
    <script src="script.js"></script>
</div>
</body>

</html>