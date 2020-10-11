<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="script.js"></script>
    <title>Document</title>
</head>

<body>
    <h1>UI pro přidání otázek k danné hodině</h1>
    <div id="formular">
        <select name="vyber" id="vyberHodiny">
            <option value="">Vyberte hodinu pro formulář</option>
            <?php
            $spojeni = null; //spojeni;
            $sql = "SELECT * FROM /*databaze*/ WHERE ucitelID = $ucitelID";
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
            ?>
        </select>
        <div id="vyberCelkovehoHodnoceniHodiny">
            <h3>Vyberte možnost celkového hodnocení</h3>
            <input type='radio' id='like' name='formularVyberFormulare' value='like'>
            <label for='like'>Like/Dislike</label><br>
            <input type='radio' name='formularVyberFormulare' id='hvezda' value='hvezda'>
            <label for='hvezda'>Hvězdové ohodnocení</label><br>
            <input type='radio' name='formularVyberFormulare' id='bezHodnoceni' value='bezHodnoceni'>
            <label for='bezHodnoceni'>Bez celkového hodnocení</label><br>
        </div>

        



        <button id="pridatOtazku" onclick="pridatDalsiOtazku()">Přídat další otázku</button><br>
        <input type='submit' value='Odeslat' />
    </div>
</body>

</html>