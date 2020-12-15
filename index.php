<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>

<body>
    <h1>UI pro přidání otázek k danné hodině</h1>
    <div id="formular">
            <label for="start">Počáteční datum výběru:</label>
            <input onclick="zmenacasu()" type="date" id="start" name="end" value="">
            <label for="end">Konečné datum výběru:</label>
            <input onclick="zmenacasu()" type="date" id="end" name="end" value="" min="" max=""><br>
            <select onclick="hodinyPrepis()" name="vyber" id="vyberHodiny">
                <option value="">Vyberte hodinu pro formulář</option>
                <?php
                require_once "../../config.php";
                $spojeni = mysqli_connect(dbhost, dbuser, dbpass, dbname);
                session_start();

                //odstranit po debugu !!!!!
                $_SESSION["idUcitel"] = 2;//odstranit po debugu !!!!!
                //odstranit po debugu !!!!!

                if (isset($_SESSION["idUcitel"])) {
                    $ucitelID = $_SESSION["idUcitel"];
                    $sql = "SELECT * FROM eval_hodiny WHERE ucitel_id = $ucitelID";
                    $data = mysqli_query($spojeni, $sql);
                    $sql = "SELECT * FROM eval_predmety";
                    $predmety = mysqli_query($spojeni, $sql);
                    $sql = "SELECT * FROM eval_tridy";
                    $tridy = mysqli_query($spojeni, $sql);
                    //echo "<option value=''>" . var_dump($predmety[1]["nazev"]) . "</option>";
                    if (mysqli_num_rows($data) > 0) {
                        while($radek = mysqli_fetch_array($data,MYSQLI_ASSOC)){
                            $idPredmet = $radek["predmet_id"];
                            $idHodiny = $radek["id"];
                            $hodina = $radek["skolniHodina"];
                            $idTrida = $radek["trida_id"];
                            while($predmet = mysqli_fetch_array($predmety,MYSQLI_ASSOC)){
                                if($predmet["id"] == $idPredmet){
                                    $finalPredmet = $predmet["nazev"];
                                    break;
                                }
                            }
                            while($trida = mysqli_fetch_array($tridy,MYSQLI_ASSOC)){
                                if($trida["id"] == $idTrida){
                                    $finalTrida = $trida["trida"];
                                    break;
                                }
                            }
                            $datumHodiny = date("d.m.Y",strtotime($radek["datum"]));
                            echo "<option value='" . $idHodiny . "' class='". $datumHodiny ."'>" . $hodina . ". hodina | " . $datumHodiny  . " | " . $finalTrida . " | " .  $finalPredmet  . "</option>";
                        } 
                    }
                }
                else{
                    //header("location:"/*kam ho mám poslat*/);
                }
                ?>
            </select>
            <form id='formularOtazky'>
                <div id="vyberCelkovehoHodnoceniHodiny">
                    <h3>Vyberte možnost celkového hodnocení</h3>
                    <input type='radio' id='like' name='formularVyberFormulare' value='like'>
                    <label for='like'>Like/Dislike</label><br>
                    <input type='radio' name='formularVyberFormulare' id='hvezda' value='hvezda'>
                    <label for='hvezda'>Hvězdové ohodnocení</label><br>
                    <input type='radio' name='formularVyberFormulare' id='bezHodnoceni' value='bezHodnoceni'>
                    <label for='bezHodnoceni'>Bez celkového hodnocení</label><br>
                </div>
                <div id="otazky"></div>
                <button type="button" id="pridatOtazku" onclick="pridatDalsiOtazku()">Přídat další otázku</button><br>
                <input type='submit' value='Odeslat' />
            </form>
    </div>
    <script src="script.js"></script>
</body>

</html>