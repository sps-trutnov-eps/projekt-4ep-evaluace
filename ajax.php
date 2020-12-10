<?php   
    if(isset($_POST["odeslatDotaznik"])){
        $sql;
        $spojeni;
        mysqli_query($spojeni, $sql);

    }

    if (isset($_POST["a"])) {
        $action = $_POST['a'];
        if ($action == "otazky") {
            $array = $_POST['array'];
            $data = serialize($array);

            mysqli_query($spojeni, "INSERT INTO /* databáze */ (`dotaznik`) VALUES ('$data')");
        }
    }