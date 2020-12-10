<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>

<body>
    <h1>UI pro přidání otázek k danné hodině</h1>
    <div id="formular">
            <label for="start">Start date:</label>
            <input onclick="zmenacasu()" type="date" id="start" name="end" value="">
            <label for="end">Start date:</label>
            <input onclick="zmenacasu()" type="date" id="end" name="end" value="" min="" max="">
            <select onclick="hodinyPrepis()" name="vyber" id="vyberHodiny">
                <option value="">Vyberte hodinu pro formulář</option>
                <?php
                session_start();

                if (isset($_SESSION["idUcitel"])) {
                    $ucitelID = $_SESSION["idUcitel"];
                    $spojeni = null; //spojeni;
                    $sql = "SELECT * FROM eval_hodiny WHERE idUcitel = $ucitelID";
                    $data = mysqli_query($spojeni, $sql);

                    if (mysqli_num_rows($data) > 0) {
                        $data = mysqli_fetch_assoc($data);
                        //hodnoty uvozeny a zakončeny __ jsou hodnoty, které se nahradí později, až bude znám jejich finální název
                        foreach ($data as $moznost) {
                            $idHodiny = $moznost["__id_hodiny__"];
                            $hodina = $moznost["__nazev_hodiny__"];
                            $trida = $moznost["__trida__"];
                            $datumHodiny = $moznost["__datum_hodiny__"];
                            echo "<option value='" . $idHodiny . "'>" . $hodina . " | " . $trida . " | " . $datum  . "</option>";
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